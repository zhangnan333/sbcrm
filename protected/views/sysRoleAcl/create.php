<?php
$this->breadcrumbs=array(
	'系统权限分配'=>array('admin'),
	'权限分配',
);

$this->menu=array(
	array('label'=>'Manage SysRoleAcl', 'url'=>array('admin')),
);
?>
<div class="box corners shadow">
    <div class="box-header">
        <h2>分配权限</h2>
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