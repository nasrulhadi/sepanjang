<?php

class GoController extends Controller
{
	public function actionIndex()
	{
		$this->redirect(array('/go/home'));
	}

	public function actionHome()
	{
		Yii::app()->session['keySalt'] = Options::model()->getSession();
		$this->redirect(Yii::app()->request->getBaseUrl(true));
	}
}