<div class="flexform">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'ssf-types-form',
        'enableAjaxValidation' => false
            ));
    ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
<?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 255)); ?>
<?php echo $form->error($model, 'name', array('class' => 'form-msg-error-advanced')); ?>
    </div>

    <div class="action">
    <?php echo CHtml::submitButton($model->isNewRecord ? '创建' : '保存'); ?>
    </div>
<?php $this->endWidget(); ?>
</div><!-- form -->
<div class="clear"></div>