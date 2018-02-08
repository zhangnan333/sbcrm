<?php
$this->breadcrumbs=array(
	'系统资源'=>array('admin'),
	'添加',
);

$this->menu=array(
	array('label'=>'Manage SysRoleSource', 'url'=>array('admin')),
);
?>
<div class="box corners shadow">
    <div class="box-header">
        <h2>添加资源</h2>
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