<div class="flexform">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'customer-recharge-form',
        'enableAjaxValidation' => false
    ));
    ?>
    <div class="row" style="font-size: 2em;">
        客户：
        <?php
        switch ($model->u_type) {
            case 1:
                echo Customer::model()->getNameById($model->u_id);
                break;
            case 2:
                echo Business::model()->getNameById($model->u_id);
                break;
        }
        ?>
        <?php echo $form->hiddenField($model, 'u_id', array('size' => 11, 'maxlength' => 11)); ?>
        <?php echo $form->error($model, 'u_id', array('class' => 'form-msg-error-advanced')); ?>
    </div>

    <div class="row">
        <?php echo $form->hiddenField($model, 'u_type'); ?>
        <?php echo $form->error($model, 'u_type', array('class' => 'form-msg-error-advanced')); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'money'); ?>
        <?php echo $form->textField($model, 'money', array('size' => 10, 'maxlength' => 10)); ?>
        <?php echo $form->error($model, 'money', array('class' => 'form-msg-error-advanced')); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'money_entry'); ?>
        <?php
        //echo $form->textField($model, 'money_entry'); 
        $this->widget('ext.CJuiDateTimePicker.CJuiDateTimePicker', array(
            'model' => $model, //Model object
            'attribute' => 'money_entry', //attribute name
            'mode' => 'date' //use "time","date" or "datetime" (default)
        ));
        ?>
        <?php echo $form->error($model, 'money_entry', array('class' => 'form-msg-error-advanced')); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'send_bank_name'); ?>
        <?php echo $form->textField($model, 'send_bank_name', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'send_bank_name', array('class' => 'form-msg-error-advanced')); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'send_bank_card'); ?>
        <?php echo $form->textField($model, 'send_bank_card', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'send_bank_card', array('class' => 'form-msg-error-advanced')); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'bank_name'); ?>
        <?php echo $form->textField($model, 'bank_name', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'bank_name', array('class' => 'form-msg-error-advanced')); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'bank_card'); ?>
        <?php echo $form->textField($model, 'bank_card', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'bank_card', array('class' => 'form-msg-error-advanced')); ?>
    </div>


    <div class="action">
        <?php echo CHtml::submitButton($model->isNewRecord ? '创建' : '保存'); ?>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- form -->
<div class="clear"></div>