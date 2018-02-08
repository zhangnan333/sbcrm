<?php
$this->breadcrumbs = array(
    '日程管理'
);
?>
<div class="box corners shadow">
    <div class="box-header">
        <h2>日程管理</h2>
        
    </div>
    <div class="box-content" id="contacts-1a">
        <iframe frameborder="0" width="100%" height="600" src="<?php echo Yii::app()->createUrl('wdcalendar');?>"></iframe>
    </div>
</div>
