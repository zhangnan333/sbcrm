<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
    <head>    
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">   
    </head>
    <body>
        <div>
            <div id="calhead" style="padding-left:1px;padding-right:1px;">          
                <div class="cHead"><div class="ftitle"><?php echo CHtml::link(Yii::app()->name, Yii::app()->controller->createUrl('/')); ?></div>
                    <div id="loadingpannel" class="ptogtitle loadicon" style="display: none;">数据加载中...</div>
                    <div id="errorpannel" class="ptogtitle loaderror" style="display: none;">加载失败，请重试！</div>
                </div>          

                <div id="caltoolbar" class="ctoolbar">
                    <div id="faddbtn" class="fbutton">
                        <?php if (!array_key_exists('readonly', $this->module->wd_options) || $this->module->wd_options['readonly'] != 'JS:true') : // TODO make this prettier ?>
                            <div>
                                <span title='Click to Create New Event' class="addcal">新建日程</span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="btnseparator"></div>
                    <div id="showtodaybtn" class="fbutton">
                        <div><span title='Click to back to today ' class="showtoday">今天</span></div>
                    </div>
                    <div class="btnseparator"></div>

                    <div id="showdaybtn" class="fbutton">
                        <div><span title='天' class="showdayview">天</span></div>
                    </div>
                    <div  id="showweekbtn" class="fbutton">
                        <div><span title='周' class="showweekview">周</span></div>
                    </div>
                    <div  id="showmonthbtn" class="fbutton fcurrent">
                        <div><span title='月' class="showmonthview">月</span></div>

                    </div>
                    <div class="btnseparator"></div>
                    <div  id="showreflashbtn" class="fbutton">
                        <div><span title='刷新' class="showdayflash">刷新</span></div>
                    </div>
                    <div class="btnseparator"></div>
                    <div id="sfprevbtn" title="Prev"  class="fbutton">
                        <span class="fprev"></span>

                    </div>
                    <div id="sfnextbtn" title="Next" class="fbutton">
                        <span class="fnext"></span>
                    </div>
                    <div class="fshowdatep fbutton">
                        <div>
                            <input type="hidden" name="txtshow" id="hdtxtshow" />
                            <span id="txtdatetimeshow">加载</span>

                        </div>
                    </div>

                    <div class="clear"></div>
                </div>
            </div>
            <div style="padding:1px;">

                <div class="t1 chromeColor">
                    &nbsp;</div>
                <div class="t2 chromeColor">
                    &nbsp;</div>
                <div id="dvCalMain" class="calmain printborder">
                    <div id="gridcontainer" style="overflow-y: visible;">
                    </div>
                </div>
                <div class="t2 chromeColor">

                    &nbsp;</div>
                <div class="t1 chromeColor">
                    &nbsp;
                </div>   
            </div>
        </div>
    </body>
</html>