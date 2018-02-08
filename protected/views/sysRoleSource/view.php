<?php
$this->breadcrumbs = array(
    '系统资源' => array('admin'),
    $model->source_name,
);

$this->menu = array(
    array('label' => 'Create SysRoleSource', 'url' => array('create')),
    array('label' => 'Update SysRoleSource', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete SysRoleSource', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage SysRoleSource', 'url' => array('admin')),
);
?>
<div class="box corners shadow">
    <div class="box-header">
        <h2>查看系统资源→记录 #<?php echo $model->source_name; ?></h2></h2>
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
                'pid',
                'source_value',
                'source_name',
            ),
        ));
        ?>
    </div>
