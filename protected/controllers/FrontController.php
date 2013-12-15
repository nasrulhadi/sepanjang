<?php

class FrontController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionComponent()
	{
		$this->layout = '//layouts/blankLayout';
		$this->render('component');
	}
}