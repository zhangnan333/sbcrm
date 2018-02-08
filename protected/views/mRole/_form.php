
<div class="flexform">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'mrole-form',
        'enableAjaxValidation' => false
            ));
    ?>
    <div class="row">
        <?php echo $form->labelEx($model, 's_name'); ?>
        <?php echo $form->dropDownList($model, 's_name', array('' => '') + SysRole::model()->getRoles()); ?>
        <?php echo $form->error($model, 's_name', array('class' => 'form-msg-error-advanced')); ?>
    </div>


       <!--            <small>角色拥有菜单权限</small>-->
    <div class='row' >
        <?php echo $form->labelEx($model, 'menu_pid'); ?>
        <div style="margin-left: 130px">
            <?php
            $this->widget(
                    'application.extensions.emultiselect.EMultiSelect', array(
                'sortable' => false,
                'searchable' => true
                    )
            );
            $data = array();
            $sOption = array();
            $cdbc = new CDbCriteria;
            $cdbc->compare('m_parent', 0);
            $cdbc->order = "id ASC";
            $tracks = SysMenu::model()->findAll($cdbc);
            foreach ($tracks as $track) {
                $str = SysMenu::model()->findAll("m_parent='" . $track->id . "'");
                $data[$track->id] = $track->m_name;
                foreach ($str as $stres) {
                    $data[$stres->id] = '┗ ' . $stres->m_name;
                }
                
            }
            foreach(explode(',', $model->menu_pid) as $v){
                $sOption[$v] = array('selected' => 'selected');
            }
           
            echo $form->dropDownList(
                    $model, 
                    'menu_pid', 
                    $data, 
                    array(
                   'multiple' => 'multiple',
                   'key' => 'id',
                   'class' => 'multiselect',
                   'options' => $sOption
                )
            );
            ?>

        </div>
        <?php echo $form->error($model, 'menu_pid', array('class' => 'form-msg-error-advanced')); ?>
    </div>
    <div class="action">
        <?php echo CHtml::submitButton($model->isNewRecord ? '创建' : '保存'); ?>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- form -->
<div class="clear"></div>
