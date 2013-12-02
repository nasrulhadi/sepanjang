<?php

class SistemController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionTransaksi()
	{
		$this->render('transaksi');
	}
}