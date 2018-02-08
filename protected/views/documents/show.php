<?php
$this->breadcrumbs = array(
    '企业文档' => array('admin'),
    '查看',
);
?><div class="box corners shadow">
    <div class="box-header">
        <h2><?php echo $model->title; ?></h2></h2>
        
    </div>
    <div class="box-content" id="contacts-1a">
        <?php
        $this->widget('zii.widgets.CDetailView', array(
            'data' => $model,
            'cssFile' => '',
            'htmlOptions' => array('class' => 'tablelist'),
            'attributes' => array(
                array(
                    'name' => 'sort_id',
                    'value' => DocumentsSort::model()->getNameById($model->sort_id),
                ),
                'title',
                'info:html',
                array(
                    'name' => 'user_id',
                    'value' => SysAdmin::model()->getNameById($model->user_id),
                ),
                'post_time',
                'update_time',
            ),
        ));
        ?>
    </div>
</div>