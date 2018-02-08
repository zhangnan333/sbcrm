<?php
$this->breadcrumbs=array(
	'系统权限分配'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	'修改',
);

$this->menu=array(
	array('label'=>'Create SysRoleAcl', 'url'=>array('create')),
	array('label'=>'View SysRoleAcl', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SysRoleAcl', 'url'=>array('admin')),
);
?>
<div class="box corners shadow">
    <div class="box-header">
        <h2>更新权限 #<?php echo $model->id;?></h2>
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
                        'id'=>$model->id
                        ),
                    'class' => 'button black fr',
                    'confirm'=>'您确定要删除吗?'
                ));
            ?>
            <a class="button black fr" href="<?php echo $this->createUrl('create')?>">
                <span>分配权限</span>
            </a>
            <a class="button black fr" href="<?php echo $this->createUrl('admin')?>">
                <span>列表</span>
            </a>
        </div> 
        <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
        <div class="clear"></div>
    </div>
</div>