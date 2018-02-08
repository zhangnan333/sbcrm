<div class="flexform">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'question-form',
        'enableAjaxValidation' => false
            ));
    ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'question'); ?>
        <?php echo $form->textField($model, 'question', array('size' => 110, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'question', array('class' => 'form-msg-error-advanced')); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'answer'); ?>
        <?php echo $form->textArea($model, 'answer', array('rows' => 6, 'cols' => 150)); ?>
        <?php echo $form->error($model, 'answer', array('class' => 'form-msg-error-advanced')); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'order_sort'); ?>
        <?php echo $form->textField($model, 'order_sort', array('size' => 5, 'maxlength' => 5)); ?>
        <?php echo $form->error($model, 'order_sort', array('class' => 'form-msg-error-advanced')); ?>
    </div>

    <div class="action">
        <?php echo CHtml::submitButton($model->isNewRecord ? '创建' : '保存'); ?>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- form -->
<div class="clear"></div>