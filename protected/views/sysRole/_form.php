<div class="flexform" style="width: 80%;">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
                'id' => 'sys-role-form',
                'enableAjaxValidation' => false,
            ));
    ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'role_name'); ?>
        <?php echo $form->textField($model, 'role_name', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'role_name'); ?>
        <div class="clear"></div>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'role_info'); ?>
        <?php echo $form->textArea($model, 'role_info', array('rows' => 6, 'cols' => 76)); ?>
        <?php echo $form->error($model, 'role_info'); ?>
        <div class="clear"></div>
    </div>

    <div class="action">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
        <div class="clear"></div>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->