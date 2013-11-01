<!-- navbar -->
<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
	</div>
	<div class="collapse navbar-collapse">
		<ul class="nav navbar-nav">
			<li class="active"><a href="<?php $baseUrl = Yii::app()->baseUrl; ?>"><?php echo json_decode(Options::GetOptions("web_name"))->{"value"}; ?></a></li>
			<li><a href="#status">Status Order</a></li>
			<li><a href="#konfirmasi">Konfirmasi Pembayaran</a></li>
			<li><a href="#harga">Total Donasi</a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li class="dropdown">
				<a href="#" class="dropdown-toggle geser-kiri-40" data-toggle="dropdown">
					<span class="glyphicon glyphicon-comment"></span> &nbsp; Perlu Bantuan ? <b class="caret"></b>
				</a>
				<ul class="dropdown-menu">
					<li class="dropdown-header">Kami Siap Membantu</li>
					<?php
					$yahoo_mess = json_decode(Options::GetOptions("yahoo"), true);
					foreach ($yahoo_mess as $result) {
						echo '<li><a href="ymsgr:sendIM?'.$result['value'].'"><img src="http://opi.yahoo.com/online?u='.$result['value'].'&amp;m=g&amp;t=1&amp;l=us" alt="'.$result['value'].'"/> &nbsp; '.$result['keterangan'].'</a></li>';
					}
					?>
					<li class="divider"></li>

					<li class="dropdown-header">Panduan Pembelian</li>
					<li><a href="#halamantutor"><span class="glyphicon glyphicon-check"></span> &nbsp; Tata Cara Pembelian</a></li>
					<li><a href="#halamanfaq"><span class="glyphicon glyphicon-question-sign"></span> &nbsp; Pertanyaan yg Sering Diajukan</a></li>
					<li class="divider"></li>

					<li class="dropdown-header">Informasi Sistem</li>
					<li><a href="server.html"><span class="glyphicon glyphicon-hdd"></span> &nbsp; Status Server</a></li>
					<li><a href="#totaltransaksi"><span class="glyphicon glyphicon-saved"></span> &nbsp; Total Transaksi</a></li>
				</ul>
			</li>
		</ul>
	</div>
</div>

<!-- content -->
<section class="main-content">
	<div class="container clearfix">
		<div class="form-box">
			<form action="#" method="post" class="form-form" role="form">
				<fieldset id="step-1">
					<legend class="form-color-random">Pesan Sekarang!</legend>
					<h3><span class="form-color-random">01.</span> Pilih Voucher</h3>
					<?php
					$kategori = CHtml::listData(Kategori::model()->findAll(array('order'=>'ktg_id')),'ktg_id','ktg_nama');
					echo CHtml::dropDownList('kategori','',$kategori,
						array(
							'empty' => '- Pilih Voucher -',
							'class' => 'form-control form-input-voucher',
							'ajax' => array(
								'type'=>'POST',
								'data'=>array('ktgId' => 'js:this.value'),
								'url'=>CController::createUrl('/node/getprovider'),
								'update'=>'#provider', 
								'success'=>'function(data){
									$("#provider").html(data);
								}'
							),
					  ));
		        	?>
					<div class="form-input-provider" style="display:none">
						<?php
						echo CHtml::dropDownList('provider','',array("- Pilih Provider -"),
							array(
								'class' => 'form-control form-input-providers',
								'ajax' => array(
									'type'=>'POST',
									'data'=>array('pvdId' => 'js:this.value'),
									'url'=>CController::createUrl('/node/getnominal'),
									'update'=>'#nominal', 
									'success'=>'function(data){
										$("#nominal").html(data);
									}'
								),
						  ));
						?>
					</div>
					<div class="form-input-nominal" style="display:none">
						<?php
						echo CHtml::dropDownList('nominal','',array("- Pilih Nominal -"), array('class' => 'form-control form-input-nominals'));
						?>
					</div>                            
					<hr class="hr-border"></hr>

					<h3><span class="form-color-random">02.</span> Masukan Nomor</h3>
					<input type="text" name="nomor" id="nomor" class="form-control form-input-nomor" placeholder="08123456xxxx" maxlength="30" disabled>
					<hr class="hr-border"></hr>

					<h3><span class="form-color-random">03.</span> <span class="form-color-random form-input-terakhir"></span> Bank Tujuan Transfer</h3>
					<label class="radio-inline">
						<input type="radio" id="bank" class="form-input-bank" name="bank" value="bca" disabled> <strong>BCA</strong>
					</label>
					<label class="radio-inline">
						<input type="radio" id="bank" class="form-input-bank" name="bank" value="mandiri" disabled> <strong>Mandiri</strong>
					</label>
					<div class="clearfix"></div>
					<div class="pull-right">
						<button type="button" id="tombolProses" data-loading-text="Tunggu..." class="btn btn-success" disabled>Proses</button>
					</div>
				</fieldset>

				<fieldset id="step-2" style="display:none">
					<legend class="form-color-random">Selangkah Lagi</legend>
					<h3 class="form-step2"><span class="form-color-random">Voucher</span> <div class="pull-right"><strong>Pulsa Elektrik</strong></div></h3>
					<h3 class="form-step2"><span class="form-color-random">Nominal</span> <div class="pull-right"><strong>M3 10.000</strong></div></h3>
					<h3 class="form-step2"><span class="form-color-random">Nomor</span> <div class="pull-right"><strong>087852773907</strong></div></h3>
					<hr class="hr-border"></hr>

					<h3 class="form-total-label"><span class="form-color-random">Total Tagihan</span> <div class="pull-right"><strong class="form-total-nominal">10.702</strong></div></h3>
					<hr class="hr-border"></hr>
					<div class="form-bank-detail">
						<?php
						$bank_name = json_decode(Options::GetOptions("bank_name"), true);
						foreach ($bank_name as $result) {
							if($result['value'] == "BCA"){
								echo $result['value'].'<span>/</span> '.$result['nama'].' <span>/</span>'.$result['rekening'];
							}
						}
						?>
					</div>
					<p class="form-color-random form-keterangan-title"><strong>Keterangan</strong></p>
					<ol class="form-keterangan">
						<?php
						$home_info_step2 = json_decode(Options::GetOptions("home_info_step2"), true);
						foreach ($home_info_step2 as $result) {
							echo '<li>'.$result['value'].'</li>';
						}
						?>
					</ol>

					<div class="clearfix"></div>
					<div class="form-batal-order">
						<a href="#batalkanpesanan" id="hapusOrder" data-toggle="modal">Batal Order?</a>
					</div>
					<div class="pull-right">
						<button type="button" id="tombolTerimaKasih" data-loading-text="Tunggu..." class="btn btn-success">Terima Kasih</button>
					</div>
				</fieldset>

				<fieldset id="step-3" style="display:none">
					<legend class="form-color-random">Periksa Status Order</legend>
					<h3 class="form-step2"><span class="form-color-random">Voucher</span> <div class="pull-right"><strong>Pulsa Elektrik</strong></div></h3>
					<h3 class="form-step2"><span class="form-color-random">Nominal</span> <div class="pull-right"><strong>M3 10.000</strong></div></h3>
					<h3 class="form-step2"><span class="form-color-random">Nomor</span> <div class="pull-right"><strong>087852773907</strong></div></h3>
					<hr class="hr-border"></hr>

					<h3 class="form-total-label"><span class="form-color-random">Status</span> <div class="pull-right"><strong class="form-total-nominal text-info">Proses</strong></div></h3>
					<hr class="hr-border"></hr>

					<p class="form-color-random form-keterangan-title"><strong>Keterangan</strong></p>
					<ol class="form-keterangan">
						<?php
						$home_info_step3 = json_decode(Options::GetOptions("home_info_step3"), true);
						foreach ($home_info_step3 as $result) {
							echo '<li>'.$result['value'].'</li>';
						}
						?>
					</ol>

					<div class="clearfix"></div>
					<a href="./" class="btn btn-default">Halaman Utama</a>
					<div class="pull-right">
						<button type="button" id="tombolCekStatus" data-loading-text="Tunggu..." class="btn btn-success">Cek Status</button>
					</div>
				</fieldset>
			</form>
		</div>

		<div id="batalkanpesanan" class="modal fade" tabindex="-1" data-width="500" style="display: none;">
			<div class="modal-body">
				<p>Bantu Kami <strong>menghapus</strong> data ini jika Anda merasa pesanan yang Anda tentukan tidak sesuai atau salah. </p>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn btn-default">Batal Menghapus</button>
				<button type="button" data-dismiss="modal" class="btn btn-danger">Hapus Sekarang</button>
			</div>
		</div>

	</div>
</section>

<!-- footer -->
<footer>
    <div class="container">
        <div class="pull-right button-footer col-md-6">
            <div class="info-footer get-popover-bg" data-toggle="popover" data-container="body" data-placement="top" data-trigger="hover" data-html="true" data-delay="{ show: 300, hide: 100 }"></div>
            <div id="next" class="next-footer"></div>
            <div id="back" class="back-footer"></div>
            <div class="copyright-footer get-popover-copy" data-toggle="popover"></div>
        </div>
    </div>
</footer>