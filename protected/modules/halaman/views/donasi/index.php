<div class="content-base tinggi-350">
    <h3 class="content-tittle">Donasi</h3>
    <div class="content-submenu">
        <div class="pull-right back-to-home"><?php echo CHtml::link('<span class="glyphicon glyphicon-home"></span> Beranda', array('/go/home')); ?></div>
        <ul class="list-submenu">
           <li><?php echo CHtml::link('Donasi', array('/halaman/donasi'), array('class' => 'active')); ?></li>
        </ul>
    </div>
    <div class="content-core">
    	<div class="col-md-7 npl npr header-slidexxx" >
	        <div id="carousel-donasi" class="carousel slide" data-ride="carousel" data-interval="15000">
				<!-- Indicators -->
				<ol class="carousel-indicators">
					<li data-target="#carousel-donasi" data-slide-to="0" class="active"></li>
					<li data-target="#carousel-donasi" data-slide-to="1"></li>
					<li data-target="#carousel-donasi" data-slide-to="2"></li>
				</ol>

				<!-- Wrapper for slides -->
				<div class="carousel-inner">
					<div class="item active">
						<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/header-donasi/headerSSC3.png" alt="Quote - Surabaya Save Child Street" class="img-rounded img-responsive">
					</div>
					<div class="item">
						<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/header-donasi/headerSSC2.png" alt="Inilah Kami - Surabaya Save Child Street" class="img-rounded img-responsive">
					</div>
					<div class="item">
						<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/header-donasi/headerSSC1.png" alt="Hope - Surabaya Save Child Street" class="img-rounded img-responsive">
					</div>
				</div>

				<!-- Controls -->
				<a class="left carousel-control" href="#carousel-donasi" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left"></span>
				</a>
				<a class="right carousel-control" href="#carousel-donasi" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right"></span>
				</a>
			</div>     
		</div>
		<div class="clearfix"></div>
		<?php
		$donasi = json_decode(Options::GetOptions("donasi"))->{"value"};

		$criteria=new CDbCriteria;
   		$criteria->condition = "ord_status = 'sukses' AND ord_desc = '' AND month(ord_date) = '".date("m")."'";
   		$transaksiSukses = Order::model()->count($criteria);

		$totalDonasi = $donasi * $transaksiSukses;
		?>
		<div class="col-md-8 npl mt-20">
			<div class="inline fl"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/donasi.png" width="128" height="128" alt="img-donasi" class="img-responsive"></div>
			<div class="inline fl kiri-20">
				<h3>TOTAL DONASI</h3><h2> <span class="text-danger tebal">Rp. <?php echo MyFormatter::rupiah($totalDonasi);?>,-</span></h2>
				<p class="text-muted">-- Donasi diatas adalah akumulasi dari total transaksi sukses pada bulan <?php echo MyFormatter::formatBulanIndonesia(); ?>.</p>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="col-md-8 npl">
			<p class="mt-20">
				<strong><em>Save Street Child</em></strong> adalah gerakan komunitas yang berawal dari ide sederhana untuk mengaktualisasikan kepedulian menjadi tindakan, dan tidak rumit.
				Sehingga tindak nyata benar-benar terwujud tanpa melalui birokrasi dan manipulasi semangat perjuangan awal.
			</p>
			<p class="mt-20">
				<strong>VISI DAN MISI</strong>
				<br><br><strong>Visi:</strong>
				<blockquote>
					“Terwujudnya  Hak-Hak Anak sesuai  dengan harkat dan martabat anak bangsa yang agung dan berbudi luhur”
				</blockquote>
				<em><u>Penjelasan Makna</u></em><br>
				Visi di atas dimaksudkan sebagai ide atau cita-cita <strong><em>Save Street Child Surabaya</em></strong> di masa mendatang yang diusahakan secara terus menerus dan berkesinambungan, melalui berbagai terobosan yang merupakan langkah untuk meningkatkan nilai anak-anak marjinal di mata masyarakat berkaitan dengan nilai dasar keadilan dan kemanusiaan. Sehingga hal demikian dapat mendongkrak mutu dan kualitas anak-anak bangsa, serta memudarnya ketimpangan-ketimpangan sosial pada anak-anak marjinal khususnya. Secara garis besar, ada 10 Hak Anak yang termaktub di dalam Konvensi Hak Anak PBB Tahun 1989, yakni :

				<ul class="mt-20">
					<li>Hak untuk Bermain</li>
					<li>Hak untuk mendapatkan Pendidikan</li>
					<li>Hak untuk mendapatkan Perlindungan
					<li>Hak untuk mendapatkan Identitas</li>
					<li>Hak untuk mendapatkan status Kebangsaan</li>
					<li>Hak untuk mendapatkan Makanan</li>
					<li>Hak untuk mendapatkan akses Kesehatan</li>
					<li>Hak untuk ber-Rekreasi</li>
					<li>Hak untuk mendapatkan Kesamaan, dan</li>
					<li>Hak untuk memiliki Peran dalam Pembangunan</li>
				</ul>
				<br>
				Oleh karenanya, Terwujudnya Hak-Hak Anak sesuai dengan harkat dan martabat anak bangsa yang agung dan berbudi luhur, merupakan puncak cita-cita <strong><em>Save Street Child Surbaya</em></strong>.
				<br><br><br>

				<strong>Misi:</strong><br><br>
				Visi tersebut merupakan landasan <strong><em>Save Street Child Surabaya</em></strong> yang didukung oleh Misi yang dijalankannya, yakni :
				<ul class="mt-20">
					<li>Mewujudkan Hak-Hak Anak Indonesia</li>
					<li>Mewujudkan rasa keadilan sesuai dengan nilai-nilai kemanusiaan</li>
					<li>Wadah bagi pemuda-pemudi (masyarakat) Surabaya untuk lebih peduli dengan anak jalanan dan marjinal</li>
					<li>Menumbuhkan persamaan hak antara anak jalanan dan marjinal dengan seluruh masyarakat Indonesia</li>
					<li>Turut serta mencerdaskan anak bangsa dengan membimbing ke jalan yang baik dan benar.</li>
				</ul>
				<br><br>
				<div class="col-md-8 bs-social npl">
					<ul class="bs-social-buttons">
						<li>
							<a target="_blank" href="https://www.facebook.com/SSChildSurabaya" class="get-popover-social" data-toggle="popover" data-content="Save Street Child Surabaya Page<br><em class='text-muted'>-- klik untuk mengunjungi</em>" data-html="true" data-placement="top" data-container="body" data-original-title="<strong>Facebook</strong>" data-trigger="hover">
								<img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/facebook-icon.png" alt="Facebook" class="img-responsive">
							</a>
						</li>
						<li>
							<a target="_blank" href="http://twitter.com/SSChildSurabaya" class="get-popover-social" data-toggle="popover" data-content="Official Twitter of SSC Surabaya<br><em class='text-muted'>-- klik untuk mengunjungi</em>" data-html="true" data-placement="top" data-container="body" data-original-title="<strong>Twitter</strong>" data-trigger="hover">
								<img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/twitter-icon.png" alt="Twitter" class="img-responsive">
							</a>
						</li>
						<li>
							<a target="_blank" href="http://www.sschildsurabaya.com/" class="get-popover-social" data-toggle="popover" data-content="Official Website of SSC Surabaya<br><em class='text-muted'>-- klik untuk mengunjungi</em>" data-html="true" data-placement="top" data-container="body" data-original-title="<strong>Website</strong>" data-trigger="hover">
								<img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/dribbble-icon.png" alt="Website" class="img-responsive">
							</a>
						</li>
						<li>
							<img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/aws-icon.png" alt="Telepon / SMS" class="img-responsive get-popover-social" data-toggle="popover" data-content="08819620694 (Advin)<br><em class='text-muted'>-- klik lagi untuk keluar</em>" data-html="true" data-placement="top" data-container="body" data-original-title="<strong>Telepon / SMS</strong>">
						</li>
						<li>
							<img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/pinboard-icon.png" alt="Basecamp" class="img-responsive get-popover-social" data-toggle="popover" data-content="Rumah Cita Citaku, Jl. Gunungsari no. 20 Surabaya<br><em class='text-muted'>-- klik lagi untuk keluar</em>" data-html="true" data-placement="top" data-container="body" data-original-title="<strong>Basecamp</strong>">
						</li>
					</ul>
				</div>
			</p>
		</div>   
    </div>
</div>