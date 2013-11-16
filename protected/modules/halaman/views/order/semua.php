<div class="content-base tinggi-350">
    <h3 class="content-tittle">Semua Order</h3>
    <div class="content-submenu">
        <div class="pull-right back-to-home"><?php echo CHtml::link('<span class="glyphicon glyphicon-home"></span> Beranda', array('/go/home')); ?></div>
        <ul class="list-submenu">
            <li><?php echo CHtml::link('Status Order', array('/halaman/order'), array('class' => '')); ?></li>
            <li><?php echo CHtml::link('Semua Order', array('/halaman/order/semua'), array('class' => 'active')); ?></li>
        </ul>
    </div>
    <div class="content-core">
        <p>Daftar Order dibawah ini diambil dari 20 yang terbaru, dan otomatis diperbarui setiap 30 detik. Jika tidak menemukan Order Anda, silahkan kunjungi halaman <?php echo CHtml::link('Status Order', array('/halaman/order'), array('class' => '')); ?> untuk melihat rincian Order.</p>
        <div id="listAllOrder" class="mt-20"></div>
    </div>
</div>