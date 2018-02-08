<?php
$this->breadcrumbs = array(
    '角色' => array('admin'),
    '添加',
);

$this->menu = array(
    array('label' => '列表', 'url' => array('admin')),
);
?>
<div class="box corners shadow">
    <div class="box-header">
        <h2>创建角色</h2>
        <div class="box-header-ctrls">	
            <a href="javascript:void(null);" title="" class="close"><!-- --></a>
        </div>
    </div>

    <div class="box-content" id="contacts-1a">
        <div class="inbox-sf">
            <a class="button black fr" href="<?php echo $this->createUrl('admin') ?>">
                <span>列表</span>
            </a>
        </div> 
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>
        <div class="clear"></div>
    </div>
</div>