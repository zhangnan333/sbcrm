<div class="flexform">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'web-site-form',
        'enableAjaxValidation' => false,
            ));
    ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'web_logo'); ?>
        <?php echo $form->textField($model, 'web_logo', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'web_logo'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'web_domain'); ?>
        <?php echo $form->textField($model, 'web_domain', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'web_domain'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'web_name'); ?>
        <?php echo $form->textField($model, 'web_name', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'web_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'web_describe'); ?>
        <?php echo $form->textArea($model, 'web_describe', array('cols' => 60));?>
        <?php echo $form->error($model, 'web_describe'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'web_status'); ?>
        <?php echo $form->textField($model, 'web_status'); ?>
        <?php echo $form->error($model, 'web_status'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'append_date'); ?>
        <?php echo $form->textField($model, 'append_date'); ?>
        <?php echo $form->error($model, 'append_date'); ?>
    </div>

    <div class="action">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
<div class="clear"></div>