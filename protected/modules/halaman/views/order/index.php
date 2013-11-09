<div class="content-base">
    <h3 class="content-tittle">Status Order</h3>
    <div class="content-submenu">
        <div class="pull-right back-to-home"><a href="index.html"><span class="glyphicon glyphicon-home"></span> Beranda</a></div>
        <ul class="list-submenu">
            <li><?php echo CHtml::link('Status Order', array('/halaman/order'), array('class' => 'active')); ?></li>
            <li><?php echo CHtml::link('Semua Order', array('/halaman/semuaOrder'), array('class' => '')); ?></li>
        </ul>
    </div>
    <div class="content-core">
        <p>Masukan Nomor Telepon / HP sesuai dengan yg diinput pada Order Anda.</p>
        <div class="col-lg-3 npl mtb-20">
            <form action="#" method="post" role="form">
                <div class="input-group">
                    <input type="text" class="input-small form-control" name="cariNo" id="cariNo" placeholder="Cari Nomor Telepon">
                    <span class="input-group-btn">
                        <input type="button" id="tombolStatusOrder" class="btn btn-primary" value="Proses" disabled>
                    </span>
                </div>
            </form>
        </div>
        <table class="table table-striped table-bordered mtb-20" id="tableResult" style="display:none" data-loading-text="Tunggu...">
            <tbody>
                <tr>
                    <td width="30%">Tanggal Transaksi</td>
                    <td>14-10-2013 13:33:29</td>
                </tr>
                <tr>
                    <td>Jenis Produk</td>
                    <td>Pulsa Telpon</td>
                </tr>
                <tr>
                    <td>Provider</td>
                    <td>SIMPATI</td>
                </tr>
                <tr>
                    <td>Produk</td>
                    <td>SIMPATI 50000</td>
                </tr>
                <tr>
                    <td>Nomor Tujuan</td>
                    <td>081298755xxx</td>
                </tr>
                <tr>
                    <td>Harga</td>
                    <td>Rp 49.841</td>
                </tr>
                <tr>
                    <td>Bank Transfer</td>
                    <td>BCA</td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td><span class="label label-success huruf-besar">Transaksi berhasil</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>