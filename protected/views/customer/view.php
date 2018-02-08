<?php
$this->breadcrumbs = array(
    '个人客户' => array('admin'),
    '查看',
);
?><div class="box corners shadow">
    <div class="box-header">
        <h2><?php echo $model->name; ?></h2></h2>
        <div class="box-header-ctrls">	
            <a href="javascript:void(null);" title="" class="close"><!-- --></a>
        </div>
    </div>
    <div class="box-content" id="contacts-1a">
        <div class="inbox-sf">
            <a class="button black fr" href=" <?php echo $this->rewriteCreateUrl('update', array('id' => $model->id)); ?>">
                <span>修改</span>
            </a>
            <a class="button blue fr" href=" <?php echo $this->rewriteCreateUrl('customerSsf/admin', array('u_id' => $model->id)); ?>">
                <span>社保基金</span>
            </a>
        </div>
        <div id="tabs">
            <ul>
                <li><a href="#view">客户信息</a></li>
                <li><a href="#visit">回访记录</a></li>
            </ul>
            <div id="view">
                <?php
                $this->widget('zii.widgets.CDetailView', array(
                    'data' => $model,
                    'cssFile' => '',
                    'htmlOptions' => array('class' => 'tablelist'),
                    'attributes' => array(
                        array(
                            'name' => 'c_status',
                            'type' => 'raw',
                            'value' => Yii::app()->params->cStatusHtml[$model->c_status],
                        ),
                        array(
                            'name' => 'b_id',
                            'value' => Business::model()->getNameById($model->b_id),
                        ),
                        'name',
                        'id_card',
                        'sex',
                        'hk_addr',
                        'mobile',
                        'phone',
                        'wages',
                        'service_charge',
                        array(
                            'name' => 'sc_type',
                            'value' => Yii::app()->params->scTypes[$model->sc_type],
                        ),
                        'buy_date',
                        'over_date',
                        array(
                            'name' => 'kf_id',
                            'value' => SysAdmin::model()->getNameById($model->kf_id),
                        ),
                        array(
                            'name' => 'responsible',
                            'value' => SysAdmin::model()->getNameById($model->responsible),
                        ),
                        'comment_info',
                        
                    ),
                ));
                ?>
            </div>
            <div id="visit">
                <a id="svbox" href="#" class="button" onclick="$('#vbox').show();$(this).hide();"><span>添加记录</span></a>
                <div id="vbox" style="display:none;">
                    <?php
                    $this->widget('ext.imperavi-redactor-widget-master.ImperaviRedactorWidget', array(
                        'name' => 'info',
                        'options' => array(
                            'lang' => 'zh_cn',
                            'minHeight' => 200,
                            'imageUpload' => Yii::app()->homeUrl . 'imgUpload.php'
                        ),
                    ));
                    ?>
                    <div style="margin-top: 10px;">
                        <a href="javascript:void(0)" class="button blue fl" onclick="submitVisit()"><span>提交</span></a></div>
                    <a href="#" class="button black fl" onclick="$('#vbox').hide();$('#svbox').show();"><span>取消</span></a>
                    <div class="clear"></div>
                </div>

                <dl class="visit-list">
                    <?php
                    foreach ($visit_logs as $v):
                        ?>
                    <dt>时间：<?php echo $v->visit_date;?> 回访人：<?php echo SysAdmin::model()->getNameById($v->vu_id);?></dt>
                    <dd><?php echo $v->info;?></dd>
                        <?php
                    endforeach;
                    ?>
                </dl>
            </div>
        </div>
    </div>

</div>
</div>

<div id="dialog-modal" title="操作成功">
    <p>回访记录添加成功.</p>
</div>
<script>
    //提交回访日志
    function submitVisit(){
        var info = $('#info').getCode();
        if(info == '<p><br></p>' || info == ''){
            return false;
        }
        $.post("<?php echo Yii::app()->createAbsoluteUrl('visitLog/api'); ?>", {info:info, u_id:"<?php echo $model->id; ?>", u_type:'1', action:'postVisit'}, function(data){
            if(data==1){
                $('#info').setCode('');
                $("#dialog-modal").dialog({
                    resizable: false,
                    height:140,
                    modal: true,
                    buttons: {
                        "确定": function() {
                            $( this ).dialog( "close" );
                            location.reload();
                        }
                    }
                });
            }else{
                
            }
        });
    }
    $(function() {
        $( "#tabs" ).tabs();
    });
</script>