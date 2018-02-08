<?php
$this->breadcrumbs = array(
    '系统权限分配' => array('admin'),
    $model->id,
);

$this->menu = array(
    array('label' => 'Create SysRoleAcl', 'url' => array('create')),
    array('label' => 'Update SysRoleAcl', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete SysRoleAcl', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage SysRoleAcl', 'url' => array('admin')),
);
?>
<div class="box corners shadow">
    <div class="box-header">
        <h2>查看权限→记录 #<?php echo $model->id; ?></h2></h2>
        <div class="box-header-ctrls">	
            <a href="javascript:void(null);" title="" class="close"><!-- --></a>
        </div>
    </div>

    <div class="box-content" id="contacts-1a">
        <div class="inbox-sf">
            <?php
            echo CHtml::link('<span>删除</span>', '#', array(
                'submit' => array(
                    'delete',
                    'id' => $model->id,
                ),
                'class' => 'button black fr',
                'confirm' => '您确定要删除吗?'
            ));
            ?>
            <a class="button black fr" href="<?php echo $this->createUrl('update', array('id' => $model->id)) ?>">
                <span>编辑</span>
            </a>
            <a class="button black fr" href="<?php echo $this->createUrl('create') ?>">
                <span>添加</span>
            </a>
            <a class="button black fr" href="<?php echo $this->createUrl('admin') ?>">
                <span>列表</span>
            </a>
        </div>
        <?php
        $this->widget('zii.widgets.CDetailView', array(
            'data' => $model,
            'cssFile' => '',
            'htmlOptions' => array('class' => 'tablelist'),
            'attributes' => array(
                'id',
                'rid',
                'controller',
                'action',
                'access',
            ),
        ));
        ?>
    </div>
</div>