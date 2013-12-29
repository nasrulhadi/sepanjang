<?php

class PanduanController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionFaq()
	{
		$this->render('faq');
	}
}