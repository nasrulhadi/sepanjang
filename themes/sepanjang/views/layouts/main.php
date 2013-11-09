<!DOCTYPE html>
<html lang="en" class="halaman_depan">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="<?php echo json_decode(Options::GetOptions("meta_author"))->{"value"}; ?>">
        <meta name="keywords" content="<?php echo json_decode(Options::GetOptions("meta_keywords"))->{"value"}; ?>">
        <meta name="description" content="<?php echo json_decode(Options::GetOptions("meta_description"))->{"value"}; ?>">

        <title><?php echo json_decode(Options::GetOptions("page_title"))->{"value"}; ?></title>

        <!-- favicon -->
        <link rel="shortcut icon" href="http://getbootstrap.com/assets/ico/favicon.png">

        <?php $baseUrl = Yii::app()->theme->baseUrl; ?>
        <!-- css -->
        <link href="<?php echo $baseUrl; ?>/css/bootstrap.css" rel="stylesheet">
        <link href="<?php echo $baseUrl; ?>/css/bootstrap-modal-bs3patch.css" rel="stylesheet" />
        <link href="<?php echo $baseUrl; ?>/css/bootstrap-modal.css" rel="stylesheet" /

        <!-- custom -->
        <link href="<?php echo $baseUrl; ?>/css/style.css" rel="stylesheet">

        <!--[if lt IE 9]>
          <script src="<?php echo $baseUrl; ?>/js/html5shiv.js"></script>
          <script src="<?php echo $baseUrl; ?>/js/respond.min.js"></script>
          <![endif]-->
    </head>

    <body>
        <div id="headerimg1" class="headerimg"></div>
        <div id="headerimg2" class="headerimg"></div>

        <?php 
        if(Yii::app()->getController()->id == "front") { 
            echo $content; 
        } else { 
        ?>
        <section>
            <div class="row">
                <div id="sidebar-left" class="sidebar-menu col-md-1 col-lg-1">
                    <?php echo CHtml::link('<div class="page-logo">Logo</div>', array('/go/home'), array('class' => 'logo')); ?>
                    <div class="page-menu">
                        <div class="list-group">
                            <a href="<?php echo Yii::app()->baseUrl."/halaman/order"; ?>" class="list-group-item <?php echo ($this->ID==="order")?"active":"";?>"><h2><span class="glyphicon glyphicon-transfer"></span></h2>Status Order</a>
                            <a href="<?php echo Yii::app()->baseUrl."/halaman/konfirmasi"; ?>" class="list-group-item <?php echo ($this->ID==="konfirmasi")?"active":"";?>"><h2><span class="glyphicon glyphicon-check"></span></h2>Konfirmasi Pembayaran</a>
                            <a href="<?php echo Yii::app()->baseUrl."/halaman/donasi"; ?>" class="list-group-item <?php echo ($this->ID==="donasi")?"active":"";?>"><h2><span class="glyphicon glyphicon-gift"></span></h2>Total Donasi</a>
                            <a href="<?php echo Yii::app()->baseUrl."/halaman/panduan"; ?>" class="list-group-item <?php echo ($this->ID==="panduan")?"active":"";?>"><h2><span class="glyphicon glyphicon-tags"></span></h2>Panduan Pembelian</a>
                            <a href="<?php echo Yii::app()->baseUrl."/halaman/sistem"; ?>" class="list-group-item <?php echo ($this->ID==="sistem")?"active":"";?>"><h2><span class="glyphicon glyphicon-hdd"></span></h2>Informasi System</a>
                        </div>
                    </div>
                </div>

                <div id="content-right" class="content-page col-lg-11 col-md-push-1">
                    <?php echo $content; ?>
                </div>
            </div>
        </section>
        <?php } ?>

        <!-- javascript -->
        <script src="<?php echo $baseUrl; ?>/js/jquery.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/jquery-migrate.min.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/jquery.actual.min.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/button.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/modal.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/tooltip.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/popover.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/bootstrap.min.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/bootstrap-modalmanager.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/bootstrap-modal.js"></script>
        <script src="<?php echo Yii::app()->baseUrl; ?>/front/slideImage"></script>
        <script src="<?php echo Yii::app()->baseUrl; ?>/front/component"></script>
    </body>
</html>