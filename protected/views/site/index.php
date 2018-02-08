<?php
$this->breadcrumbs = array(
    '数据中心',
);
?>

<div class="box corners shadow">
    <div class="box-header">
        <h2>常用操作</h2>
        <div class="box-header-ctrls">	
            <a href="javascript:void(null);" title="" class="close"><!-- --></a>
        </div>
    </div>
    <div class="box-content" id="contacts-1a">
        <div style="clear: both;">
            <a class="button red iframe" href="<?php echo $this->rewriteCreateUrl('business/create') ?>">
                <span>添加企业客户</span>
            </a>
            <a class="button iframe" href="<?php echo Yii::app()->createUrl('customer/create', array('b_id' => 1)); ?>">
                <span>添加个人客户</span>
            </a>
        </div>
    </div>
</div>
<div>
    <div class="box box-50 corners shadow">
        <div class="box-header">
            <h2>最新咨询客户</h2>
            <div class="box-header-ctrls">	
                <a href="javascript:void(null);" title="" class="close"><!-- --></a>
            </div>
        </div>
        <div class="box-content" id="contacts-2a" style="height: 400px;overflow-y: scroll;">
            <table class="tablebox">
                <thead>
                    <tr>
                        <th>状态</th>
                        <th>姓名</th>
                        <th>备注</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($new_customers as $v):
                        ?>
                        <tr>
                            <td><?php echo Yii::app()->params->cStatus[$v->c_status]; ?></td>
                            <td><?php echo CHtml::link($v->name, Yii::app()->createUrl('customer/view', array('id' => $v->id, 'layout' => 'empty')), array('class' => 'iframe')); ?></td>
                            <td><?php echo $v->comment_info; ?></td>
                        </tr>
                        <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="box box-50 corners shadow" style="float: right;">
        <div class="box-header">
            <h2>公告</h2>
            <div class="box-header-ctrls">	
                <a href="javascript:void(null);" title="" class="close"><!-- --></a>
            </div>
        </div>
        <div class="box-content" id="contacts-3a" style="height: 400px;overflow-y: scroll;">
            <table class="tablebox">
                <thead>
                    <tr>
                        <th>标题</th>
                        <th>时间</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($announcement as $v):
                        ?>
                        <tr>
                            <td><?php echo CHtml::link($v->title, Yii::app()->createUrl('documents/show', array('id' => $v->id)), array('class' => 'iframe')); ?></td>
                            <td><?php echo $v->post_time; ?></td>
                        </tr>
                        <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="box box-50 corners shadow" style="float: left;">
        <div class="box-header">
            <h2>最新回访记录</h2>
            <div class="box-header-ctrls">	
                <a href="javascript:void(null);" title="" class="close"><!-- --></a>
            </div>
        </div>
        <div class="box-content" id="contacts-3a" style="height: 400px;overflow-y: scroll;">

        </div>
    </div>
</div>
<script>
    $(function(){
        $(".iframe").colorbox({iframe:true, width:"80%", height:"80%", opacity:0.2});
    });
</script>