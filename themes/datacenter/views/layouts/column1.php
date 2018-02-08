<?php $this->beginContent('/layouts/main'); ?>
<ul id="navbar">
    <li><a><span class="icon_text top-left"></span></a></li>
   <?php echo Menu::model()->getMenu(isset($_REQUEST['aId'])?$_REQUEST['aId']:'')?>
    <li><a><span class="icon_text top-right"></span></a></li>
</ul>
<div id="subnavbar">
</div>
<div id="content">
    <div class="width15 fl">
        <div class="box themed_box">
            <h2 class="box-header">操作</h2>
            <div class="box-content">
                <?php
                $this->widget('zii.widgets.CMenu', array(
                    'items' => $this->menu,
                    'htmlOptions' => array('class' => ''),
                ));
                ?>
            </div>
          </div>
    </div>
    <div class="width85 fr">
         <?php echo $content; ?>
    </div>
    <div class="clear"></div>
</div>
<?php $this->endContent(); ?>