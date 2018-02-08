<?php
$this->breadcrumbs=array(
	'销售网站'=>array('admin'),
	'添加网站',
);

?>
<div class="box corners shadow">
    <div class="box-header">
        <h2>添加网站</h2>
        <div class="box-header-ctrls">	
            <a href="javascript:void(null);" title="" class="close"><!-- --></a>
        </div>
    </div>
    <div class="box-content">
        <div class="inbox-sf">
            <a class="button black fr" href=" <?php echo $this->rewriteCreateUrl('admin'); ?>">
                <span>管理页面</span>
            </a>
        </div>
        <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>    </div>
</div>
<div class="clear"></div>