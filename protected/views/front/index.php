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
			<li class="active"><a href="<?php echo Yii::app()->baseUrl."/go/home"; ?>"><?php echo json_decode(Options::GetOptions("web_name"))->{"value"}; ?></a></li>
			<li><?php echo CHtml::link('Status Order', array('/halaman/order')); ?></li>
			<li><?php echo CHtml::link('Konfirmasi Pembayaran', array('/halaman/konfirmasi')); ?></li>
			<li><?php echo CHtml::link('Total Donasi', array('/halaman/donasi')); ?></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li class="dropdown">
				<a href="#" class="dropdown-toggle geser-kiri-40" data-toggle="dropdown">
					<span class="glyphicon glyphicon-comment"></span> &nbsp; Bisa Dibantu ? <b class="caret"></b>
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
					<li><?php echo CHtml::link('<span class="glyphicon glyphicon-check"></span> &nbsp; Tata Cara Pembelian', array('/halaman/panduan')); ?></li>
					<li><?php echo CHtml::link('<span class="glyphicon glyphicon-question-sign"></span> &nbsp; Pertanyaan Umum', array('/halaman/faq')); ?></li>
					<li class="divider"></li>

					<li class="dropdown-header">Informasi Sistem</li>
					<li><?php echo CHtml::link('<span class="glyphicon glyphicon-hdd"></span> &nbsp; Status Server', array('/halaman/sistem')); ?></li>
					<li><?php echo CHtml::link('<span class="glyphicon glyphicon-saved"></span> &nbsp; Total Transaksi', array('/halaman/sistem/transaksi')); ?></li>
				</ul>
			</li>
		</ul>
	</div>
</div>

<!-- content -->
<section class="main-content">
	<div class="container clearfix">
		<div class="form-box">
			<?php 
			$form=$this->beginWidget('CActiveForm', array(
				'id'=>'step1-form',
				'enableAjaxValidation'=>false,
				'htmlOptions'=>array('class'=>'form-form', 'role' => 'form')
			)); 
			?>
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
					<input type="text" name="nomor" id="nomor" class="form-control form-input-nomor" placeholder="08123456xxxx" maxlength="19" disabled>
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
						<?php
						if(Yii::app()->session['keySalt'] == ""){
							Yii::app()->session['keySalt'] = Options::model()->getSession();
						} 
						echo CHtml::hiddenField('keystore', Yii::app()->session['keySalt']); 
						?>
						<input type="submit" id="tombolProses" data-loading-text="Tunggu..." class="btn btn-success" value="Proses" disabled >
					</div>
				</fieldset>
			<?php 
			$this->endWidget();

			$form=$this->beginWidget('CActiveForm', array(
				'id'=>'step2-form',
				'enableAjaxValidation'=>false,
				'htmlOptions'=>array('class'=>'form-form', 'role' => 'form')
			)); 
			?>
				<fieldset id="step-2" style="display:none">
					<legend class="form-color-random">Selangkah Lagi</legend>
					<h3 class="form-step2"><span class="form-color-random">Voucher</span> <div class="pull-right"><strong><div id="voucherStep2"></div></strong></div></h3>
					<h3 class="form-step2"><span class="form-color-random">Nominal</span> <div class="pull-right"><strong><div id="operatorStep2"></div></strong></div></h3>
					<h3 class="form-step2"><span class="form-color-random">Nomor</span> <div class="pull-right"><strong><div id="nomorStep2"></div></strong></div></h3>
					<hr class="hr-border"></hr>

					<h3 class="form-total-label"><span class="form-color-random">Total Tagihan</span> <div class="pull-right"><strong class="form-total-nominal"><div id="tagihanStep2"></div></strong></div></h3>
					<hr class="hr-border"></hr>
					<?php
					$bank_name = json_decode(Options::GetOptions("bank_name"), true);
					foreach ($bank_name as $result) {
						echo '<div id="bank_'.strtolower($result['initial']).'" class="form-bank-detail-update" style="display:none">';
						echo '<div class="'.strtolower($result['initial']).' icons-bank" title="'.$result['value'].'"></div>';
						echo '<div><p class="tebal"><span class="profil">a/n</span> '.ucwords(strtolower($result['nama'])).'<br><span class="profil">rekening</span> '.$result['rekening'].'</p></div>';
						echo '</div>';
					}
					?>
					<hr class="hr-border"></hr>
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
					<h3 class="form-step2"><span class="form-color-random">Voucher</span> <div class="pull-right"><strong><div id="voucherStep3"></div></strong></div></h3>
					<h3 class="form-step2"><span class="form-color-random">Nominal</span> <div class="pull-right"><strong><div id="operatorStep3"></div></strong></div></h3>
					<h3 class="form-step2"><span class="form-color-random">Nomor</span> <div class="pull-right"><strong><div id="nomorStep3"></div></strong></div></h3>
					<hr class="hr-border"></hr>

					<h3 class="form-total-label"><span class="form-color-random">Status</span> <div class="pull-right"><strong id="statusOrder" class="form-total-nominal"></strong></div></h3>
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
					<?php echo CHtml::hiddenField('counter', '0'); ?>
					<?php echo CHtml::link('Order lagi?', array('/go/home'), array('class' => 'btn btn-default')); ?>
					<div class="pull-right">
						<button type="button" id="tombolCekStatus" data-loading-text="Tunggu..." class="btn btn-success">Periksa Status</button>
					</div>
				</fieldset>
			<?php $this->endWidget(); ?>
		</div>

		<div id="batalkanpesanan" class="modal fade" tabindex="-1" data-width="500" style="display: none;">
			<div class="modal-body">
				<p>Bantu Kami <strong>menghapus</strong> data ini jika Anda merasa pesanan yang Anda tentukan tidak sesuai atau salah. </p>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn btn-default">Batal Menghapus</button>
				<a href="<?php echo Yii::app()->baseUrl; ?>/go/home/" id="bantuHapus" class="btn btn-danger">Hapus Sekarang</a>
			</div>
		</div>

		<div id="steperror" class="modal fade" tabindex="-1" data-width="500" style="display: none;">
			<div class="modal-body">
				<p id="errormsg"></p>
			</div>
			<div class="modal-footer">
				<a href="<?php echo Yii::app()->baseUrl."/go/home"; ?>" class="btn btn-danger">Halaman Depan</a>
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