<div class="flexform" style="width: 80%;">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'sys-role-source-form',
        'enableAjaxValidation' => false,
            ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'pid'); ?>
        <?php echo $form->dropDownList($model, 'pid', array('' => '')+CHtml::listData(SysRoleSource::model()->findAll('pid=0'), 'id', 'source_name')); ?>
        <?php echo $form->error($model, 'pid'); ?>
        <div class="clear"></div>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model, 'source_name'); ?>
        <?php echo $form->textField($model, 'source_name', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'source_name'); ?>
        <div class="clear"></div>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model, 'source_value'); ?>
        <?php echo $form->textField($model, 'source_value', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'source_value'); ?>
        <div class="clear"></div>
    </div>

    <div class="action">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->