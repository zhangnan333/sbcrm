<div class="flexform">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'ssf-form',
        'enableAjaxValidation' => false
            ));
    ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'ssf_type'); ?>
        <?php echo $form->dropDownlist($model, 'ssf_type', array(0 => '通用项目') + CHtml::listData(SsfTypes::model()->findAll(), 'id', 'name')); ?>
        <?php echo $form->error($model, 'ssf_type', array('class' => 'form-msg-error-advanced')); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'ssf_name'); ?>
        <?php echo $form->textField($model, 'ssf_name', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'ssf_name', array('class' => 'form-msg-error-advanced')); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'base_number'); ?>
        <?php echo $form->textField($model, 'base_number', array('size' => 10, 'maxlength' => 10)); ?>
        <?php echo $form->error($model, 'base_number', array('class' => 'form-msg-error-advanced')); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'business'); ?>
        <?php echo $form->textField($model, 'business', array('size' => 3, 'maxlength' => 3)); ?><b>%</b>
        <?php echo $form->error($model, 'business', array('class' => 'form-msg-error-advanced')); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'personal'); ?>
        <?php echo $form->textField($model, 'personal', array('size' => 3, 'maxlength' => 3)); ?><b>%</b>
        <?php echo $form->error($model, 'personal', array('class' => 'form-msg-error-advanced')); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'is_change'); ?>
        <?php echo $form->dropDownList($model, 'is_change', Ssf::model()->changes); ?>
        <?php echo $form->error($model, 'is_change', array('class' => 'form-msg-error-advanced')); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'ssf_order'); ?>
        <?php echo $form->textField($model, 'ssf_order'); ?>
        <?php echo $form->error($model, 'ssf_order', array('class' => 'form-msg-error-advanced')); ?>
    </div>


    <div class="action">
        <?php echo CHtml::submitButton($model->isNewRecord ? '创建' : '保存'); ?>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- form -->
<div class="clear"></div>