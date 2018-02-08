<?php
$this->breadcrumbs = array(
    '系统资源' => array('admin'),
    '列表',
);

$this->menu = array(
    array('label' => 'Create SysRoleSource', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search_form', "
$('.search-form').submit(function(){
    $.fn.yiiGridView.update('sys-role-source-grid', {
        type:'GET',
        data: $(this).serialize()
    });
    return false;
});
$('#delete-button').click(function(){
    var selects = $.fn.yiiGridView.getSelection('sys-role-source-grid');
    if(selects==''){
        alert('请选中记录进行操作！');
    }else{
       if(window.confirm('您确定要删除吗？')){
            $.fn.yiiGridView.update('sys-role-source-grid', {
		type:'POST',
		url:'" . $this->createUrl('delete') . "',
                data:{id:selects},
		success:function(data) {
                    $.fn.yiiGridView.update('sys-role-source-grid');
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
        <h2>系统资源管理</h2>
        <div class="box-header-ctrls">	
            <a href="javascript:void(null);" title="" class="close"><!-- --></a>
        </div>
    </div>
    <div class="box-content" id="contacts-1a">
        <div class="inbox-sf">
            <form class="search-form">
                <?php
                echo CHtml::dropDownList('SysRoleSource[pid]', '', array('' => '') + CHtml::listData(SysRoleSource::model()->findAll('pid=0'), 'id', 'source_name'), array('class' => 'tip', 'title' => '请选择控制器'));
                ?>
                <input type="text" name="SysRoleSource[source_name]" class="input-1 tip" title="输入资源名称" />
                <input type="submit" name="" value="查询" class="inbox-sf-search-btn" />
            </form>
            <a class="button black fr tip" id="delete-button" href="javascript:void(null);" title="选中数据进行删除！">
                <span>批量删除</span>
            </a>
            <a class="button black fr" href="<?php echo $this->createUrl('create') ?>">
                <span>添加资源</span>
            </a>
        </div> 
        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'sys-role-source-grid',
            'dataProvider' => $model->search(),
            //'filter' => $model,
            'cssFile' => '',
            'htmlOptions' => array('class' => ''),
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
                    'name' => 'pid',
                    'value' => 'SysRoleSource::model()->findBYPk($data->pid)->source_name',
                ),
                'source_name',
                'source_value',
                array(
                    'class' => 'CButtonColumn',
                ),
            ),
        ));
        ?>
    </div>
</div>
