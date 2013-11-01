<?php

class NodeController extends Controller
{
	public function actionIndex()
	{
		$this->redirect(array(Yii::app()->baseUrl));
	}

	public function actionGetprovider()
	{
		$criteria=new CDbCriteria;
	   	$criteria->condition = 'ktg_id = :ktgid AND opt_status = :status';
	   	$criteria->params = array(':ktgid' => $_POST['ktgId'], ':status' => 'lancar');
	   	$criteria->order = 'opt_name ASC';

		$model = Operator::model()->findAll($criteria);

		$listdata = CHtml::listData($model, 'opt_code', 'opt_name');
        echo CHtml::tag('option', array('value' => ''), CHtml::encode("- Pilih Provider -"), true);
        
        foreach ($listdata as $value => $name) {
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        }
	}

	public function actionGetnominal()
	{
		$criteria=new CDbCriteria;
	   	$criteria->condition = 'opt_code = :pvdid';
	   	$criteria->params = array(':pvdid' => $_POST['pvdId']);
	   	$criteria->order = 'dnm_nominal ASC';

		$model = Denom::model()->findAll($criteria);
		$random = mt_rand(32, 128);
		
        echo CHtml::tag('option', array('value' => ''), CHtml::encode("- Pilih Nominal -"), true);
        
        foreach ($model as $result) {
            echo CHtml::tag('option', array('value' => $result->dnm_id), CHtml::encode($result->dnm_nominal." ~> ".($result->dnm_price+$random)), true);
        }
	}
}