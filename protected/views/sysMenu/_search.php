<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
        
)); ?>
    <fieldset>
        <legend>输入关键字查询</legend>
                                <label>
                <?php echo $form->label($model,'id'); ?>
                <small>输入字段说明</small>
            </label>
            <div class='row'>
                <?php echo $form->textField($model,'id'); ?>
            </div>

                                <label>
                <?php echo $form->label($model,'m_name'); ?>
                <small>输入字段说明</small>
            </label>
            <div class='row'>
                <?php echo $form->textField($model,'m_name',array('size'=>50,'maxlength'=>50)); ?>
            </div>

                                <label>
                <?php echo $form->label($model,'m_parent'); ?>
                <small>输入字段说明</small>
            </label>
            <div class='row'>
                <?php echo $form->textField($model,'m_parent'); ?>
            </div>

                                <label>
                <?php echo $form->label($model,'m_path'); ?>
                <small>输入字段说明</small>
            </label>
            <div class='row'>
                <?php echo $form->textField($model,'m_path',array('size'=>60,'maxlength'=>255)); ?>
            </div>

                                <label>
                <?php echo $form->label($model,'m_role'); ?>
                <small>输入字段说明</small>
            </label>
            <div class='row'>
                <?php echo $form->textField($model,'m_role'); ?>
            </div>

                                <label>
                <?php echo $form->label($model,'m_order'); ?>
                <small>输入字段说明</small>
            </label>
            <div class='row'>
                <?php echo $form->textField($model,'m_order'); ?>
            </div>

                <div class="action">
            <?php echo CHtml::submitButton('查询', array('class' => 'button themed')); ?>
        </div>

        <?php $this->endWidget(); ?>
    </fieldset>
</div><!-- search-form -->