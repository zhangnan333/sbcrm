<?php
$this->breadcrumbs = array(
    '角色' => array('admin'),
    '管理',
);
Yii::app()->clientScript->registerScript('search_form', "
$('.search-form').submit(function(){
    $.fn.yiiGridView.update('form-grid', {
        type:'GET',
        data: $(this).serialize()
    });
    return false;
});
$('#delete-button').click(function(){
    var selects = $.fn.yiiGridView.getSelection('form-grid');
    if(selects==''){
        alert('请选中记录进行操作！');
    }else{
       if(window.confirm('您确定要删除吗？')){
            $.fn.yiiGridView.update('form-grid', {
		type:'POST',
		url:'" . $this->createUrl('delete') . "',
                data:{id:selects},
		success:function(data) {
                    $.fn.yiiGridView.update('form-grid');
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
/**
$('input.list-input').dblclick(function(){
    $(this).toggleClass('none');
}).blur(function(){
    $(this).toggleClass('none');
}).change(function(){
    if(this.value!==''){
        
    }
});
**/
");
?>
<div class="box corners shadow">
    <div class="box-header">
        <h2>角色管理</h2>
        <div class="box-header-ctrls">	
            <a href="javascript:void(null);" title="" class="close"><!-- --></a>
        </div>
    </div>

    <div class="box-content" id="contacts-1a">
        <div class="inbox-sf">
            <form class="search-form">
                <input type="text" name="SysRole[role_name]" class="input-1 tip" title="输入角色名称" />
                <input type="submit" name="" value="查询" class="inbox-sf-search-btn" />
            </form>
            <a class="button black fr tip" id="delete-button" href="javascript:void(null);" title="选中数据进行删除！">
                <span>批量删除</span>
            </a>
            <a class="button black fr" href="<?php echo $this->createUrl('create') ?>">
                <span>添加角色</span>
            </a>
        </div> 
        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'form-grid',
            'dataProvider' => $model->search(),
            //'filter' => $model,
            //'filterPosition' => 'body',
            'cssFile' => '',
            //'ajaxUpdate' => true,
            //'filterCssClass' => 'filter-table',
            'htmlOptions' => array('class' => ''),
            'template' => '{summary}{items}{pager}',
            //'summaryCssClass' => 'box-header',
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
                array(
                    'name' => 'role_name',
//                    'value' => 'CHtml::textField("role_name[]", $data->role_name, array("class"=>"list-input none"))',
//                    'type' => 'raw',
                ),
                array(
                    'name' => 'role_info',
//                    'value' => 'CHtml::textField("role_name[]", $data->role_info, array("class"=>"list-input none"))',
//                    'type' => 'raw'
                ),
                array(
                    'class' => 'CButtonColumn',
                    'htmlOptions' => array('style'=>'width:160px;')
                ),
            ),
        ));
        ?>            
    </div><!-- END ".box-content" --> 
</div>
<div class="clear"></div>