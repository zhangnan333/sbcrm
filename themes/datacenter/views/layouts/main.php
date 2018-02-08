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
                            height: 24px	;
                            padding: 0 0 0 6px;
                            padding: 8px 0 0 6px	;
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
                        <div id="container">
                            <header>
                                <div id="meta-wrap">
                                    <ul id="user-meta">
                                        <li>欢迎登录, 
                                            <img src="<?php echo Yii::app()->baseUrl ?>/themes/datacenter/images/icons/9/005_13.png" alt="" />
                                            <a href="#" title="">
                                                <b><?php echo Yii::app()->request->cookies['name']->value; ?></b>
                                            </a>
                                            <!--                            <a href="#" class="user-msg-baloon" title="3 new messages">3</a>-->
                                        </li>
                                        <li>|
                                        </li>
                                        <li>
                                            <img src="<?php echo Yii::app()->baseUrl ?>/themes/datacenter/images/icons/9/005_12.png" alt="" /> <a href="<?php echo $this->createUrl('site/logout') ?>">退出</a>
                                        </li>
                                    </ul>
                                </div>
                                <div id="menu-bar" class="corners shadow">
                                    <div class="menu-bar-inner corners">
                                        <a href="<?php echo $this->createUrl('site/index'); ?>" title="" id="logo">
                                            <h1>远卓社保管理</h1>
                                        </a>
                                        <?php
                                        //栏目生成
                                        $rid = (int) Yii::app()->request->cookies['rid']->value;
                                        $rmenu = MRole::model()->find('s_name=' . $rid);
                                        $rmenu = $rmenu->attributes;
                                        $rmenu = explode(',', $rmenu['menu_pid']);
                                        $menus = array();
                                        $cr = new CDbCriteria;
                                        $cr->order = 'm_parent ASC,m_order ASC';
                                        foreach (SysMenu::model()->findAll($cr) as $m) {
                                            if ($m->m_parent == 0 && in_array($m->id, $rmenu)) {
                                                $menus[$m->id]['parent'] = $m->attributes;
                                            } elseif (in_array($m->id, $rmenu)) {
                                                $menus[$m->m_parent]['sub'][] = $m->attributes;
                                            }
                                        }
                                        ?>
                                        <ul id="menu">
                                            <?php
                                            foreach ($menus as $menu):
                                                ?>
                                                <li class="sep">
                                                    <a href="<?php echo $this->createUrl($menu['parent']['m_path']); ?>"><?php echo $menu['parent']['m_name']; ?></a>
                                                    <?php if (isset($menu['sub'])): ?>
                                                        <ul class="second">
                                                            <?php
                                                            foreach ($menu['sub'] as $sm):
                                                                ?>
                                                                 <li>
                                                                    <a href="<?php echo $this->createUrl($sm['m_path']); ?>" title=""><?php echo $sm['m_name'];?></a>
                                                                </li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                        <?php
                                                    endif;
                                                    ?>
                                                </li>
                                                <?php
                                            endforeach;
                                            ?>
                                            
                                        </ul>
                                        <form action="" method="post" id="search">
                                            <div>
                                                <input type="text" name="s" onFocus="if(this.value=='输入关键字查询...') this.value='';" onBlur="if(this.value=='')this.value='输入关键字查询...';" value="输入关键字查询..." id="input-s" />
                                                <input type="submit" value="" name="submit" id="search-submit" />
                                            </div>
                                            <a href="javascript:void(null);" title="" class="<?php echo isset($_REQUEST['aId']) ? 'open' : 'close'; ?>" id="toggle-menu"></a>
                                        </form>
                                    </div>
                                </div><!-- END "#menu-bar" -->
                                <!--
                                <ul id="submenu" class="corners shadow" >       
                                    <li>
                                        <a href="contacts.php" class="icon-menu corners">
                                            <img src="images/icons/48/address-book-new.png" alt="" title="" />
                                            <span>Contacts</span>
                                        </a>
                                    </li>   
                                </ul>
                                -->
                                <!-- END "#submenu" -->

                                <div id="breadcrumbs" class="corners shadow">
                                    <p class="left"><img src="<?php echo Yii::app()->baseUrl ?>/themes/datacenter/images/icons/9/005_08.png" alt="" />
                                        <?php
                                        $this->widget('zii.widgets.CBreadcrumbs', array(
                                            'links' => $this->breadcrumbs,
                                            'htmlOptions' => array('style' => 'margin-top:5px'),
                                            'tagName' => 'a'
                                        ));
                                        ?>
                                    </p>
                                    <p class="right"></p>
                                    <div id="mastertoggle">
                                        <a href="javascript:void(null);" title="Close all boxes" class="togglecloseall corners tip"></a> 
                                        <a href="javascript:void(null);" title="Open all boxes" class="toggleopenall corners tip"></a>
                                    </div>
                                </div><!-- END "#breadcrumbs" -->                                 
                            </header><!-- END header -->
                            <!-- // content starts here // -->
                            <div id="content">
                                <?php echo $content; ?>
                            </div><!-- END "#content" -->
                            <!-- // footer starts here // -->
                        </div><!-- END "#container" -->
<!--                        <footer>-->
<!--                            <p class="left">Usfine v1.7</p>-->
<!--                            <p class="right">Copyright &copy; --><?php //echo date('Y'); ?><!-- - -->
<!--                                <a href="http://www.usfine.com" title="">www.Usfine.com</a> by -->
<!--                                <a href="http://www.usfine.com" title="">Usfine</a>-->
<!--                            </p>-->
<!--                        </footer><!-- END footer --> -->
                        <script>
                            $(function(){
                                //$('div.inbox-sf select').combobox();
                            });
                        </script>
                    </body>
                    </html>

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

