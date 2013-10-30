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
				<li class="active"><a href="index.html">Ucen Cell-Ett Indonesia </a></li>
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
						<li><a href="ymsgr:sendIM?nasrulhaadi"><img src="http://opi.yahoo.com/online?u=nasrulhaadi&amp;m=g&amp;t=1&amp;l=us" alt="ympengasuh1"/> &nbsp; Pengasuh 1</a></li>
						<li><a href="ymsgr:sendIM?nasrulhaadi"><img src="http://opi.yahoo.com/online?u=nasrulhaadi&amp;m=g&amp;t=1&amp;l=us" alt="ympengasuh1"/> &nbsp; Pengasuh 2</a></li>
						<li><a href="ymsgr:sendIM?nasrulhaadi"><img src="http://opi.yahoo.com/online?u=nasrulhaadi&amp;m=g&amp;t=1&amp;l=us" alt="ympengasuh1"/> &nbsp; Pengasuh 3</a></li>
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
						<select name="voucher" class="form-control form-input-voucher">
							<option value="empty">-- Pilih Voucher --</option>
							<option value="1">Pulsa Telepon</option>
							<option value="2">Token PLN</option>
							<option value="3">Voucher Game</option>
							<option value="4">TV Berlangganan</option>
						</select>
						<div class="form-input-provider" style="display:none">
							<select name="provider" class="form-control form-input-providers">
								<option value="empty">-- Pilih Provider --</option>
								<option value="1">XL</option>
								<option value="2">AXIS</option>
								<option value="3">IM3</option>
								<option value="4">Mentari</option>
								<option value="5">Tri</option>
								<option value="6">Simpati</option>
								<option value="7">AS</option>
							</select>
						</div>
						<div class="form-input-nominal" style="display:none">
							<select name="nominal" class="form-control form-input-nominals">
								<option value="empty">-- Pilih Nominal --</option>
								<option value="1">5.000 ~> <div class="pull-right">5.932</div></option>
								<option value="2">10.000 ~> 10.932</option>
								<option value="3">25.000 ~> 25.932</option>
								<option value="4">50.000 ~> 50.932</option>
								<option value="5">100.000 ~> 100.932</option>
							</select>
						</div>                            
						<hr class="hr-border"></hr>

						<h3><span class="form-color-random">02.</span> Masukan Nomor</h3>
						<input type="text" name="nomor" id="nomor" class="form-control form-input-nomor" placeholder="08123456789" maxlength="30" disabled>
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
						<div class="form-bank-detail">BCA <span>/</span> HENI OKTAVIANTI <span>/</span> 4720241442</div>
						<p class="form-color-random form-keterangan-title"><strong>Keterangan</strong></p>
						<ol class="form-keterangan">
							<li> Total Tagihan <strong>JANGAN</strong> dibulatkan.</li>
							<li> Sudah termasuk donasi <strong>Rp. 150,-</strong> untuk <em><a href="http://www.yayasanalmultazam.com" target="_blank">Yayasan Al-Multazam Bangkalan</a></em>.</li>
							<li> Jika sudah melakukan pembayaran, klik tombol <em>Terima Kasih</em> dibawah ini untuk melihat status transaksi Anda.</li>
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
							<li> Lakukan <strong>Cek Pulsa</strong>, terkadang notifikasi terlambat masuk.</li>
							<li> Khusus <strong>Token PLN</strong>, kode dikirim via SMS atau cetak bs cetak struk <a href="#cetakstruk">disini</a> .</li>
							<li> Jika Anda sudah melakukan pembayaran namun status belum berubah dalam 20 menit, segera hubungi Tim kami di menu pojok kanan atas.</li>
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