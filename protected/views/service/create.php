<?php
$this->breadcrumbs=array(
	'套餐'=>array('admin'),
	'添加',
);
 ?><div class="box corners shadow">
    <div class="box-header">
        <h2>添加套餐</h2>
        <div class="box-header-ctrls">	
            <a href="javascript:void(null);" title="" class="close"><!-- --></a>
        </div>
    </div>
    <div class="box-content">
        <div class="inbox-sf">
            <a class="button black fr" href=" <?php echo $this->rewriteCreateUrl('admin'); ?>">
                <span>套餐列表</span>
            </a>
        </div>
        <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>    </div>
</div>
<div class="clear"></div>