<?php

class NodeController extends Controller
{
	public $kunciPerkalian = 3107;


	public function actionIndex()
	{
		// redirect ganti sesion
		$this->redirect(array('/go/home'));
	}

	public function actionGetprovider()
	{
		// cari operator by kategori
		$criteria=new CDbCriteria;
	   	$criteria->condition = 'ktg_id = :ktgid AND opt_status = :status';
	   	$criteria->params = array(':ktgid' => $_POST['ktgId'], ':status' => 'lancar');
	   	$criteria->order = 'opt_name ASC';
		$model = Operator::model()->findAll($criteria);

		// convert hasil pencarian ke listdata
		$listdata = CHtml::listData($model, 'opt_id', 'opt_name');
        echo CHtml::tag('option', array('value' => ''), CHtml::encode("- Pilih Provider -"), true);
        
        // tampilkan hasil request
        foreach ($listdata as $value => $name) {
        	$cariDenom = Denom::model()->findAll('opt_id = "'.$value.'"');
        	if(count($cariDenom) > 0){
        		echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        	}
        }
	}

	public function actionGetnominal()
	{
		// cari denom by operator id
		$criteria=new CDbCriteria;
	   	$criteria->condition = 'opt_id = :pvdid';
	   	$criteria->params = array(':pvdid' => $_POST['pvdId']);
	   	$criteria->order = 'dnm_nominal ASC';
		$model = Denom::model()->findAll($criteria);

		// generate random (thanks sarip)
		$random = Nourut::getRandom();
		
		// tampilkan hasil request
        echo CHtml::tag('option', array('value' => ''), CHtml::encode("- Pilih Nominal -"), true);
        foreach ($model as $result) {
            echo CHtml::tag('option', array('value' => $result->dnm_id."_".($result->dnm_price+$random)), CHtml::encode($result->dnm_nominal." ~> ".($result->dnm_price+$random)), true);
        }

        // generate parameter untuk key random
        echo "%".Nourut::enHash($random);
	}

	public function actionStep1()
	{
		$session = Yii::app()->session['keySalt'];

		if($_POST['keystore'] == $session && $_POST['keyhash'] != "" && $_POST['keyhash'] != 0){

			$splitDenom = explode("_", $_POST['nominal']);
			$getDenomNominal = Denom::model()->findByPk($splitDenom[0]);
			$getOperator = Operator::model()->findByPk($_POST['provider']);
			$getKategori = Kategori::model()->findByPk($_POST['kategori']);

			// cari . di nomor tlp
			$cariTitik = strpos($_POST['nomor'], ".");
			if($cariTitik !== false ) {
				$splitNomor = explode(".", $_POST['nomor']);
				$nomor = $splitNomor[0];
				$desc = $splitNomor[1];
			} else {
				$nomor = $_POST['nomor'];
				$desc = "-";
			}

			// re get keyhash
			$random = Nourut::deHash($_POST['keyhash']);

			// simpan order
			$order = new Order;
			$order->opt_id = $getOperator->opt_id;
			$order->opt_code = $getOperator->opt_code;
			$order->dnm_nominal	 = $getDenomNominal->dnm_nominal;
			$order->ord_dest = $nomor;
			$order->ord_date = date("Y-m-d H:i:s");
			$order->ord_bayar = $getDenomNominal->dnm_price + $random;
			$order->ord_bank = $_POST['bank'];
			$order->ord_desc = $desc;
			$order->ord_status = "waiting";

			if($order->save()){
				/* 
				keterangan response :
				1. id order
				2. nominal voucher
				3. nominal setelah generate
				4. nama operator
				5. nomor tujuan
				6. nama kategori
				7. bank
				8. keystore
				9. status
				*/

				echo $order->ord_id."_".
					 MyFormatter::rupiah($getDenomNominal->dnm_nominal)."_".
					 ($getDenomNominal->dnm_price + $random)."_".
					 $getOperator->opt_name."_".
					 $nomor."_".
					 $getKategori->ktg_nama."_".
					 $_POST['bank']."_".
					 md5(sha1($_POST['keystore']))."_".
					 "waiting";
			} else {
				echo "error1";
			}
		} else {
			echo "error2";
		}
	}


	public function actionStep3()
	{
		$getData = Order::model()->findByPk($_POST['count']);
		if(count($getData) > 0){
			echo $getData->ord_status;
		} else {
			echo "not found";
		}
	}


	public function actionHapus($order, $hash, $token)
	{
		$session = Yii::app()->session['keySalt'];
		if($token == md5(sha1($session))){
			Order::model()->findByAttributes(array("ord_id" => $order, "ord_bayar" => $hash))->delete();
		}
		$this->redirect(array('/go/home'));
	}


	public function actionCekOrder()
	{
		$session = Yii::app()->session['keySalt'];
		if($_POST['keystore'] == $session){

			$getOrder = Order::model()->findByAttributes(array('ord_dest' => $_POST['cariNo']), array('order' => 
				'ord_id desc'));

			if(count($getOrder) > 0){
				
				$getOperator = Operator::model()->findByAttributes(array('opt_id' => $getOrder->opt_id));
				$getKategori = Kategori::model()->findByPk($getOperator->ktg_id);

				/* 
				keterangan response :
				1. tanggal order
				2. nama kategori
				3. nama operator
				4. nominal order
				5. nomor tujuan
				6. nama kategori
				7. bank
				8. status
				9. id order
				*/

				echo MyFormatter::formatDateTimeFormat($getOrder->ord_date)."_".
					 $getKategori->ktg_nama."_".
					 $getOperator->opt_name."_".
					 MyFormatter::rupiah($getOrder->dnm_nominal)."_".
					 $_POST['cariNo']."_".
					 "Rp. ".MyFormatter::rupiah($getOrder->ord_bayar)."_".
					 $getOrder->ord_bank."_".
					 $getOrder->ord_status."_".
					 $getOrder->ord_id;
			} else {
				echo "empty";
			}
		} else {
			echo "error";
		}
	}


	public function actionOrderAll()
	{
		$getOrder = Order::model()->findAllByAttributes(array(), array('limit' => 20, 'order' => 'ord_id desc'));

		$listdata = array();
		$i = 0;
		foreach($getOrder as $result)
		{
		    $getProduk = Operator::model()->findByAttributes(array('opt_id' => $result->opt_id));

		    $listdata[$i]['ord_id'] = $result->ord_id;
		    $listdata[$i]['ord_date'] = MyFormatter::formatDateNoYear($result->ord_date);
		    $listdata[$i]['ord_dest'] = substr($result->ord_dest, 0, -4)."xxxx";
		    $listdata[$i]['ord_bayar'] = $result->ord_bayar;
		    $listdata[$i]['ord_bank'] = $result->ord_bank=="mandiri"?"Mandiri":"BCA";
		    $listdata[$i]['ord_status'] = $result->ord_status;
		    $listdata[$i]['opt_code'] = $getProduk->opt_name;
		    $i++;
		}

		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Records'] = $listdata;
		echo json_encode($jTableResult);
		//var_dump($listdata);
	}
}