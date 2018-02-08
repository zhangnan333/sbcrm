<div class="flexform">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'visit-log-form',
        'enableAjaxValidation' => false
            ));
    ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'u_type'); ?>
        <?php echo $form->textField($model, 'u_type'); ?>
        <?php echo $form->error($model, 'u_type', array('class' => 'form-msg-error-advanced')); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'u_id'); ?>
        <?php echo $form->textField($model, 'u_id', array('size' => 11, 'maxlength' => 11)); ?>
        <?php echo $form->error($model, 'u_id', array('class' => 'form-msg-error-advanced')); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'info'); ?>
        <?php echo $form->textArea($model, 'info', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'info', array('class' => 'form-msg-error-advanced')); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'vu_id'); ?>
        <?php echo $form->textField($model, 'vu_id', array('size' => 11, 'maxlength' => 11)); ?>
        <?php echo $form->error($model, 'vu_id', array('class' => 'form-msg-error-advanced')); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'visit_date'); ?>
        <?php echo $form->textField($model, 'visit_date'); ?>
        <?php echo $form->error($model, 'visit_date', array('class' => 'form-msg-error-advanced')); ?>
    </div>

    <div class="action">
        <?php echo CHtml::submitButton($model->isNewRecord ? '创建' : '保存'); ?>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- form -->
<div class="clear"></div>