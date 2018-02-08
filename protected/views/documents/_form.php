<div class="flexform">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'documents-form',
        'enableAjaxValidation' => false
    ));
    ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'sort_id'); ?>
        <?php echo $form->dropDownList($model, 'sort_id', array(0 => '公告') + CHtml::listData(DocumentsSort::model()->findAll(), 'id', 'sort_name')); ?>
        <?php echo $form->error($model, 'sort_id', array('class' => 'form-msg-error-advanced')); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'title', array('class' => 'form-msg-error-advanced')); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'info'); ?>
        <div style="float: left;width: 60%;">
            <?php
            $this->widget('ext.imperavi-redactor-widget-master.ImperaviRedactorWidget', array(
                'model' => $model,
                'attribute' => 'info',
                'name' => 'info',
                'options' => array(
                    'lang' => 'zh_cn',
                    'minHeight' => 400,
                    'imageUpload' => Yii::app()->homeUrl . 'imgUpload.php'
                ),
            ));
            ?>
        </div>

        <?php echo $form->error($model, 'info', array('class' => 'form-msg-error-advanced')); ?>
    </div>



    <div class="action">
        <?php echo CHtml::submitButton($model->isNewRecord ? '创建' : '保存'); ?>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- form -->
<div class="clear"></div>