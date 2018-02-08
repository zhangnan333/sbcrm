<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <title>远卓社保管理平台</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
        <![endif]-->
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl ?>/themes/datacenter/css/style1.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl ?>/themes/datacenter/lightbox/style5/style.css">
            <link rel="apple-touch-icon" href="<?php echo Yii::app()->baseUrl ?>/themes/datacenter/images/apple-touch-icon.png">
                <link rel="shortcut icon" href="<?php echo Yii::app()->baseUrl ?>/themes/datacenter/images/favicon.ico">
                    <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl ?>/themes/datacenter/styleswitcher/styleswitcher.css" />
                    <script src="<?php echo Yii::app()->baseUrl ?>/themes/datacenter/js/modernizr-1.7.min.js"></script>
                    <style>
                        .ui-combobox {
                            position: relative;
                            display: block;
                            float: left;
                            margin-right: 10px;
                            height: 32px;
                        }

                        .ui-combobox-input {
                            margin: 0;
                            width: 200px;
                            height: 32px;
                            height: 24px	9;
                            padding: 0 0 0 6px;
                            padding: 8px 0 0 6px	9;
                            float: left;
                            border: 1px solid #CCC;
                            margin: 0 -5px 0px 0;
                            -moz-border-radius: 5px;
                            -webkit-border-radius: 5px;
                            border-radius: 5px;
                            background: white;
                        }
                        .ui-button{
                            height: 32px;
                        }
                    </style>
                    <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl ?>/js/colorbox/colorbox.css" />
		<script src="<?php echo Yii::app()->baseUrl ?>/js/colorbox/jquery.colorbox-min.js"></script>
                    </head>
                    <body>
                        <div id="container" style="padding: 0;">
                            
                            <!-- // content starts here // -->
                            <div id="content">
                                <?php echo $content; ?>
                            </div><!-- END "#content" -->
                            
                        </div><!-- END "#container" -->
                        

                        <?php
                    $cs = Yii::app()->getClientScript();
                    $cs->registerCssFile($cs->getCoreScriptUrl() . '/jui/css/base/jquery-ui.css');
                    $cs->registerCoreScript('jquery');
                    $cs->registerScriptFile($cs->getCoreScriptUrl() . '/jui/js/jquery-ui.min.js');
                    $cs->registerScriptFile(Yii::app()->baseUrl . '/themes/datacenter/js/combobox.js');
                    ?>
                    <script src="<?php echo Yii::app()->baseUrl ?>/themes/datacenter/js/pirobox-min.js"></script>
                    <script src="<?php echo Yii::app()->baseUrl ?>/themes/datacenter/js/jquery.select_skin.js"></script>
                    <script src="<?php echo Yii::app()->baseUrl ?>/themes/datacenter/js/jquery.tipsy.js"></script>
                    <script src="<?php echo Yii::app()->baseUrl ?>/themes/datacenter/js/jquery.tweet.js"></script>
                    <script src="<?php echo Yii::app()->baseUrl ?>/themes/datacenter/js/jquery.tablesorter.js"></script>
                    <script src="<?php echo Yii::app()->baseUrl ?>/themes/datacenter/js/treeview.js"></script>
                    <script src="<?php echo Yii::app()->baseUrl ?>/themes/datacenter/js/jquery.cookie.js"></script>
                    <script src="<?php echo Yii::app()->baseUrl ?>/themes/datacenter/js/main.js"></script>
                    <script src="<?php echo Yii::app()->baseUrl ?>/themes/datacenter//styleswitcher/styleswitcher.js"></script>
                    </body>
                    </html>


