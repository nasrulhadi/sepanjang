<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>

<h2 class="error-page">Error <?php echo $code; ?></h2>

<div class="error-page">
<?php echo CHtml::encode($message); ?>
</div>