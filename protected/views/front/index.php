<!-- navbar -->
<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
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
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					Menu Lainnya <b class="caret"></b>
				</a>
				<ul class="dropdown-menu">
					<li><?php echo CHtml::link('<span class="glyphicon glyphicon-gift"></span> &nbsp; Total Donasi', array('/halaman/donasi')); ?></li>
					<li class="divider"></li>

					<li><?php echo CHtml::link('<span class="glyphicon glyphicon-transfer"></span> &nbsp; Semua Order', array('/halaman/order/semua')); ?></li>
					<li class="divider"></li>

					<li class="dropdown-header">Panduan Pembelian</li>
					<li><?php echo CHtml::link('<span class="glyphicon glyphicon-tag"></span> &nbsp; Langkah - Langkah', array('/halaman/panduan')); ?></li>
					<li><?php echo CHtml::link('<span class="glyphicon glyphicon-tags"></span> &nbsp; Pertanyaan Umum', array('/halaman/panduan/faq')); ?></li>
					<li class="divider"></li>

					<li class="dropdown-header">Informasi Sistem</li>
					<li><?php echo CHtml::link('<span class="glyphicon glyphicon-hdd"></span> &nbsp; Status Server', array('/halaman/sistem')); ?></li>
					<li><?php echo CHtml::link('<span class="glyphicon glyphicon-saved"></span> &nbsp; Total Transaksi', array('/halaman/sistem/transaksi')); ?></li>
				</ul>
			</li>
		</ul>
		<ul class="nav navbar-nav navbar-right hidden-xs">
			<li class="mb-20">
				<a href="#tampilkan-help" id="helpCenter" class="help-center geser-kiri-40" data-toggle="modal">
					<span class="glyphicon glyphicon-comment"></span> &nbsp; Bisa Dibantu ?
				</a>
			</li>
		</ul>
	</div>
</div>

<!-- content -->
<section class="main-content">
	<div class="container clearfix">

		<div class="form-box" style="position: absolute;">
			<div class="form-order form-widget masonry-brick" style="position: absolute; top: 0px; left: 0px;">
	            <p>Order</p>
	            <a href="#">Terbaru</a>
	            <div class="form-content">
	                <div class="form-content-tab">
	                    <p id="form-tagline">- Tentukan, transfer & terima pulsanya -</p>
	                    <p id="form-tagline" class="hidden">- Karena berbagi bisa memperkaya hati -</p>
	                    <img src="http://farm6.staticflickr.com/5324/9852795376_75acd0c8b8_o.jpg" class="form-img-donasi hidden">

	                    <!-- step1 -->
	                    <?php 
						$form=$this->beginWidget('CActiveForm', array(
							'id'=>'step1-form',
							'enableAjaxValidation'=>false,
							'htmlOptions'=>array('class'=>'', 'role' => 'form')
						)); 
						?>
							<p class="row_full">
	                            <label for="kategori">Voucher:</label>
	                            <!-- kategori -->
	                            <?php
								$criteria=new CDbCriteria;
							   	$criteria->condition = 'ktg_status = :status';
							   	$criteria->params = array(':status' => 1);
							   	$criteria->order = 'ktg_id';
								$kategori = CHtml::listData(Kategori::model()->findAll($criteria),'ktg_id','ktg_nama');
								echo CHtml::dropDownList('kategori','',$kategori,
									array(
										'empty' => '–',
										'class' => 'form-input-voucher',
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

					        </p>
					        <p class="row_half" id="form-input-provider" style="display:none">
					        	<!-- provider -->
								<?php
								echo CHtml::dropDownList('provider','',array("–"),
									array(
										'class' => 'form-input-provider',
										'ajax' => array(
											'type'=>'POST',
											'data'=>array('pvdId' => 'js:this.value'),
											'url'=>CController::createUrl('/node/getnominal'),
											'update'=>'#nominal', 
											'success'=>'function(data){
												var splitNominal = data.split("%");
												$("#nominal").html(splitNominal[0]);
												$("#keyhash").val(splitNominal[1]);
											}'
										),
								  ));
								?>

							</p>
					        <p class="row_half" id="form-input-nominal" style="display:none">
								<!-- nominal -->
								<?php
								echo CHtml::dropDownList('nominal','',array("–"), 
									array(
										'class' => 'form-input-nominal',
										)
									);
								?>

	                        </p>
	                        <p class="row_full">
	                        	<!-- nomor -->
	                            <label for="nomor">Nomor:</label>
	                            <input type="text" name="nomor" id="nomor" class="form-input-nomor" placeholder="0812345678xx" maxlength="20" disabled>
	                        </p>
	                        
	                        <p class="row_full">
	                        	<!-- bank transfer -->
	                            <label for="brand">Bank Transfer:</label>
	                            <label class="radio-inline" style="display: inline-block;">
									<input type="radio" id="bank" class="form-input-bank" name="bank" value="bca" disabled> <strong class="form-bank">BCA</strong>
								</label>
								<label class="radio-inline" style="display: inline-block;">
									<input type="radio" id="bank" class="form-input-bank" name="bank" value="mandiri" disabled> <strong class="form-bank">Mandiri</strong>
								</label>
	                        </p>

	                        <p class="submit_field row_full">
	                            <input type="submit" id="tombolProses" data-loading-text="Tunggu..." value="Selanjutnya" disabled >
	                            <?php
								if(Yii::app()->session['keySalt'] == ""){
									Yii::app()->session['keySalt'] = Options::model()->getSession();
								} 
								echo CHtml::hiddenField('keystore', Yii::app()->session['keySalt']); 
								echo CHtml::hiddenField('keyhash', "0"); 
								?>
	                        </p>
	                        <div style="clear:both;"></div>
	                    <?php 
						$this->endWidget();
						?>


	                    <!-- step2 -->
						<?php 
						$form=$this->beginWidget('CActiveForm', array(
							'id'=>'step2-form',
							'enableAjaxValidation'=>false,
							'htmlOptions'=>array('class'=>'', 'role' => 'form')
						)); 
						?>
							<p class="tac" style="color: #242424;">Seluruh hasil Donasi akan di serahkan kepada <a href="http://www.sschildsurabaya.com" target="_blank">Surabaya Save Child</a> setiap akhir bulan.</p>
                            <div class="clearfix"></div>
                            <div class="center-block mt-10 mb-20">
	                            <div class="form-box-donasi well well-sm tac inline nmb kanan-7">
	                            	<label class="nmb">
										<strong class="form-donasi rupiah block mb-10">Rp. 100,-</strong>
										<input type="radio" id="donasi" class="form-input-donasi" name="donasi" value="100"> 
									</label>
	                            </div>
	                            <div class="form-box-donasi well well-sm tac inline nmb kanan-7">
	                            	<label class="nmb">
										<strong class="form-donasi rupiah block mb-10">Rp. 1000,-</strong>
										<input type="radio" id="donasi" class="form-input-donasi" name="donasi" value="1000">
									</label>
	                            </div>
	                            <div class="form-box-donasi well well-sm tac inline nmb">
	                            	<label class="nmb">
										<strong class="form-donasi rupiah block mb-10">Rp. 2500,-</strong>
										<input type="radio" id="donasi" class="form-input-donasi" name="donasi" value="2500">
									</label>
	                            </div>
	                        </div>                                                    
	                        <div class="clearfix"></div>

	                        <p class="submit_field row_full">
	                            <input type="submit" id="tombolProses2" data-loading-text="Tunggu..." value="Proses" disabled >
	                        </p>
	                        <div class="clearfix"></div>
	                    <?php 
						$this->endWidget();
						?>
	                </div>
	            </div>
	        </div>
	    </div>


		<!-- 
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
					<noscript><div class="alert alert-danger">Sebelum melakukan order, aktifkan dulu <strong>javascript</strong> di browser Anda.</div></noscript>
					<h3><span class="form-color-random">01.</span> Pilih Voucher</h3>
					<?php
					$criteria=new CDbCriteria;
				   	$criteria->condition = 'ktg_status = :status';
				   	$criteria->params = array(':status' => 1);
				   	$criteria->order = 'ktg_id';
					$kategori = CHtml::listData(Kategori::model()->findAll($criteria),'ktg_id','ktg_nama');
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
										var splitNominal = data.split("%");
										$("#nominal").html(splitNominal[0]);
										$("#keyhash").val(splitNominal[1]);
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
						echo CHtml::hiddenField('keyhash', "0"); 
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
					<legend class="form-color-random">Status Order</legend>
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
		-->


		<div id="batalkanpesanan" class="modal fade" tabindex="-1" data-width="500" style="display: none;">
			<div class="modal-body">
				<p>Bantu Kami <strong>menghapus</strong> data ini jika merasa pesanan yang ditentukan tidak sesuai atau salah. </p>
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

		<div id="tampilkan-help" class="modal fade" tabindex="-1" data-width="500" style="display: none;">
			<div class="modal-body">
				<div class="chat-sms">
					<div class="chat-img-sms">
						<img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/chat-with-us-sms-messenger.jpg">
					</div>
					<div class="chat-konten-sms tebal">
						<h2>0878-5277-3907</h2>
					</div>	
				</div>
				<div class="clearfix"></div>
				<hr>
				<div class="clearfix"></div>
				<div class="chat-yahoo">
					<div class="chat-img-yahoo">
						<img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/chat-with-us-yahoo-messenger.jpg">
					</div>
					<div class="chat-konten-sms ">
						<ul class="list-unstyled list-inline">
						<?php
						$yahoo_mess = json_decode(Options::GetOptions("yahoo"), true);
						foreach ($yahoo_mess as $result) {
							echo '<li class="ym-help"><div class="ym-nama inline">'.$result['keterangan'].'</div> &nbsp; <a href="ymsgr:sendIM?'.$result['value'].'"><img src="http://opi.yahoo.com/online?u='.$result['value'].'&amp;m=g&amp;t=1&amp;l=us" alt="'.$result['value'].'"/></a></li>';
						}
						?>
						</ul>
					</div>	
				</div>
			</div>
		</div>

	</div>
</section>

<!-- footer -->
<footer>
    <div class="container hidden-xs">
        <div class="pull-right button-footer col-md-6">
            <div class="info-footer get-popover-bg" data-toggle="popover" data-container="body" data-placement="top" data-trigger="hover" data-html="true" data-delay="{ show: 300, hide: 100 }"></div>
            <div id="next" class="next-footer"></div>
            <div id="back" class="back-footer"></div>
            <div class="copyright-footer get-popover-copy" data-toggle="popover"></div>
        </div>
    </div>
</footer>