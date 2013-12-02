<h2 class="error-page">Error <?php echo $code; ?></h2>

<div class="error-page">
<?php echo CHtml::encode($message); ?> Please go back to <a href="<?php echo Yii::app()->request->getBaseUrl(true); ?>">Front Page of ArekPulsa.com</a>.
</div>