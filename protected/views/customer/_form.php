<div class="flexform">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'customer-form',
        'enableAjaxValidation' => false
            ));
    ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'b_id'); ?>
        <?php
        $b_name = '';
        if ($model->b_id != 0) {
            $business = Business::model()->findByPk($model->b_id);
            $b_name = $business->business_name;
            if (empty($model->id))
                $model->c_status = $business->c_status;
        }

        echo CHtml::textField('bname', $b_name, array('size' => 50, 'readonly' => true));
        echo $form->hiddenField($model, 'b_id', array('size' => 11, 'maxlength' => 11));
        ?>
        <?php echo $form->error($model, 'b_id', array('class' => 'form-msg-error-advanced')); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'c_status'); ?>
        <?php echo $form->dropDownList($model, 'c_status', Yii::app()->params->cStatus); ?>
        <?php echo $form->error($model, 'c_status', array('class' => 'form-msg-error-advanced')); ?>
    </div>
    
     <div class="row">
        <?php echo $form->labelEx($model, 'ssf_type'); ?>
        <?php echo $form->dropDownList($model, 'ssf_type', array(0 => '未定') + CHtml::listData(SsfTypes::model()->findAll(), 'id', 'name')); ?>
        <?php echo $form->error($model, 'ssf_type', array('class' => 'form-msg-error-advanced')); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('size' => 50, 'maxlength' => 50)); ?>
        <?php echo $form->error($model, 'name', array('class' => 'form-msg-error-advanced')); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'id_card'); ?>
        <?php echo $form->textField($model, 'id_card', array('size' => 50, 'maxlength' => 18)); ?>
        <?php echo $form->error($model, 'id_card', array('class' => 'form-msg-error-advanced')); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'sex'); ?>
        <?php echo $form->dropDownList($model, 'sex', Yii::app()->params->sexs); ?>
        <?php echo $form->error($model, 'sex', array('class' => 'form-msg-error-advanced')); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'hk_addr'); ?>
        <?php echo $form->textField($model, 'hk_addr', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'hk_addr', array('class' => 'form-msg-error-advanced')); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'mobile'); ?>
        <?php echo $form->textField($model, 'mobile', array('size' => 15, 'maxlength' => 15)); ?>
        <?php echo $form->error($model, 'mobile', array('class' => 'form-msg-error-advanced')); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'phone'); ?>
        <?php echo $form->textField($model, 'phone', array('size' => 50, 'maxlength' => 50)); ?>
        <?php echo $form->error($model, 'phone', array('class' => 'form-msg-error-advanced')); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'wages'); ?>
        <?php echo $form->textField($model, 'wages', array('size' => 50, 'maxlength' => 50)); ?>
        <?php echo $form->error($model, 'wages', array('class' => 'form-msg-error-advanced')); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model, 'service_charge'); ?>
        <?php echo $form->textField($model, 'service_charge'); ?>
        <?php echo $form->error($model, 'service_charge', array('class' => 'form-msg-error-advanced')); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model, 'sc_type'); ?>
        <?php echo $form->dropDownList($model, 'sc_type', Yii::app()->params->scTypes); ?>
        <?php echo $form->error($model, 'sc_type', array('class' => 'form-msg-error-advanced')); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'buy_date'); ?>
        <?php
        //echo $form->textField($model, 'buy_date'); 
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
        //echo $form->textField($model, 'over_date');
        $this->widget('ext.CJuiDateTimePicker.CJuiDateTimePicker', array(
            'model' => $model, //Model object
            'attribute' => 'over_date', //attribute name
            'mode' => 'date' //use "time","date" or "datetime" (default)
        ));
        ?>
        <?php echo $form->error($model, 'over_date', array('class' => 'form-msg-error-advanced')); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'comment_info'); ?>
        <?php echo $form->textArea($model, 'comment_info', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'comment_info', array('class' => 'form-msg-error-advanced')); ?>
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

    <div class="action">
        <?php echo CHtml::submitButton($model->isNewRecord ? '创建' : '保存'); ?>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- form -->
<div class="clear"></div>