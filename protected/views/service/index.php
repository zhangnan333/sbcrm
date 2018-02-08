<?php
$this->breadcrumbs=array(
	'Services'=>array('site/index'),
	'列表',
);

$this->menu=array(
    array(
        'label'=>'创建 Service', 
        'url'=>array('create'),
        'linkOptions' => array(
            'class' => 'button themed',
         )
    ),
    array(
        'label' => '高级查询',
        'url' => '#',
        'linkOptions' => array(
            'class' => 'button themed',
            'id' => "search-button"
        ),
    )
);

Yii::app()->clientScript->registerScript('search', "
$('#search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('service-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'service-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'cssFile' => '',
        'ajaxUpdate'=>false,
        'filterCssClass' => 'filter-table',
        'htmlOptions' => array('class' => 'box-content box-table'),
        'template' => '{items}{pager}',
        'itemsCssClass' => 'tablebox',
        'pager' => array(//通过pager设置样式   默认为CLinkPager
            'prevPageLabel' => '上一页',
            'firstPageLabel' => '首页', //first,last 在默认样式中为{display:none}及不显示，通过样式{display:inline}即可
            'nextPageLabel' => '下一页',
            'lastPageLabel' => '末页',
            'header' => '',
            'htmlOptions' => array('class' => 'pagination')
        ),
        'selectableRows' => 2,
	'columns'=>array(
             array(
                'class' => 'CCheckBoxColumn',
                'header' => '全选',
                'value' => '$data->id',
                'id' => 'delete'
            ),
		'id',
		'name',
		'price',
		'content',
		'product_style',
		'photo_num',
		/*
		'truing_num',
		'tag',
		'order_sort',
		'status',
		*/
        array(
            'type'=>'raw',
            'htmlOptions'=>array('style'=>'width:110px'),
            'value'=>'Menu::model()->getColumnOptions($data->id,"Service")',
	),
    )
)); 
?>
