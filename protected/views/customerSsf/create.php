<?php
$this->breadcrumbs = array(
    '社保基金项目' => array('admin', 'u_id' => $model->u_id),
    '设置',
);
?><div class="box corners shadow">
    <div class="box-header">
        <h2>设置 <?php echo $customer->name;?> 的社保基金项目</h2>
        
        <a class="button black fr" href=" <?php echo $this->rewriteCreateUrl('admin', array('u_id' => $model->u_id)); ?>">
            <span>管理页面</span>
        </a>

    </div>
    <div class="box-content">
        <div class="flexform">
            <form class="search-form">
                <label>社保类型 </label>
                <?php echo CHtml::dropDownList('ssf_type', $customer->ssf_type, CHtml::listData(SsfTypes::model()->findAll(), 'id', 'name'));?>
            </form>
            
        </div>
        <?php echo $this->renderPartial('_form', array('model' => $model, 'ssf_data' => $ssf_data, 'customer' => $customer)); ?>    
    </div>
</div>
<div class="clear"></div>