<div class="flexform">
    <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'documents-sort-form',
	'enableAjaxValidation'=>false
)); ?>
                    <div class="row">
                <?php echo $form->labelEx($model,'sort_name'); ?>
                <?php echo $form->textField($model,'sort_name',array('size'=>60,'maxlength'=>255)); ?>
                <?php echo $form->error($model,'sort_name', array('class' => 'form-msg-error-advanced')); ?>
            </div>

                        <div class="row">
                <?php echo $form->labelEx($model,'sort_note'); ?>
                <?php echo $form->textArea($model,'sort_note',array('rows'=>6, 'cols'=>50)); ?>
                <?php echo $form->error($model,'sort_note', array('class' => 'form-msg-error-advanced')); ?>
            </div>

                    <div class="action">
            <?php echo CHtml::submitButton($model->isNewRecord ? '创建' : '保存'); ?>
        </div>
    <?php $this->endWidget(); ?>
</div><!-- form -->
<div class="clear"></div>