<div class="flexform">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'sys-admin-form',
        'enableAjaxValidation' => false
            ));
    ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'rid'); ?>
        <?php echo $form->dropDownList($model, 'rid', SysRole::model()->getRoles()); ?>
        <?php echo $form->error($model, 'rid', array('class' => 'form-msg-error-advanced')); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'user_name'); ?>
        <?php echo $form->textField($model, 'user_name', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'user_name', array('class' => 'form-msg-error-advanced')); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'user_pass'); ?>
        <?php echo $form->textField($model, 'user_pass', array('size' => 32, 'maxlength' => 32)); ?>
        <?php echo $form->error($model, 'user_pass', array('class' => 'form-msg-error-advanced')); ?>
    </div>

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