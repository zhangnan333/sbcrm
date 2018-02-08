<?php
$this->breadcrumbs=array(
    '角色'=>array('admin'),
    $model->role_name=>array('view','id'=>$model->id),
    '更新',
);
?>
<div class="box corners shadow">
    <div class="box-header">
        <h2>更新角色 #<?php echo $model->role_name;?></h2>
        <div class="box-header-ctrls">	
            <a href="javascript:void(null);" title="" class="close"><!-- --></a>
        </div>
    </div>

    <div class="box-content" id="contacts-1a">
        <div class="inbox-sf">
            <?php
                echo CHtml::link('<span>删除</span>', '#',array(
                    'submit'=>array(
                        'delete',
                        'id'=>$model->id,
                        ),
                    'class' => 'button black fr',
                    'confirm'=>'您确定要删除吗?'
                ));
            ?>
            <a class="button black fr" href="<?php echo $this->createUrl('create')?>">
                <span>添加角色</span>
            </a>
            <a class="button black fr" href="<?php echo $this->createUrl('admin')?>">
                <span>列表</span>
            </a>
        </div> 
        <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
        <div class="clear"></div>
    </div>
</div>