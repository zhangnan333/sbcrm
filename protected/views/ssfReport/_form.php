<div class="flexform">
    <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ssf-report-form',
	'enableAjaxValidation'=>false
)); ?>
                    <div class="row">
                <?php echo $form->labelEx($model,'u_id'); ?>
                <?php echo $form->textField($model,'u_id',array('size'=>11,'maxlength'=>11)); ?>
                <?php echo $form->error($model,'u_id', array('class' => 'form-msg-error-advanced')); ?>
            </div>

                        <div class="row">
                <?php echo $form->labelEx($model,'ssf_money'); ?>
                <?php echo $form->textField($model,'ssf_money',array('size'=>10,'maxlength'=>10)); ?>
                <?php echo $form->error($model,'ssf_money', array('class' => 'form-msg-error-advanced')); ?>
            </div>

                        <div class="row">
                <?php echo $form->labelEx($model,'paid_money'); ?>
                <?php echo $form->textField($model,'paid_money',array('size'=>10,'maxlength'=>10)); ?>
                <?php echo $form->error($model,'paid_money', array('class' => 'form-msg-error-advanced')); ?>
            </div>

                        <div class="row">
                <?php echo $form->labelEx($model,'pai_date'); ?>
                <?php echo $form->textField($model,'pai_date'); ?>
                <?php echo $form->error($model,'pai_date', array('class' => 'form-msg-error-advanced')); ?>
            </div>

                        <div class="row">
                <?php echo $form->labelEx($model,'ssf_date'); ?>
                <?php echo $form->textField($model,'ssf_date',array('size'=>7,'maxlength'=>7)); ?>
                <?php echo $form->error($model,'ssf_date', array('class' => 'form-msg-error-advanced')); ?>
            </div>

                    <div class="action">
            <?php echo CHtml::submitButton($model->isNewRecord ? '创建' : '保存'); ?>
        </div>
    <?php $this->endWidget(); ?>
</div><!-- form -->
<div class="clear"></div>