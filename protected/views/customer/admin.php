<?php
$kf_type = $b_id > 1 ? '企业客户' : '个人客户';
$this->breadcrumbs = array(
    $kf_type => array('admin', 'b_id' => $b_id),
    '员工列表',
);
Yii::app()->clientScript->registerScript('search', "
$('form.search-form').submit(function(){
	$.fn.yiiGridView.update('customer-grid', {
		data: $(this).serialize()
	});
	return false;
});
$('#delete-button').click(function(){
    var selects = $.fn.yiiGridView.getSelection('customer-grid');
    if(selects==''){
        alert('请选中记录进行操作！');
    }else{
       if(window.confirm('您确定要删除吗？')){
            $.fn.yiiGridView.update('customer-grid', {
		type:'POST',
		url:'" . $this->rewriteCreateUrl('delete') . "',
                                    data:{id:selects},
		success:function(data) {
                    $.fn.yiiGridView.update('customer-grid');
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
        <h2>
            <?php
            if ($b_id > 0) {
                $business = Business::model()->findByPk($b_id);
                if ($business)
                    echo $business->business_name . ' 员工列表';
                else
                    echo '<font color="red">企业客户已被删除</font>';
            } else {
                echo '个人客户列表';
            }
            ?>
        </h2>
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
                    'titleText' => '输入姓名查询',
                    'inputName' => 'Customer[name]',
                    'inputId' => 'Customer_name_search',
                ));
                echo CHtml::dropDownList('Customer[c_status]', '', array('' => '客户状态') + Yii::app()->params->cStatus, array('class' => 'tip', 'title' => '客户状态'));
                ?>
                <input type="submit" name="" value="查询" class="inbox-sf-search-btn" />
            </form>
            <a class="button black fr tip" id="delete-button" href="javascript:void(null);" title="选中数据进行删除！">
                <span>批量删除</span>
            </a>
            <a class="button black fr iframe" href="<?php echo $this->rewriteCreateUrl('create', array('b_id' => $b_id)) ?>">
                <span>添加员工</span>
            </a>
            <a class="button black fr" href="<?php echo $this->rewriteCreateUrl('business/view', array('id' => $b_id)) ?>">
                <span>企业信息</span>
            </a>
            <a class="button blue fr" href="<?php echo $this->rewriteCreateUrl('ssfReport/create', array('b_id' => $b_id)) ?>">
                <span>社保报表</span>
            </a>
        </div> 
        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'customer-grid',
            'dataProvider' => $model->search(),
            'cssFile' => '',
            'htmlOptions' => array('class' => ''),
            'template' => '<div id="loading"></div>{summary}{items}{pager}',
            'itemsCssClass' => 'tablebox',
            'ajaxUpdate' => false,
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
                'name',
                array(
                    'name' => 'ssf_type',
                    'value' => 'SsfTypes::model()->getUserTypeNameById($data->ssf_type)',
                ),
                'id_card',
                'sex',
                'hk_addr',
                'mobile',
                'wages',
                array(
                    'name' => 'c_status',
                    'type' => 'html',
                    'value' => 'Yii::app()->params->cStatusHtml[$data->c_status]',
                ),
                'buy_date',
                'over_date',
                'comment_info:html',
                /*

                  'phone',
                  'kf_id',
                  'responsible',
                  ,
                  'b_id',
                 */
                array(
                    'type' => 'raw',
                    'htmlOptions' => array('style' => 'width:50px'),
                    'value' => '$data->createActionButton()',
                ),
                array(
                    'type' => 'raw',
                    'htmlOptions' => array('style' => 'width:200px'),
                    'value' => 'CHtml::link("社保基金", Yii::app()->createAbsoluteUrl("customerSsf/create", array("u_id" => $data->id)), array("class" => "gradient-btn", "title" => "社保基金")) . Yii::app()->controller->getColumnOptions($data->id,"Customer")',
                ),
            ),
        ));
        ?>         
    </div><!-- END ".box-content" --> 
</div>
<script>
    $(function() {
        $(".gradient-btn").colorbox({iframe: true, width: "80%", height: "80%", opacity: 0.3});
        $(".iframe").colorbox({iframe: true, width: "80%", height: "80%", opacity: 0.3});
    });
</script>