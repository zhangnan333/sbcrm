<?php
$this->breadcrumbs = array(
    '角色菜单' => array('admin'),
    '查看',
);
?><div class="box corners shadow">
    <div class="box-header">
        <h2>查看→记录 #<?php echo $model->id; ?></h2></h2>
        <div class="box-header-ctrls">	
            <a href="javascript:void(null);" title="" class="close"><!-- --></a>
        </div>
    </div>
    <div class="box-content" id="contacts-1a">
        <div class="inbox-sf">
            <?php
            echo CHtml::link('<span>删除</span>', '#', array(
                'submit' => array('delete'),
                'class' => 'button black fr',
                'confirm' => '您确定要删除吗?'
            ));
            ?>            <a class="button black fr" href=" <?php echo $this->rewriteCreateUrl('create'); ?>">
                <span>创建</span>
            </a>
            <a class="button black fr" href=" <?php echo $this->rewriteCreateUrl('update', array('id' => $model->id)); ?>">
                <span>编辑</span>
            </a>
            <a class="button black fr" href=" <?php echo $this->rewriteCreateUrl('admin'); ?>">
                <span>管理</span>
            </a>
        </div>
        <?php
        $this->widget('zii.widgets.CDetailView', array(
            'data' => $model,
            'cssFile' => '',
            'htmlOptions' => array('class' => 'tablelist'),
            'attributes' => array(
                'id',
                array(
                    'name' => 's_name',
                    'value' => sysMenu::model()->getNameById($model->s_name, "m_name"),
                ),
                array(
                    'name'=>'menu_pid',
                    'value'=>  SysMenu::model()->getMenuNameByString($model->menu_pid),
                ),
            ),
        ));
        ?>
    </div>
</div>