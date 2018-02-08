<?php
$this->breadcrumbs=array(
	'财务管理'=>array('admin'),
	'查看',
);
 ?><div class="box corners shadow">
    <div class="box-header">
        <h2>查看→记录 #<?php echo $model->id;?></h2></h2>
        <div class="box-header-ctrls">	
            <a href="javascript:void(null);" title="" class="close"><!-- --></a>
        </div>
    </div>
    <div class="box-content" id="contacts-1a">
        <div class="inbox-sf">
           <?php echo CHtml::link('<span>删除</span>', '#',array(
                    'submit'=>array('delete'),
                    'class' => 'button black fr',
                    'confirm'=>'您确定要删除吗?'
                ));
            ?>            <a class="button black fr" href=" <?php echo $this->rewriteCreateUrl('create'); ?>">
                <span>创建</span>
            </a>
             <a class="button black fr" href=" <?php echo $this->rewriteCreateUrl('update',array('id'=>$model->id)); ?>">
                <span>编辑</span>
            </a>
            <a class="button black fr" href=" <?php echo $this->rewriteCreateUrl('admin'); ?>">
                <span>管理</span>
            </a>
        </div>
        <?php $this->widget('zii.widgets.CDetailView', array(
                'data'=>$model,
                'cssFile' => '',
                'htmlOptions' => array('class' => 'tablelist'),
                'attributes'=>array(
        		'id',
		'u_id',
		'u_type',
		'money',
		'money_entry',
		'send_bank_name',
		'send_bank_card',
		'bank_name',
		'bank_card',
		'data_entry',
		'admin_id',
                ),
        )); ?>
    </div>
</div>