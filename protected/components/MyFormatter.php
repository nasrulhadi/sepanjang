<?php
class MyFormatter extends CFormatter
{   
	public static function alertInfo($message)
	{
		return '<div class="alert alert-info"><button type="button" class="close" data-dismiss="alert">×</button>'.$message.'</div>';
	}
	
	public static function alertWarning($message)
	{
		return '<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert">×</button>'.$message.'</div>';
	}
	
	public static function alertError($message)
	{
		return '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>'.$message.'</div>';
	}
	
	public static function alertSuccess($message)
	{
		return '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>'.$message.'</div>';
	}

	public static function formatDateFormat($value)
	{
		$date = explode('-',$value);
		$bulan = '';
		switch($date[1])
		{
			case '01':
			$bulan = 'Januari';
			break;
			case '02':
			$bulan = 'Februari';
			break;
			case '03':
			$bulan = 'Maret';
			break;
			case '04':
			$bulan = 'April';
			break;
			case '05':
			$bulan = 'Mei';
			break;
			case '06':
			$bulan = 'Juni';
			break;
			case '07':
			$bulan = 'Juli';
			break;
			case '08':
			$bulan = 'Agustus';
			break;
			case '09':
			$bulan = 'September';
			break;
			case '10':
			$bulan = 'Oktober';
			break;
			case '11':
			$bulan = 'Nopember';
			break;
			case '12':
			$bulan = 'Desember';
			break;
		}
		
		return substr($date[2],0,2).' '.$bulan.' '.$date[0];
	}
	
	public function formatDateTimeFormat($value)
	{
		$date = explode('-',$value);
		$bulan = '';
		switch($date[1])
		{
			case '01':
			$bulan = 'Januari';
			break;
			case '02':
			$bulan = 'Februari';
			break;
			case '03':
			$bulan = 'Maret';
			break;
			case '04':
			$bulan = 'April';
			break;
			case '05':
			$bulan = 'Mei';
			break;
			case '06':
			$bulan = 'Juni';
			break;
			case '07':
			$bulan = 'Juli';
			break;
			case '08':
			$bulan = 'Agustus';
			break;
			case '09':
			$bulan = 'September';
			break;
			case '10':
			$bulan = 'Oktober';
			break;
			case '11':
			$bulan = 'Nopember';
			break;
			case '12':
			$bulan = 'Desember';
			break;
		}
		
		return substr($date[2],0,2).' '.$bulan.' '.$date[0].' '. date('H:i', strtotime($value)).' WIB';
	}


	public function formatDateNoYear($value)
	{
		$date = explode('-',$value);
		$bulan = '';
		switch($date[1])
		{
			case '01':
			$bulan = 'Januari';
			break;
			case '02':
			$bulan = 'Februari';
			break;
			case '03':
			$bulan = 'Maret';
			break;
			case '04':
			$bulan = 'April';
			break;
			case '05':
			$bulan = 'Mei';
			break;
			case '06':
			$bulan = 'Juni';
			break;
			case '07':
			$bulan = 'Juli';
			break;
			case '08':
			$bulan = 'Agustus';
			break;
			case '09':
			$bulan = 'September';
			break;
			case '10':
			$bulan = 'Oktober';
			break;
			case '11':
			$bulan = 'Nopember';
			break;
			case '12':
			$bulan = 'Desember';
			break;
		}
		
		return substr($date[2],0,2).' '.$bulan.' &nbsp;&nbsp; @ '. date('H:i', strtotime($value)).' WIB';
	}

	public static function formatBulanIndonesia()
	{
		$date = date("m");
		$bulan = '';
		switch($date)
		{
			case '01':
			$bulan = 'Januari';
			break;
			case '02':
			$bulan = 'Februari';
			break;
			case '03':
			$bulan = 'Maret';
			break;
			case '04':
			$bulan = 'April';
			break;
			case '05':
			$bulan = 'Mei';
			break;
			case '06':
			$bulan = 'Juni';
			break;
			case '07':
			$bulan = 'Juli';
			break;
			case '08':
			$bulan = 'Agustus';
			break;
			case '09':
			$bulan = 'September';
			break;
			case '10':
			$bulan = 'Oktober';
			break;
			case '11':
			$bulan = 'Nopember';
			break;
			case '12':
			$bulan = 'Desember';
			break;
		}
		
		return $bulan;
	}

	public static function rupiah($nominal) { 
		$rupiah =  number_format($nominal,0, ",","."); 
		//$rupiah = "Rp "  . $rupiah . ",-"; 
		return $rupiah; 
	}

	function terbilang($bilangan){
		
		$angka = array('0','0','0','0','0','0','0','0','0','0',
			'0','0','0','0','0','0');
		$kata = array('','satu','dua','tiga','empat','lima',
			'enam','tujuh','delapan','sembilan');
		$tingkat = array('','ribu','juta','milyar','triliun');
		
		$panjang_bilangan = strlen($bilangan);
		
		/* pengujian panjang bilangan */
		if ($panjang_bilangan > 15) {
			$kalimat = "Diluar Batas";
			return $kalimat;
		}
		
		  /* mengambil angka-angka yang ada dalam bilangan,
		  dimasukkan ke dalam array */
		  for ($i = 1; $i <= $panjang_bilangan; $i++) {
		  	$angka[$i] = substr($bilangan,-($i),1);
		  }
		  
		  $i = 1;
		  $j = 0;
		  $kalimat = "";
		  
		  
		  /* mulai proses iterasi terhadap array angka */
		  while ($i <= $panjang_bilangan) {
		  	
		  	$subkalimat = "";
		  	$kata1 = "";
		  	$kata2 = "";
		  	$kata3 = "";
		  	
		  	/* untuk ratusan */
		  	if ($angka[$i+2] != "0") {
		  		if ($angka[$i+2] == "1") {
		  			$kata1 = "seratus";
		  		} else {
		  			$kata1 = $kata[$angka[$i+2]] . " ratus";
		  		}
		  	}
		  	
		  	/* untuk puluhan atau belasan */
		  	if ($angka[$i+1] != "0") {
		  		if ($angka[$i+1] == "1") {
		  			if ($angka[$i] == "0") {
		  				$kata2 = "sepuluh";
		  			} elseif ($angka[$i] == "1") {
		  				$kata2 = "sebelas";
		  			} else {
		  				$kata2 = $kata[$angka[$i]] . " belas";
		  			}
		  		} else {
		  			$kata2 = $kata[$angka[$i+1]] . " puluh";
		  		}
		  	}
		  	
		  	/* untuk satuan */
		  	if ($angka[$i] != "0") {
		  		if ($angka[$i+1] != "1") {
		  			$kata3 = $kata[$angka[$i]];
		  		}
		  	}
		  	
			/* pengujian angka apakah tidak nol semua,
			lalu ditambahkan tingkat */
			if (($angka[$i] != "0") OR ($angka[$i+1] != "0") OR
				($angka[$i+2] != "0")) {
				$subkalimat = "$kata1 $kata2 $kata3 " . $tingkat[$j] . " ";
		}
		
			/* gabungkan variabe sub kalimat (untuk satu blok 3 angka)
			ke variabel kalimat */
			$kalimat = $subkalimat . $kalimat;
			$i = $i + 3;
			$j = $j + 1;
			
		}
		
		/* mengganti satu ribu jadi seribu jika diperlukan */
		if (($angka[5] == "0") AND ($angka[6] == "0")) {
			$kalimat = str_replace("satu ribu","seribu",$kalimat);
		}
		
		return trim($kalimat);
		
	}
}
?>