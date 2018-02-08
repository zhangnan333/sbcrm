<?php
$this->breadcrumbs = array(
    '企业客户' => array('admin'),
    '查看',
);
?><div class="box corners shadow">
    <div class="box-header">
        <h2><?php echo $model->business_name; ?></h2></h2>
        <div class="box-header-ctrls">	
            <a href="javascript:void(null);" title="" class="close"><!-- --></a>
        </div>
    </div>
    <div class="box-content" id="contacts-1a">
        <div class="inbox-sf">
            
            <a class="button black fr" href=" <?php echo $this->rewriteCreateUrl('update', array('id' => $model->id)); ?>">
                <span>编辑</span>
            </a>
            
            <a class="button black fr" href=" <?php echo $this->rewriteCreateUrl('customer/admin', array('b_id' => $model->id)); ?>">
                <span>员工列表</span>
            </a>
            <a class="button blue fr" href=" <?php echo $this->rewriteCreateUrl('ssfReport/create', array('b_id' => $model->id)); ?>">
                <span>社保报表</span>
            </a>
        </div>
        <div id="tabs">
            <ul>
                <li><a href="#view">客户信息</a></li>
                <li><a href="#visit">回访记录</a></li>
                <li><a href="#tb">缴费记录</a></li>
            </ul>
            <div id="view">
                <table class="tablelist">
                    <tbody>
                        <tr class="odd">
                            <th><?php echo Business::model()->getAttributeLabel('business_name'); ?></th>
                            <td><?php echo $model->business_name; ?></td>
                            <th><?php echo Business::model()->getAttributeLabel('address'); ?></th>
                            <td><?php echo $model->address; ?></td>
                            <th><?php echo Business::model()->getAttributeLabel('tel'); ?></th>
                            <td><?php echo $model->tel; ?></td>
                            <th><?php echo Business::model()->getAttributeLabel('mobile'); ?></th>
                            <td><?php echo $model->mobile;?></td>

                        </tr>
                        <tr class="odd">
                            <th><?php echo Business::model()->getAttributeLabel('linkman'); ?></th>
                            <td><?php echo $model->linkman; ?></td>
                            <th><?php echo Business::model()->getAttributeLabel('finance'); ?></th>
                            <td><?php echo $model->finance; ?></td>

                            <th><?php echo Business::model()->getAttributeLabel('personnel'); ?></th>
                            <td><?php echo $model->personnel; ?></td>
                            <th><?php echo Business::model()->getAttributeLabel('email'); ?></th>
                            <td><?php echo $model->email; ?></td>
                        </tr>
                        <tr class="odd">
                            <th><?php echo Business::model()->getAttributeLabel('change_personnel_day'); ?></th>
                            <td><?php echo $model->change_personnel_day; ?>号</td>
                            <th><?php echo Business::model()->getAttributeLabel('pay_day'); ?></th>
                            <td><?php echo $model->pay_day; ?>号</td>

                            <th><?php echo Business::model()->getAttributeLabel('pay_type'); ?></th>
                            <td><?php echo $model->pay_type; ?></td>
                            <th><?php echo Business::model()->getAttributeLabel('bill'); ?></th>
                            <td><?php echo $model->bill==1 ? '是' : '否'; ?></td>
                        </tr>
                        
                        <tr class="odd">
                            <th><?php echo Business::model()->getAttributeLabel('c_status'); ?></th>
                            <td><?php echo Yii::app()->params->cStatusHtml[$model->c_status]; ?></td>

                            <th><?php echo Business::model()->getAttributeLabel('over_date'); ?></th>
                            <td><?php echo $model->buy_date . '/' . $model->over_date; ?></td>
                            <th><?php echo Business::model()->getAttributeLabel('service_info');?></th>
                            <td><?php echo $model->service_info;?></td>

                            <th><?php echo Business::model()->getAttributeLabel('express');?></th>
                            <td><?php echo $model->express;?></td>
                        </tr>

                        <tr class="odd">
                            <th><?php echo Business::model()->getAttributeLabel('kf_id'); ?></th>
                            <td><?php echo SysAdmin::model()->getNameById($model->kf_id); ?></td>
                            <th><?php echo Business::model()->getAttributeLabel('responsible'); ?></th>
                            <td><?php echo SysAdmin::model()->getNameById($model->responsible); ?></td>
                            <th><?php echo Business::model()->getAttributeLabel('min_sprice'); ?></th>
                            <td><?php echo $model->min_sprice; ?></td>
                            <th><?php echo Business::model()->getAttributeLabel('unit_price'); ?></th>
                            <td><?php echo $model->unit_price; ?></td>
                        </tr>
                        
                        <tr class="odd">
                            <th><?php echo Business::model()->getAttributeLabel('comment_info'); ?></th>
                            <td colspan="7"><?php echo $model->comment_info; ?></td>
                        </tr>
                    </tbody>
                </table>

            </div>

            <div id="visit">
                <a id="svbox" href="#" class="button" onclick="$('#vbox').show();
                        $(this).hide();"><span>添加记录</span></a>
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
                    <a href="#" class="button black fl" onclick="$('#vbox').hide();
                        $('#svbox').show();"><span>取消</span></a>
                    <div class="clear"></div>
                </div>

                <dl class="visit-list">
                    <?php
                    foreach ($visit_logs as $v):
                        ?>
                        <dt>时间：<?php echo $v->visit_date; ?> 回访人：<?php echo SysAdmin::model()->getNameById($v->vu_id); ?></dt>
                        <dd><?php echo $v->info; ?></dd>
                        <?php
                    endforeach;
                    ?>
                </dl>
            </div>

        </div>
    </div>
</div>

<div id="dialog-modal" title="操作成功">
    <p>回访记录添加成功.</p>
</div>
<script>
                    //提交回访日志
                    function submitVisit() {
                        var info = $('#info').getCode();
                        if (info == '<p><br></p>' || info == '') {
                            return false;
                        }
                        $.post("<?php echo Yii::app()->createAbsoluteUrl('visitLog/api'); ?>", {info: info, u_id: "<?php echo $model->id; ?>", u_type: '2', action: 'postVisit'}, function(data) {
                            if (data == 1) {
                                $('#info').setCode('');
                                $("#dialog-modal").dialog({
                                    resizable: false,
                                    height: 140,
                                    modal: true,
                                    buttons: {
                                        "确定": function() {
                                            $(this).dialog("close");
                                        }
                                    }
                                });
                            } else {

                            }
                        });
                    }
                    $(function() {
                        $("#tabs").tabs();
                    });
</script>