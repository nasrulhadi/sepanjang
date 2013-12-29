<?php

class OrderController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionSemua()
	{
		$this->render('semua');
	}
}