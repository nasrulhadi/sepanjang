<div class="content-base tinggi-350">
    <h3 class="content-tittle">Konfirmasi Pembayaran</h3>
    <div class="content-submenu">
        <div class="pull-right back-to-home"><?php echo CHtml::link('<span class="glyphicon glyphicon-home"></span> Beranda', array('/go/home')); ?></div>
        <ul class="list-submenu">
            <li><?php echo CHtml::link('Konfirmasi', array('/halaman/konfirmasi'), array('class' => 'active')); ?></li>
            <li><?php echo CHtml::link('Cetak Struk', array('/halaman/konfirmasi/struk'), array('class' => '')); ?></li>
        </ul>
    </div>
    <div class="content-core form">
    	<?php 
    	$form=$this->beginWidget('CActiveForm', array(
    		'id'=>'konfirmasi-form',
    		'enableAjaxValidation'=>false,
    		'htmlOptions'=>array(
    			'class'=>'form-horizontal'
    			),
    	));

    	if($form->error($model, 'ord_id') != ""){
    		echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>'.$form->error($model, 'ord_id').'</div>';
    	}
    	echo @Yii::app()->user->getFlash('info');

    	?>
			<div class="col-md-6">
				<!-- Text input-->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="Konfirmasi_knf_buyer">Pembeli <span class="required">*</span></label>  
				  <div class="col-md-6">
				  <?php echo $form->textField($model,'knf_buyer', array('class' => 'form-control input-md', 'placeholder' => 'Mr. Jackson')); ?>
				  <?php echo $form->error($model,'knf_buyer'); ?>
				  </div>
				</div>

				<!-- Text input-->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="Konfirmasi_nomor">Nomor Telepon <span class="required">*</span></label>  
				  <div class="col-md-6">
				  <?php echo $form->textField($model,'nomor', array('class' => 'form-control input-md', 'placeholder' => '0812345xxxx')); ?>
				  <?php echo $form->error($model,'nomor'); ?>  
				  </div>
				</div>

				<!-- Text input-->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="Konfirmasi_knf_nominal">Nominal <span class="required">*</span></label>  
				  <div class="col-md-6">
				  <?php echo $form->textField($model,'knf_nominal', array('class' => 'form-control input-md', 'placeholder' => '10000')); ?>
				  <span class="help-block">Format: Rp. 10.000,- ditulis 10000</span>
				  <?php echo $form->error($model,'knf_nominal'); ?>
				  </div>
				</div>

				<!-- Select Basic -->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="Konfirmasi_bank">Bank Tujuan</label>
				  <div class="col-md-6">
				  	<?php 
				  	$bank_name = json_decode(Options::GetOptions("bank_name"), true);
				  	$dataBank = array();
					foreach ($bank_name as $result) {
						$dataBank[$result['initial']] = ucwords(strtolower($result['value']));
					}
				  	echo $form->dropDownList($model,'bank',$dataBank, array('class' => 'form-control'));
				  	?>
				  </div>
				</div>

				<!-- Select Basic -->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="Konfirmasi_knf_date">Tanggal</label>
				  <div class="col-md-6">
				  	<?php echo $form->dropDownList($model,'knf_date', array('hariini' => 'Hari Ini', 'kemarin' => 'Kemarin'), array('class' => 'form-control')); ?>
				  	<?php echo $form->error($model,'knf_date'); ?>
				  </div>
				</div>

				<!-- Text input-->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="Konfirmasi_verifyCode">Anti Spam <span class="required">*</span></label>  
				  <div class="col-md-7">
				  <div class="col-xs-5 npl"><?php echo $form->textField($model,'verifyCode', array('class' => 'form-control', 'maxlength' => 5)); ?></div>
				  <div style="width:120px" class="inline"><?php $this->widget('CCaptcha', array('clickableImage' => true, 'buttonLabel' => '', 'imageOptions' => array('class'=>'pointer', 'title'=>'Ganti Gambar?'))); ?></div>
				  <?php echo $form->error($model,'verifyCode'); ?>
				  </div>
				</div>

				<!-- Button -->
				<div class="form-group mt-40">
				  <label class="col-md-4 control-label" for="tombol"></label>
				  <div class="col-md-6">
				  	<p class="note inline"><span class="required">*</span> harus diisi</p>
				    <input type="submit" id="tombol" name="tombol" class="btn btn-primary kiri-20" value="Proses">
				  </div>
				</div>
			</div>

	    	<div class="clearfix"></div>
    	<?php $this->endWidget(); ?>
    </div>
</div>