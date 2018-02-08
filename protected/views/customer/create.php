<?php
$this->breadcrumbs=array(
	'员工'=>array('admin'),
	'添加',
);
 ?><div class="box corners shadow">
    <div class="box-header">
        <h2>添加客户</h2>
        
    </div>
    <div class="box-content">
        <?php echo $this->renderPartial('_form', array('model'=>$model, 'b_id' => $b_id, 'kfs' => $kfs, 'responsible' => $responsible)); ?>    </div>
</div>
<div class="clear"></div>