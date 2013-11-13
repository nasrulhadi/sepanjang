<div class="content-base tinggi-350">
    <h3 class="content-tittle">Status Order</h3>
    <div class="content-submenu">
        <div class="pull-right back-to-home"><?php echo CHtml::link('<span class="glyphicon glyphicon-home"></span> Beranda', array('/go/home')); ?></div>
        <ul class="list-submenu">
            <li><?php echo CHtml::link('Status Order', array('/halaman/order'), array('class' => 'active')); ?></li>
            <li><?php echo CHtml::link('Semua Order', array('/halaman/order/semua'), array('class' => '')); ?></li>
        </ul>
    </div>
    <div class="content-core">
        <p>Masukan Nomor Telepon / HP sesuai dengan yg diinput pada saat Order.</p>
        <div class="col-lg-3 npl mtb-20">
            <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'cekOrder-form',
                'enableAjaxValidation'=>false,
                'htmlOptions' => array('role' => 'form'),
            )); 
            ?>
                <div class="input-group">
                    <input type="text" class="input-small form-control" name="cariNo" id="cariNo" placeholder="Cari Nomor Telepon">
                    <?php echo CHtml::hiddenField('keystore', Yii::app()->session['keySalt']); ?>
                    <span class="input-group-btn">
                        <input type="submit" id="tombolStatusOrder" data-loading-text="Tunggu..." class="btn btn-primary" value="Proses" disabled>
                    </span>
                </div>
            <?php $this->endWidget(); ?>
        </div>
        <div class="clearfix"></div>
        <div id="msg-error" class="alert alert-danger mtb-20" style="display:none"></div>
        <div id="loading" class="mtb-20" style="display:none"></div>
        <?php echo CHtml::hiddenField('counter', '0'); ?>
        <table class="table table-striped table-bordered mtb-20" id="tableResult" style="display:none">
            <tbody>
                <tr>
                    <td width="30%">Tanggal Transaksi</td>
                    <td id="tanggalORder" class="tebal"><?php echo MyFormatter::formatDateFormat(date("Y-m-d H:i:s")); ?></td>
                </tr>
                <tr>
                    <td>Jenis Produk</td>
                    <td id="produkOrder" class="tebal">Pulsa Telpon</td>
                </tr>
                <tr>
                    <td>Provider</td>
                    <td id="providerOrder" class="tebal">SIMPATI</td>
                </tr>
                <tr>
                    <td>Nominal</td>
                    <td id="nominalOrder" class="tebal">SIMPATI 50.000</td>
                </tr>
                <tr>
                    <td>Nomor Tujuan</td>
                    <td id="nomorOrder" class="tebal">081298755xxx</td>
                </tr>
                <tr>
                    <td>Harga</td>
                    <td id="hargaOrder" class="tebal">Rp 49.841</td>
                </tr>
                <tr>
                    <td>Bank Tujuan</td>
                    <td id="bankOrder">
                        <?php
                        $bank_name = json_decode(Options::GetOptions("bank_name"), true);
                        foreach ($bank_name as $result) {
                            echo '<div id="bank_'.strtolower($result['initial']).'" class="form-bank-detail-update" style="display:none">';
                            echo '<div class="'.strtolower($result['initial']).' icons-bank" title="'.$result['value'].'"></div>';
                            echo '</div>';
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td><div class="form-total-nominal inline" id="statusOrder">Transaksi berhasil</div> &nbsp;&nbsp;&nbsp;<span id="reStatus" class="reStatus"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/reload.png" title="reload" alt="reload"></span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>