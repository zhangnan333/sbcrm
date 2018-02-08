<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'web-coupon-form',
        'enableAjaxValidation' => false,
            ));
    ?>

    <div class="alert alert-info">Fields with <span class="required">*</span> are required.</div>

    <div>
        <?php echo $form->labelEx($model, 'web_domain'); ?>
        <?php echo $form->textField($model, 'web_domain', array('size' => 60, 'maxlength' => 255, 'class' => 'input-xxlarge', 'placeholder' => 'e.g.., Example.com')); ?>
        <?php echo $form->error($model, 'web_domain', array('class' => 'alert alert-error')); ?>
    </div>

    <div>
        <?php echo $form->labelEx($model, 'code'); ?>
        <?php echo $form->textField($model, 'code', array('size' => 60, 'maxlength' => 255, 'class' => 'input-xxlarge', 'placeholder' => 'e.g., RETAILMENOT')); ?>
        <?php echo $form->error($model, 'code', array('class' => 'alert alert-error')); ?>
    </div>

    <div>
        <?php echo $form->labelEx($model, 'code_describe'); ?>
        <?php echo $form->textArea($model, 'code_describe', array('class' => 'input-xxlarge', 'placeholder' => 'e.g., 10% off all shoes and accessories at Example.com. Excludes sale items. Expires 2/12/2020')); ?>
        <?php echo $form->error($model, 'code_describe'); ?>
    </div>

    <div>
        <?php echo $form->labelEx($model, 'expiration_date'); ?>
        <?php echo $form->textField($model, 'expiration_date', array('class' => 'input-xxlarge', 'placeholder' => '(mm/dd/yy)')); ?>
        <?php echo $form->error($model, 'expiration_date'); ?>
        <script>
            $(function(){
                $('#WebCoupon_expiration_date').datepicker().on('changeDate', function(ev){
                  $('#WebCoupon_expiration_date').datepicker('hide');
                });
            });
        </script>
    </div>

    <div>
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Submit' : 'Update', array('class' => 'btn btn-success btn-large')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->