<?php
$this->breadcrumbs=array(
	'文档分类'=>array('admin'),
	'新建',
);
 ?><div class="box corners shadow">
    <div class="box-header">
        <h2> 新建文档分类</h2>
        <div class="box-header-ctrls">	
            <a href="javascript:void(null);" title="" class="close"><!-- --></a>
        </div>
    </div>
    <div class="box-content">
        <div class="inbox-sf">
            <a class="button black fr" href=" <?php echo $this->rewriteCreateUrl('admin'); ?>">
                <span>分类列表</span>
            </a>
        </div>
        <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>    </div>
</div>
<div class="clear"></div>