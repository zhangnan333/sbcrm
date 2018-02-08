<?php
$this->breadcrumbs=array(
	'社保类型'=>array('admin'),
	'更新',
);
 ?><div class="box corners shadow">
    <div class="box-header">
        <h2>添加 社保类型</h2>
        <div class="box-header-ctrls">	
            <a href="javascript:void(null);" title="" class="close"><!-- --></a>
        </div>
    </div>
    <div class="box-content">
        <div class="inbox-sf">
            <?php echo CHtml::link('<span>删除</span>', '#',array(
                    'submit'=>array('delete'),
                    'class' => 'button black fr',
                    'confirm'=>'您确定要删除吗?'
                ));
            ?>            <a class="button black fr" href=" <?php echo $this->rewriteCreateUrl('create'); ?>">
                <span>创建</span>
            </a>
            <a class="button black fr" href=" <?php echo $this->rewriteCreateUrl('view',array('id'=>$model->id)); ?>">
                <span>查看</span>
            </a>
            <a class="button black fr" href=" <?php echo $this->rewriteCreateUrl('admin'); ?>">
                <span>管理</span>
            </a>
        </div>
        <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>    </div>
</div>
<div class="clear"></div>