<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

<div class="breadcrumbwidget">
<?php if (isset($this->breadcrumbs)): ?>
    <?php
    $this->widget('zii.widgets.CBreadcrumbs', array(
        'links' => $this->breadcrumbs,
        'htmlOptions' => array('class' => 'breadcrumb')
    ));
    ?><!-- breadcrumbs -->
<?php endif ?>
</div>

<div class="row-fluid">
    <div class="span3 pull-right">
    <?php
    $this->widget('zii.widgets.CMenu', array(
        /* 'type'=>'list', */
        'encodeLabel' => false,
        'items' => array(
            array('label' => 'OPERATIONS', 'items' => $this->menu),
        ),
    ));
    ?>
    </div>
    <div class="span9 pull-left">
    <!-- Include content pages -->
    <?php echo $content; ?>
    </div>
</div>
<?php $this->endContent(); ?>