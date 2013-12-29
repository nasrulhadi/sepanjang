<?php

class KonfirmasiController extends Controller
{
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
				'height'=>45,
				'maxLength'=>5,
				'minLength'=>4
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	public function actionIndex()
	{
		$model=new Konfirmasi;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Konfirmasi']))
        {
            if($_POST['Konfirmasi']['knf_date'] == "kemarin"){
				$tanggal = date('Y-m-d', time() - ((60*60*24)*1));
			}else{
				$tanggal = date('Y-m-d');			
			}

			$criteria=new CDbCriteria;
	   		$criteria->condition = "ord_dest = '".$_POST['Konfirmasi']['nomor']."' AND ord_bank = '".$_POST['Konfirmasi']['bank']."' AND dnm_nominal = '".$_POST['Konfirmasi']['knf_nominal']."' AND DATE(ord_date) = '".$tanggal."'";
	   		$criteria->order = "ord_id DESC";
	   		$periksa = Order::model()->find($criteria);

	   		
	   		if(count($periksa) == 1){
	   			$orderId = $periksa->ord_id;
	   		}else {
	   			$orderId = 0;
	   		}

   			$model->attributes=$_POST['Konfirmasi'];
            $model->ord_id = $orderId;
            $model->knf_date = date("Y-m-d H:i:s");
            $model->knf_buyer = $_POST['Konfirmasi']['knf_buyer'];
            $model->knf_nominal = $_POST['Konfirmasi']['knf_nominal'];
            if($model->save()){
                Yii::app()->user->setFlash('info',  MyFormatter::alertSuccess('Terima Kasih, konfirmasi ini akan segera Kami proses.'));
                $this->redirect(array('index'));
            }
        }

        $this->render('index',array(
            'model'=>$model,
        ));
	}


	public function actionStruk()
	{
		$model=new Konfirmasi;

        $this->render('struk',array(
            'model'=>$model,
        ));
	}
}