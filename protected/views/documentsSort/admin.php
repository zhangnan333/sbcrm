<?php
$this->breadcrumbs = array(
    '文档分类' => array('admin'),
    '管理',
);
Yii::app()->clientScript->registerScript('search', "
$('form.search-form').submit(function(){
	$.fn.yiiGridView.update('documents-sort-grid', {
		data: $(this).serialize()
	});
	return false;
});
$('#delete-button').click(function(){
    var selects = $.fn.yiiGridView.getSelection('documents-sort-grid');
    if(selects==''){
        alert('请选中记录进行操作！');
    }else{
       if(window.confirm('您确定要删除吗？')){
            $.fn.yiiGridView.update('documents-sort-grid', {
		type:'POST',
		url:'" . $this->rewriteCreateUrl('delete') . "',
                                    data:{id:selects},
		success:function(data) {
                    $.fn.yiiGridView.update('documents-sort-grid');
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
        <h2>文档分类</h2>
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
                    'titleText' => '输入名称查询',
                    'inputName' => 'DocumentsSort[sort_name]',
                    'inputId' => 'DocumentsSort_sort_name_search',
                ));
                ?>
                <input type="submit" name="" value="查询" class="inbox-sf-search-btn" />
            </form>
            <a class="button black fr tip" id="delete-button" href="javascript:void(null);" title="选中数据进行删除！">
                <span>批量删除</span>
            </a>
            <a class="button black fr" href="<?php echo $this->rewriteCreateUrl('create') ?>">
                <span>添加分类</span>
            </a>
        </div> 
        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'documents-sort-grid',
            'dataProvider' => $model->search(),
            'cssFile' => '',
            'htmlOptions' => array('class' => ''),
            'template' => '<div id="loading"></div>{summary}{items}{pager}',
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
                'sort_name',
                'sort_note',
                array(
                    'type' => 'raw',
                    'htmlOptions' => array('style' => 'width:140px'),
                    'value' => 'Yii::app()->controller->getColumnOptions($data->id,"DocumentsSort")',
                ),
            ),
        ));
        ?>         
    </div><!-- END ".box-content" --> 
</div>