<div class="flexform">
    <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'service-form',
	'enableAjaxValidation'=>false
)); ?>
                    <div class="row">
                <?php echo $form->labelEx($model,'name'); ?>
                <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
                <?php echo $form->error($model,'name', array('class' => 'form-msg-error-advanced')); ?>
            </div>

                        <div class="row">
                <?php echo $form->labelEx($model,'price'); ?>
                <?php echo $form->textField($model,'price',array('size'=>5,'maxlength'=>5)); ?>
                <?php echo $form->error($model,'price', array('class' => 'form-msg-error-advanced')); ?>
            </div>

                        <div class="row">
                <?php echo $form->labelEx($model,'content'); ?>
                <?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
                <?php echo $form->error($model,'content', array('class' => 'form-msg-error-advanced')); ?>
            </div>

                        <div class="row">
                <?php echo $form->labelEx($model,'product_style'); ?>
                <?php echo $form->textField($model,'product_style',array('size'=>60,'maxlength'=>255)); ?>
                <?php echo $form->error($model,'product_style', array('class' => 'form-msg-error-advanced')); ?>
            </div>

                        <div class="row">
                <?php echo $form->labelEx($model,'photo_num'); ?>
                <?php echo $form->textField($model,'photo_num',array('size'=>60,'maxlength'=>255)); ?>
                <?php echo $form->error($model,'photo_num', array('class' => 'form-msg-error-advanced')); ?>
            </div>

                        <div class="row">
                <?php echo $form->labelEx($model,'truing_num'); ?>
                <?php echo $form->textField($model,'truing_num',array('size'=>4,'maxlength'=>4)); ?>
                <?php echo $form->error($model,'truing_num', array('class' => 'form-msg-error-advanced')); ?>
            </div>

                        <div class="row">
                <?php echo $form->labelEx($model,'tag'); ?>
                <?php echo $form->textField($model,'tag',array('size'=>4,'maxlength'=>4)); ?>
                <?php echo $form->error($model,'tag', array('class' => 'form-msg-error-advanced')); ?>
            </div>

                        <div class="row">
                <?php echo $form->labelEx($model,'order_sort'); ?>
                <?php echo $form->textField($model,'order_sort',array('size'=>5,'maxlength'=>5)); ?>
                <?php echo $form->error($model,'order_sort', array('class' => 'form-msg-error-advanced')); ?>
            </div>

                        <div class="row">
                <?php echo $form->labelEx($model,'status'); ?>
                <?php echo $form->textField($model,'status'); ?>
                <?php echo $form->error($model,'status', array('class' => 'form-msg-error-advanced')); ?>
            </div>

                    <div class="action">
            <?php echo CHtml::submitButton($model->isNewRecord ? '创建' : '保存'); ?>
        </div>
    <?php $this->endWidget(); ?>
</div><!-- form -->
<div class="clear"></div>