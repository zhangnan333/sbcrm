<div class="flexform">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'sys-menu-form',
        'enableAjaxValidation' => false
            ));
    ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'm_name'); ?>
        <?php echo $form->textField($model, 'm_name', array('size' => 20, 'maxlength' => 50)); ?>
        <?php echo $form->error($model, 'm_name', array('class' => 'form-msg-error-advanced')); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'm_parent'); ?>
        <?php
        echo $form->dropDownList($model, 'm_parent', array('0' => '-选择菜单-') + CHtml::listData(SysMenu::model()->findAll('m_parent=0'), 'id', 'm_name'));
        ?>
        <?php echo $form->error($model, 'm_parent', array('class' => 'form-msg-error-advanced')); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'm_path'); ?>
        <?php echo $form->textField($model, 'm_path', array('size' => 30, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'm_path', array('class' => 'form-msg-error-advanced')); ?>
    </div>


    <div class="row">
        <?php echo $form->labelEx($model, 'm_order'); ?>
        <?php echo $form->textField($model, 'm_order'); ?>
        <?php echo $form->error($model, 'm_order', array('class' => 'form-msg-error-advanced')); ?>
    </div>

    <div class="action">
        <?php echo CHtml::submitButton($model->isNewRecord ? '创建' : '保存'); ?>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- form -->
<div class="clear"></div>