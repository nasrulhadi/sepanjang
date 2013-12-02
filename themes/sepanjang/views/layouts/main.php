<!DOCTYPE html>
<html lang="en" class="halaman_depan">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="<?php echo json_decode(Options::GetOptions("meta_author"))->{"value"}; ?>">
        <meta name="keywords" content="<?php echo json_decode(Options::GetOptions("meta_keywords"))->{"value"}; ?>">
        <meta name="description" content="<?php echo json_decode(Options::GetOptions("meta_description"))->{"value"}; ?>">

        <title><?php echo json_decode(Options::GetOptions("page_title"))->{"value"}; ?></title>

        <?php $baseUrl = Yii::app()->theme->baseUrl; ?>
        <!-- favicon -->
        <link rel="shortcut icon" href="<?php echo $baseUrl; ?>/img/favicon.png">

        <!-- css -->
        <link href="<?php echo $baseUrl; ?>/css/bootstrap.css" rel="stylesheet">
        <link href="<?php echo $baseUrl; ?>/css/bootstrap-modal-bs3patch.css" rel="stylesheet" />
        <link href="<?php echo $baseUrl; ?>/css/bootstrap-modal.css" rel="stylesheet" />
        <link href="<?php echo $baseUrl; ?>/lib/jtable/themes/redmond/jquery-ui.custom.css" rel="stylesheet" />
        <link href="<?php echo $baseUrl; ?>/lib/jtable/themes/metro/blue/jtable.css" rel="stylesheet" />

        <!-- custom -->
        <link href="<?php echo $baseUrl; ?>/css/style.css" rel="stylesheet">

        <!--[if lt IE 9]>
          <script src="<?php echo $baseUrl; ?>/js/html5shiv.js"></script>
          <script src="<?php echo $baseUrl; ?>/js/respond.min.js"></script>
          <![endif]-->
    </head>

    <body>
        <?php
        if(!Yii::app()->errorHandler->error) {
        ?>
        <div id="headerimg1" class="headerimg"></div>
        <div id="headerimg2" class="headerimg"></div>
        <?php
        }

         
        if(Yii::app()->getController()->id == "front") { 
            echo $content; 
        } else { 

            // jika error
            if(Yii::app()->errorHandler->error) {
                echo $content;
            } else {
        ?>
            <section>
                <div class="row clearfix">
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
                        <noscript><div class="alert alert-danger mt-20">Sistem mendeteksi <strong>javascript</strong> di browser Anda sedang tidak aktif, yang mengakibatkan tidak berfungsinya transaksi data di beberapa halaman.</div></noscript>
                        <?php echo $content; ?>
                        <div class="clearfix"></div>
                        <div class="content-base">
                            <hr class="hr-footer"></hr>
                            <div class="pull-left tal footer-text mb-20">
                                <p>
                                    <div class="form-inline mb-20">
                                        <?php
                                        $yahoo_mess = json_decode(Options::GetOptions("yahoo"), true);
                                        foreach ($yahoo_mess as $result) {
                                            echo '<div class="form-group kanan-20"><a href="ymsgr:sendIM?'.$result['value'].'"><img src="http://opi.yahoo.com/online?u='.$result['value'].'&amp;m=g&amp;t=1&amp;l=us" alt="'.$result['value'].'"/> '.$result['keterangan'].'</a></div>';
                                        }
                                        ?>
                                    </div>  
                                </p>
                                <p><?php echo json_decode(Options::GetOptions("footer_txt"))->{"value"}; ?></p>
                            </div>
                            <div class="pull-right tar footer-text">
                                <img src="<?php echo $baseUrl; ?>/img/sealGlogalSign.png">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php } } ?>

        <!-- javascript -->
        <script src="<?php echo $baseUrl; ?>/js/jquery.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/jquery-ui.min.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/jquery-migrate.min.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/jquery.actual.min.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/button.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/modal.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/tooltip.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/popover.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/transition.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/bootstrap.min.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/bootstrap-modalmanager.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/bootstrap-modal.js"></script>
        <script src="<?php echo $baseUrl; ?>/lib/jtable/jquery.jtable.js"></script>
        <script src="<?php echo Yii::app()->baseUrl; ?>/front/slideImage"></script>
        <script src="<?php echo Yii::app()->baseUrl; ?>/front/component"></script>
        <?php 
        if($this->action->id == "semua") { 
            echo "<script>setInterval(function(){ $('#listAllOrder').jtable('load')},30000);</script>"; 
        }
        ?>

    </body>
</html>