<?php
$this->breadcrumbs = array(
    '服务套餐' => array('admin'),
    '管理',
);
Yii::app()->clientScript->registerScript('search', "
$('form.search-form').submit(function(){
	$.fn.yiiGridView.update('service-grid', {
		data: $(this).serialize()
	});
	return false;
});
$('#delete-button').click(function(){
    var selects = $.fn.yiiGridView.getSelection('service-grid');
    if(selects==''){
        alert('请选中记录进行操作！');
    }else{
       if(window.confirm('您确定要删除吗？')){
            $.fn.yiiGridView.update('service-grid', {
		type:'POST',
		url:'" . $this->createUrl('delete') . "',
                                    data:{id:selects},
		success:function(data) {
                    $.fn.yiiGridView.update('service-grid');
                    //afterDelete(th,true,data);
		},
		error:function() {
                    //afterDelete(th,false);
		}
            });
            return false;
       }
    }
});
");
?>
<div class="box corners shadow">
    <div class="box-header">
        <h2>套餐列表</h2>
        <div class="box-header-ctrls">	
            <a href="javascript:void(null);" title="" class="close"><!-- --></a>
        </div>
    </div>

    <div class="box-content" id="contacts-1a">
        <div class="inbox-sf">
            <form class="search-form">
                <?php
                $this->Widget('ext.searchField.searchFieldWidget', array(
                    'initText' => '',
                    'titleText' => '输入XXXX查询',
                    'inputName' => 'Service[name]',
                    'inputId' => 'Service_name',
                ));
                ?>
                <input type="submit" name="" value="查询" class="inbox-sf-search-btn" />
            </form>
            <a class="button black fr tip" id="delete-button" href="javascript:void(null);" title="选中数据进行删除！">
                <span>批量删除</span>
            </a>
            <a class="button black fr" href="<?php echo $this->createUrl('create') ?>">
                <span>添加套餐</span>
            </a>
        </div> 
        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'service-grid',
            'dataProvider' => $model->search(),
            'cssFile' => '',
            'htmlOptions' => array('class' => ''),
            'template' => '{summary}{items}{pager}',
            'itemsCssClass' => 'tablebox',
            'pager' => array(//通过pager设置样式   默认为CLinkPager
                'prevPageLabel' => '<<',
                'firstPageLabel' => '首页', //first,last 在默认样式中为{display:none}及不显示，通过样式{display:inline}即可
                'nextPageLabel' => '>>',
                'lastPageLabel' => '末页',
                'header' => '',
                'htmlOptions' => array('class' => 'box-nav')
            ),
            'selectableRows' => 2,
            'columns' => array(
                array(
                    'class' => 'CCheckBoxColumn',
                    'header' => '全选',
                    'value' => '$data->id',
                    'id' => 'delete',
                    'htmlOptions' => array('style' => 'width:20px')
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
                    'type' => 'raw',
                    'htmlOptions' => array('style' => 'width:140px'),
                    'value' => 'Yii::app()->controller->getColumnOptions($data->id,"Service")',
                ),
            ),
        ));
        ?>         
    </div><!-- END ".box-content" --> 
</div>