<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "/www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="/www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>远卓社保管理</title>
        <link href="<?php echo Yii::app()->baseUrl ?>/themes/datacenter/css/login-box.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <center>
            <div style="margin-top: 100px;">
                <div id="login-box">
                     <?php
                        $form = $this->beginWidget('CActiveForm', array(
                                    'id' => 'login-form',
                                    'enableAjaxValidation' => true,
                                ));
                        ?>
                        <h1>用户登陆</h1>
                        <div style="margin-top:20px;" id="login-box-name">
                            用户:
                        </div>
                        <div style="margin-top:20px;" id="login-box-field">
                            <input maxlength="2048" size="30" value="" title="Username" class="form-login" name="LoginForm[username]">
                        </div>
                        <div id="login-box-name">密码:</div>
                        <div id="login-box-field">
                            <input type="password" maxlength="2048" size="30" value="" title="Password" class="form-login" name="LoginForm[password]">
                        </div>
                        <br>
                        <span class="login-box-options">
                            <input type="checkbox" value="1" name="LoginForm[rememberMe]"> 记住密码
                            <a style="margin-left:30px;" href="#">忘记密码</a></span>
                        <br>
                        <br>
                       <?php echo CHtml::submitButton('',array('class'=>'login-buttom')); ?>
                       <?php echo $form->error($model, 'username'); ?>
                       <?php echo $form->error($model, 'password'); ?>
                    <?php $this->endWidget(); ?>
                </div>
            </div>
        </center>
    </body>
</html>
