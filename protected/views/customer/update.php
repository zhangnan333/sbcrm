<?php
$this->breadcrumbs=array(
	'Customers'=>array('site/index'),
	'更新',
);
 ?><div class="box corners shadow">
    <div class="box-header">
        <h2>新建</h2>
        <div class="box-header-ctrls">	
            <a href="javascript:void(null);" title="" class="close"><!-- --></a>
        </div>
    </div>
    <div class="box-content">
        <div class="inbox-sf">
            <a class="button black fr" href=" <?php echo $this->rewriteCreateUrl('create', array('b_id' => $model->b_id)); ?>">
                <span>添加</span>
            </a>
            <a class="button black fr" href=" <?php echo $this->rewriteCreateUrl('view',array('id'=>$model->id)); ?>">
                <span>查看</span>
            </a>
            <a class="button black fr" href=" <?php echo $this->rewriteCreateUrl('admin', array('b_id' => $model->b_id)); ?>">
                <span>管理</span>
            </a>
        </div>
        <?php echo $this->renderPartial('_form', array('model'=>$model, 'b_id' => $b_id, 'kfs' => $kfs, 'responsible' => $responsible)); ?>
    </div>
</div>
<div class="clear"></div>