<?php
$this->breadcrumbs = array(
    '系统权限分配' => array('admin'),
    '列表',
);

Yii::app()->clientScript->registerScript('search_form', "
$('.search-form').submit(function(){
    $.fn.yiiGridView.update('sys-role-acl-grid', {
        type:'GET',
        data: $(this).serialize()
    });
    return false;
});
$('#delete-button').click(function(){
    var selects = $.fn.yiiGridView.getSelection('sys-role-acl-grid');
    if(selects==''){
        alert('请选中记录进行操作！');
    }else{
       if(window.confirm('您确定要删除吗？')){
            $.fn.yiiGridView.update('sys-role-acl-grid', {
		type:'POST',
		url:'" . $this->createUrl('delete') . "',
                data:{id:selects},
		success:function(data) {
                    $.fn.yiiGridView.update('sys-role-acl-grid');
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
        <h2>系统权限分配</h2>
        <div class="box-header-ctrls">	
            <a href="javascript:void(null);" title="" class="close"><!-- --></a>
        </div>
    </div>
    <div class="box-content" id="contacts-1a">
        <div class="inbox-sf">
            <form class="search-form">
                <?php
                echo CHtml::dropDownList('SysRoleAcl[rid]', '', array(''=>'')+CHtml::listData(SysRole::model()->findAll(), 'id', 'role_name'), array('class'=>'tip', 'title' => '请选择角色'));
                ?>
                <input type="text" name="SysRoleAcl[controller]" class="input-1 tip" title="输入控制器" />
                <input type="submit" name="" value="查询" class="inbox-sf-search-btn" />
            </form>
            <a class="button black fr tip" id="delete-button" href="javascript:void(null);" title="选中数据进行删除！">
                <span>批量删除</span>
            </a>
            <a class="button black fr" href="<?php echo $this->createUrl('create') ?>">
                <span>分配权限</span>
            </a>
        </div> 
        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'sys-role-acl-grid',
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
                    'name' => 'rid',
                    'value' => 'SysRole::model()->findByPk($data->rid)->role_name',
                ),
                'controller',
                'action',
                'access',
                array(
                    'class' => 'CButtonColumn',
                ),
            ),
        ));
        ?>
    </div>
</div>
