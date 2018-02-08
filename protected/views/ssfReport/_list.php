<table class="tablelist">
    <tbody>
        <tr class="odd">
            <th><?php echo Business::model()->getAttributeLabel('business_name'); ?></th>
            <td><?php echo $business->business_name; ?></td>
            <th><?php echo Business::model()->getAttributeLabel('address'); ?></th>
            <td><?php echo $business->address; ?></td>
            <th><?php echo Business::model()->getAttributeLabel('tel'); ?></th>
            <td><?php echo $business->tel; ?></td>
            <th><?php echo Business::model()->getAttributeLabel('mobile'); ?></th>
            <td><?php echo $business->mobile; ?></td>

        </tr>
        <tr class="odd">
            <th><?php echo Business::model()->getAttributeLabel('linkman'); ?></th>
            <td><?php echo $business->linkman; ?></td>
            <th><?php echo Business::model()->getAttributeLabel('finance'); ?></th>
            <td><?php echo $business->finance; ?></td>

            <th><?php echo Business::model()->getAttributeLabel('personnel'); ?></th>
            <td><?php echo $business->personnel; ?></td>
            <th><?php echo Business::model()->getAttributeLabel('email'); ?></th>
            <td><?php echo $business->email; ?></td>
        </tr>
        <tr class="odd">
            <th><?php echo Business::model()->getAttributeLabel('change_personnel_day'); ?></th>
            <td><?php echo $business->change_personnel_day; ?>号</td>
            <th><?php echo Business::model()->getAttributeLabel('pay_day'); ?></th>
            <td><?php echo $business->pay_day; ?>号</td>

            <th><?php echo Business::model()->getAttributeLabel('pay_type'); ?></th>
            <td><?php echo $business->pay_type; ?></td>
            <th><?php echo Business::model()->getAttributeLabel('bill'); ?></th>
            <td><?php echo $business->bill == 1 ? '是' : '否'; ?></td>
        </tr>

        <tr class="odd">
            <th><?php echo Business::model()->getAttributeLabel('c_status'); ?></th>
            <td><?php echo Yii::app()->params->cStatusHtml[$business->c_status]; ?></td>

            <th><?php echo Business::model()->getAttributeLabel('over_date'); ?></th>
            <td><?php echo $business->buy_date . '/' . $business->over_date; ?></td>
            <th><?php echo Business::model()->getAttributeLabel('service_info'); ?></th>
            <td><?php echo $business->service_info; ?></td>

            <th><?php echo Business::model()->getAttributeLabel('express'); ?></th>
            <td><?php echo $business->express; ?></td>
        </tr>

        <tr class="odd">
            <th><?php echo Business::model()->getAttributeLabel('kf_id'); ?></th>
            <td><?php echo SysAdmin::model()->getNameById($business->kf_id); ?></td>
            <th><?php echo Business::model()->getAttributeLabel('responsible'); ?></th>
            <td><?php echo SysAdmin::model()->getNameById($business->responsible); ?></td>
            <th><?php echo Business::model()->getAttributeLabel('min_sprice'); ?></th>
            <td><?php echo $business->min_sprice; ?></td>
            <th><?php echo Business::model()->getAttributeLabel('unit_price'); ?></th>
            <td><?php echo $business->unit_price; ?></td>
        </tr>

        <tr class="odd">
            <th><?php echo Business::model()->getAttributeLabel('comment_info'); ?></th>
            <td colspan="7"><?php echo $business->comment_info; ?></td>
        </tr>
    </tbody>
</table>


<div style="overflow-x: auto;">
    <table class="ssf_list" width="2000">
        <tr class="sb_head">
            <th width="60" style="width:80px!important;">姓名</th>
            <th width="150">身份证</th>
            <th width="70">社保类型</th>
            <th width="60">工资</th>
            <th>社保项目</th>
            <th width="100">企业合计</th>
            <th width="100">个人合计</th>
            <th width="100">社保总额(￥)</th>
            <th width="100">服务费</th>
            <th width="100">应付</th>
            <th width="100">余额</th>

            <th width="100">操作</th>
            <th width="200">备注</th>
        </tr>
        <?php
        $customers = Customer::model()->findAll("b_id=$b_id AND c_status=1 AND over_date > '{$ssf_date}-01' AND buy_date <= '{$ssf_date}-01'"); //客户
        $all_ssf_money = 0; //企业社保总金额
        $balance = 0; //用户帐户余额
        $u_type = 1; //用户类型 1个人，2企业
        if ($b_id > 1) {
            $balance = CustomerRecharge::model()->getBalance($b_id, 2);
            $u_type = 2;
        }
        foreach ($customers as $user):
            if ($b_id == 1) {
                $balance = CustomerRecharge::model()->getBalance($user->id, 1);
            }
            //员工社保项
            $ssfs = CustomerSsf::model()->getSsfByUid($user->id, $ssf_date);
            ?>
            <tr>
                <th><?php echo CHtml::link($user->name, Yii::app()->createUrl('customer/view', array('id' => $user->id)), array('class' => 'iframe')); ?></th>
                <th><?php echo $user->id_card; ?></th>
                <th><?php echo SsfTypes::model()->getTypeName($user->ssf_type); ?></th>
                <td><?php echo $user->wages; ?></td>
                <td>
                    <table cellpadding="5">
                        <tr>
                            <?php
                            $ssf_money = 0;
                            $business_total = 0;
                            $personal_total = 0;
                            foreach ($ssfs as $ssf):
                                $base_number = $ssf['is_change'] == 0 ? $ssf['base_number'] : ($user->wages > $ssf['base_number'] ? $user->wages : $ssf['base_number']); //基数
                                if ($base_number > 0) {
                                    $business_money = round($ssf['business'] / 100 * $base_number, 2); //企业缴纳
                                    $personal_money = round($ssf['personal'] / 100 * $base_number, 2); //个人缴纳
                                } else {
                                    $business_money = $ssf['business']; //企业缴纳
                                    $personal_money = $ssf['personal']; //个人缴纳
                                }
                                $business_total += $business_money;
                                $personal_total += $personal_money;

                                $ssf_money += $business_money + $personal_money; //个人社保金额
                                ?>
                                <td width="200">
                                    <table class="sb" align="center">
                                        <tr>
                                            <th colspan="3" style="background: sandybrown;"><?php echo $ssf['ssf_name']; ?></th>
                                        </tr>
                                        <tr>
                                            <td>基数</td>
                                            <td><?php
                                                echo $ssf['business'];
                                                if ($base_number > 0) {
                                                    echo '%';
                                                }
                                                ?>(企业)</td>
                                            <td><?php
                                                echo $ssf['personal'];
                                                if ($base_number > 0) {
                                                    echo '%';
                                                }
                                                ?>(个人)</td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $base_number; ?></td>
                                            <td><?php echo $business_money; ?></td>
                                            <td><?php echo $personal_money; ?></td>
                                        </tr>
                                    </table>
                                </td>
                                <?php
                            endforeach;
                            ?>
                        </tr>
                    </table>
                </td>
                <td class="price"><?php echo $business_total; ?></td>
                <td class="price"><?php echo $personal_total; ?></td>
                <td class=""><?php echo $ssf_money; ?></td>
                <td class="price"><?php echo $user->service_charge; ?>/<?php echo Yii::app()->params->scTypes[$user->sc_type]; ?></td>
                <?php
                if ($user->sc_type == 'month') {
                    $ssf_money += $user->service_charge;
                }
                ?>
                <td class="price"><?php echo $ssf_money; ?></td>
                <td><?php echo $balance; ?></td>

                <td style="padding-left:5px;">
                    <?php
                    $ssf_report = SsfReport::model()->findByAttributes(array(
                        'u_id' => $user->id,
                        'ssf_date' => $ssf_date
                    ));

                    if (isset($ssf_report) && round($ssf_report->paid_money) >= round($ssf_money)) {
                        echo '<span style="color:blue">已扣款</span>';
                    } else {
                        if ($balance > $ssf_money):
                            ?>
                            <a class="gradient-btn" href="javascript:koukuan(<?php echo $user->id ?>, <?php echo $ssf_money; ?>)">扣款</a>
                            <?php
                        else:
                            switch ($u_type) {
                                case 1:
                                    echo CHtml::link('余额不足', Yii::app()->createUrl("customerRecharge/create", array("u_id" => $user->id, "u_type" => "1")), array('class' => 'gradient-btn iframe6'));
                                    break;
                                case 2:
                                    echo CHtml::link('余额不足', Yii::app()->createUrl("customerRecharge/create", array("u_id" => $b_id, "u_type" => "2")), array('class' => 'gradient-btn iframe6'));
                                    break;
                            }
                        endif;
                    }
                    ?>
                </td>
                <td><?php echo $user->comment_info; ?></td>
            </tr>
            <?php
            if ($u_type == 2)
                $all_ssf_money += $ssf_money;
        endforeach;
        ?>

    </table>
</div>
<?php
if ($u_type == 2):
    $serve_money = 0;
    $user_num = count($customers); //员工数
    $serve_money = $user_num * $business->unit_price; //服务费
    $serve_money = $serve_money > $business->min_sprice ? $serve_money : $business->min_sprice;
    ?>
    <div class="total">社保总金额：<?php echo $all_ssf_money; ?> 服务费：<?php echo $serve_money; ?> 总费用：<span class="price"><?php echo $all_ssf_money + $serve_money; ?></span></div>
        <?php
    endif;
    ?>

<script>
    function koukuan(u_id, ssf_money) {
        $.post("<?php echo Yii::app()->createUrl('ssfReport/api'); ?>", {action: "koukuan", u_id: u_id, ssf_money: ssf_money, ssf_date: "<?php echo $ssf_date; ?>", u_type: "<?php echo $u_type; ?>"}, function(data) {
            if (data == 1) {
                alert('扣款成功！');
                location.reload();
            } else {
                alert(data);
            }
        });
    }

    $(function() {
        $(".iframe").colorbox({iframe: true, width: "80%", height: "80%", opacity: 0.2});
        $(".iframe6").colorbox({iframe: true, width: "60%", height: "80%", opacity: 0.2});
    });
</script>