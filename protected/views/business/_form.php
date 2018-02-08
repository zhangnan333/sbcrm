<div class="flexform">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'business-form',
        'enableAjaxValidation' => false
            ));
    ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'business_name'); ?>
        <?php echo $form->textField($model, 'business_name', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'business_name', array('class' => 'form-msg-error-advanced')); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'address'); ?>
        <?php echo $form->textField($model, 'address', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'address', array('class' => 'form-msg-error-advanced')); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model, 'express'); ?>
        <?php echo $form->textField($model, 'express'); ?>
        <?php echo $form->error($model, 'express', array('class' => 'form-msg-error-advanced')); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'bill'); ?>
        <?php echo $form->dropDownList($model, 'bill', array(1 => '是', 0 => '否')); ?>
        <?php echo $form->error($model, 'bill', array('class' => 'form-msg-error-advanced')); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'tel'); ?>
        <?php echo $form->textField($model, 'tel', array('size' => 20, 'maxlength' => 20)); ?>
        <?php echo $form->error($model, 'tel', array('class' => 'form-msg-error-advanced')); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'mobile'); ?>
        <?php echo $form->textField($model, 'mobile', array('size' => 20, 'maxlength' => 20)); ?>
        <?php echo $form->error($model, 'mobile', array('class' => 'form-msg-error-advanced')); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'email'); ?>
        <?php echo $form->textField($model, 'email'); ?>
        <?php echo $form->error($model, 'email', array('class' => 'form-msg-error-advanced')); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'fax'); ?>
        <?php echo $form->textField($model, 'fax', array('size' => 20, 'maxlength' => 20)); ?>
        <?php echo $form->error($model, 'fax', array('class' => 'form-msg-error-advanced')); ?>
    </div>


    <div class="row">
        <?php echo $form->labelEx($model, 'linkman'); ?>
        <?php echo $form->textField($model, 'linkman', array('size' => 50, 'maxlength' => 50)); ?>
        <?php echo $form->error($model, 'linkman', array('class' => 'form-msg-error-advanced')); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'personnel'); ?>
        <?php echo $form->textField($model, 'personnel', array('size' => 50, 'maxlength' => 50)); ?>
        <?php echo $form->error($model, 'personnel', array('class' => 'form-msg-error-advanced')); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'finance'); ?>
        <?php echo $form->textField($model, 'finance', array('size' => 50, 'maxlength' => 50)); ?>
        <?php echo $form->error($model, 'finance', array('class' => 'form-msg-error-advanced')); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'change_personnel_day'); ?>
        <?php echo $form->textField($model, 'change_personnel_day', array('size' => 2, 'maxlength' => 2)); ?> 号
        <?php echo $form->error($model, 'change_personnel_day', array('class' => 'form-msg-error-advanced')); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model, 'pay_day'); ?>
        <?php echo $form->textField($model, 'pay_day', array('size' => 2, 'maxlength' => 2)); ?> 号
        <?php echo $form->error($model, 'pay_day', array('class' => 'form-msg-error-advanced')); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'pay_type'); ?>
        <?php echo $form->textField($model, 'pay_type'); ?>
        <?php echo $form->error($model, 'pay_type', array('class' => 'form-msg-error-advanced')); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'service_info'); ?>
        <?php echo $form->textField($model, 'service_info', array('size' => 60)); ?>
        <?php echo $form->error($model, 'service_info', array('class' => 'form-msg-error-advanced')); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model, 'buy_date'); ?>
        <?php
        $this->widget('ext.CJuiDateTimePicker.CJuiDateTimePicker', array(
            'model' => $model, //Model object
            'attribute' => 'buy_date', //attribute name
            'mode' => 'date' //use "time","date" or "datetime" (default)
        ));
        ?>
        <?php echo $form->error($model, 'buy_date', array('class' => 'form-msg-error-advanced')); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model, 'over_date'); ?>
        <?php
        $this->widget('ext.CJuiDateTimePicker.CJuiDateTimePicker', array(
            'model' => $model, //Model object
            'attribute' => 'over_date', //attribute name
            'mode' => 'date' //use "time","date" or "datetime" (default)
        ));
        ?>
        <?php echo $form->error($model, 'over_date', array('class' => 'form-msg-error-advanced')); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'min_sprice'); ?>
        <?php echo $form->textField($model, 'min_sprice', array('size' => 10, 'maxlength' => 10)); ?>
        <?php echo $form->error($model, 'min_sprice', array('class' => 'form-msg-error-advanced')); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'unit_price'); ?>
        <?php echo $form->textField($model, 'unit_price', array('size' => 10, 'maxlength' => 10)); ?>
        <?php echo $form->error($model, 'unit_price', array('class' => 'form-msg-error-advanced')); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'kf_id'); ?>
        <?php echo $form->dropDownList($model, 'kf_id', CHtml::listData($kfs, 'id', 'name')); ?>
        <?php echo $form->error($model, 'kf_id', array('class' => 'form-msg-error-advanced')); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'responsible'); ?>
        <?php echo $form->dropDownList($model, 'responsible', CHtml::listData($responsible, 'id', 'name')); ?>
        <?php echo $form->error($model, 'responsible', array('class' => 'form-msg-error-advanced')); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'c_status'); ?>
        <?php echo $form->dropDownList($model, 'c_status', Yii::app()->params->cStatus); ?>
        <?php echo $form->error($model, 'c_status', array('class' => 'form-msg-error-advanced')); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'comment_info'); ?>
        <?php echo $form->textArea($model, 'comment_info', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'comment_info', array('class' => 'form-msg-error-advanced')); ?>
    </div>

    <div class="action">
        <?php echo CHtml::submitButton($model->isNewRecord ? '添加' : '保存'); ?>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- form -->
<div class="clear"></div>