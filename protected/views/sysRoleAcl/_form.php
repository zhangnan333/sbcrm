<div class="flexform" style="width: 80%;">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'sys-role-acl-form',
        'enableAjaxValidation' => false,
            ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'rid'); ?>
        <?php echo $form->dropDownList($model, 'rid', array('' => '') + CHtml::listData(SysRole::model()->findAll(), 'id', 'role_name')); ?>
        <?php echo $form->error($model, 'rid'); ?>
        <div class="clear"></div>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'controller'); ?>
        <?php echo $form->dropDownList($model, 'controller', CHtml::listData(SysRoleSource::model()->findAll('pid=0'), 'source_value', 'source_name'), array('onchange' => 'getAction(this)')); ?>
        <?php echo $form->error($model, 'controller'); ?>
        <div class="clear"></div>
        <script>
            function getAction(obj){
                $.post("<?php echo $this->createUrl('ajax');?>", {action:"getActions", controller:obj.value}, function(data){
                    $("#actions").html('<input type="checkbox" name="actions[]" value="*" id="action-all" /><label for="action-all">所有</label>');
                    $.each(data, function(i, n){
                        $("#actions").append('<input type="checkbox" value="'+n.source_value+'" name="actions[]" id="action-'+n.source_value+'" /><label for="action-'+n.source_value+'">'+n.source_name+'</label>');
                    });
                }, 'json');
            }
        </script>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'action'); ?>
        <?php //echo $form->textField($model, 'action', array('size' => 60, 'maxlength' => 255)); ?>
        <div id="actions">
            <input type="checkbox" name="actions[]" value="*" id="action-all" />
            <label for="action-all">所有</label>
            <?php 
            if(!empty($model->controller))
            {
                $s = SysRoleSource::model()->findByAttributes(array('source_value'=>$model->controller));
                $actions = SysRoleSource::model()->findAll("pid=$s->id");
                foreach($actions as $action)
                {
                    echo '<input type="checkbox" name="actions[]" value="'.$action->source_value.'" id="action-'.$action->source_value.'" '.($model->action==$action->source_value?'checked':'').' />';
                    echo '<label for="action-'.$action->source_value.'">'.$action->source_name.'</label>';
                }
            }
            ?>
        </div>
        <?php echo $form->error($model, 'action'); ?>
        <div class="clear"></div>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'access'); ?>
        <?php echo $form->dropDownList($model, 'access', $model->accessArray); ?>
        <?php echo $form->error($model, 'access'); ?>
        <div class="clear"></div>
    </div>

    <div class="action">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
        <div class="clear"></div>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->