<?php
$this->breadcrumbs=array(
	'Albums'=>array('site/index'),
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
		'album_title',
		'album_describe',
		'creation_time',
		'photographer',
		'cover',
		'show_home',
		'dir',
		'order_sort',
		'create_time',
                ),
        )); ?>
    </div>
</div>