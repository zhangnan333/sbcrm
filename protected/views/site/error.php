<?php
$this->pageTitle = Yii::app()->name . ' - 错误';
$this->breadcrumbs = array(
    'Error',
);
?>
<div class="box corners shadow">
<div class="errorMessage" style="width: 80%;float: left;">
    <strong>Error Page <?php echo $code; ?> </strong>
    <?php echo CHtml::encode($message); ?>
</div>
<div style="clear:both;"></div>
</div>
