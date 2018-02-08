<?php
$this->breadcrumbs = array(
    '企业客户' => array('admin'),
    '添加',
);
?><div class="box corners shadow">
    <div class="box-header">
        <h2>添加企业客户</h2>
        
    </div>
    <div class="box-content">
        
        <?php echo $this->renderPartial('_form', array('model' => $model, 'kfs' => $kfs, 'responsible' => $responsible)); ?>    </div>
</div>
<div class="clear"></div>