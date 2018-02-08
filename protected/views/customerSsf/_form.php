<div class="flexform">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'customer-ssf-form',
        'enableAjaxValidation' => false
    ));
    ?>
    <div class="row">
        <?php //echo $form->labelEx($model, 'u_id'); ?>
        <?php echo $form->hiddenField($model, 'u_id', array('size' => 11, 'maxlength' => 11)); ?>
        <?php echo $form->error($model, 'u_id', array('class' => 'form-msg-error-advanced')); ?>
    </div>

    <div class="row">
        <table class="tablebox">
            <thead>
                <tr>
                    <th width="20"></th>
                    <th>社保名称</th>
                    <th>基数</th>
                    <th>企业比例</th>
                    <th>个人比例</th>
                    <th>是否浮动</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $ssfs = Ssf::model()->findAll('ssf_type=0');
                $i=0;
                foreach ($ssfs as $v):
                    $i++;
                    $checked = false;
                    if (in_array($v->id, $ssf_data))
                        $checked = TRUE;
                    ?>
                    <tr class="<?php echo $i%2==0 ? 'odd' : 'even';?>">
                        <td><?php echo CHtml::checkBox('ssf_id_box[]', $checked, array('value' => $v->id)); ?></td>
                        <td><?php echo $v->ssf_name; ?></td>
                        <td><?php echo $v->base_number; ?></td>
                        <td><?php echo $v->business; ?>%</td>
                        <td><?php echo $v->personal; ?>%</td>
                        <td><?php echo $v->changes[$v->is_change]; ?></td>
                    </tr>
                <?php endforeach; ?>
                <?php
                $ssfs = Ssf::model()->findAll("ssf_type={$customer->ssf_type}");
                foreach ($ssfs as $v):
                    $i++;
                    $checked = false;
                    if (in_array($v->id, $ssf_data))
                        $checked = TRUE;
                    ?>
                    <tr class="<?php echo $i%2==0 ? 'odd' : 'even';?>">
                        <td><?php echo CHtml::checkBox('ssf_id_box[]', $checked, array('value' => $v->id)); ?></td>
                        <td><?php echo $v->ssf_name; ?></td>
                        <td><?php echo $v->base_number; ?></td>
                        <td><?php echo $v->business; ?>%</td>
                        <td><?php echo $v->personal; ?>%</td>
                        <td><?php echo $v->changes[$v->is_change]; ?></td>
                    </tr>
                <?php endforeach; ?>

            </tbody>

        </table>
        
        <?php echo $form->error($model, 'ssf_id', array('class' => 'form-msg-error-advanced')); ?>
    </div>

    <div class="action">
        <?php echo CHtml::submitButton($model->isNewRecord ? '保存' : '保存'); ?>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- form -->
<div class="clear"></div>
