<?php
$this->breadcrumbs = array(
    '销售网站' => array('admin'),
    $model->web_domain,
);
?>
<div class="box corners shadow">
    <div class="box-header">
        <h2><?php echo $model->web_domain;?></h2>
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
            'web_logo',
            'web_domain',
            'web_name',
            'web_describe:html',
            'web_status',
            'append_date',
        ),
    ));
    ?>
    </div>
</div>