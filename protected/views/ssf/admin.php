<?php
$this->breadcrumbs = array(
    '社保基金' => array('admin'),
    '管理',
);
Yii::app()->clientScript->registerScript('search', "
$('form.search-form').submit(function(){
	$.fn.yiiGridView.update('ssf-grid', {
		data: $(this).serialize()
	});
	return false;
});
$('#delete-button').click(function(){
    var selects = $.fn.yiiGridView.getSelection('ssf-grid');
    if(selects==''){
        alert('请选中记录进行操作！');
    }else{
       if(window.confirm('您确定要删除吗？')){
            $.fn.yiiGridView.update('ssf-grid', {
		type:'POST',
		url:'" . $this->rewriteCreateUrl('delete') . "',
                                    data:{id:selects},
		success:function(data) {
                    $.fn.yiiGridView.update('ssf-grid');
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
        <h2>社保基金设置</h2>
        <div class="box-header-ctrls">	
            <a href="javascript:void(null);" title="" class="close"><!-- --></a>
        </div>
    </div>

    <div class="box-content" id="contacts-1a">
        <div class="inbox-sf">
            <form class="search-form">
                <?php echo CHtml::dropDownList('Ssf[ssf_type]', '', array(0 => '通用项目') + CHtml::listData(SsfTypes::model()->findAll(), 'id', 'name')); ?>
                <?php
                $this->Widget('ext.searchField.searchFieldWidget', array(
                    'initText' => '',
                    'titleText' => '输入名称查询',
                    'inputName' => 'Ssf[ssf_name]',
                    'inputId' => 'Ssf_ssf_name_search',
                ));
                ?>
                <input type="submit" name="" value="查询" class="inbox-sf-search-btn" />
            </form>
            <a class="button black fr tip" id="delete-button" href="javascript:void(null);" title="选中数据进行删除！">
                <span>批量删除</span>
            </a>
            <a class="button black fr" href="<?php echo $this->rewriteCreateUrl('create') ?>">
                <span>添加社保基金</span>
            </a>
        </div> 
        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'ssf-grid',
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
                array(
                    'name' => 'ssf_type',
                    'value' => 'SsfTypes::model()->getTypeName($data->ssf_type)',
                ),
                'ssf_name',
                'base_number',
                array(
                    'name' => 'business',
                    'value' => '$data->business . "%"',
                ),
                array(
                    'name' => 'personal',
                    'value' => '$data->personal . "%"'
                ),
                array(
                    'name' => 'is_change',
                    'value' => '$data->changes[$data->is_change]',
                ),
                array(
                    'name' => 'ssf_order',
                    'type' => 'raw',
                    'value' => 'Ssf::model()->createInput("ssf_order", $data->id, $data->ssf_order)',
                ),
                array(
                    'type' => 'raw',
                    'htmlOptions' => array('style' => 'width:140px'),
                    'value' => 'Yii::app()->controller->getColumnOptions($data->id,"Ssf")',
                ),
            ),
        ));
        ?>         
    </div><!-- END ".box-content" --> 
</div>
<script>
    function updateField(obj){//更新单个数据内容
        $("#ssf-grid").addClass("grid-view-loading");
        $.post("<?php echo $this->createUrl('api'); ?>", {field:$(obj).attr("rel-field"), id:$(obj).attr("rel-id"), fieldVal:$(obj).val(), action:"updateField"}, function(data){
            if(data){
                $("#ssf-grid").removeClass("grid-view-loading");
            }
        });
    }
</script>