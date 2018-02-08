<?php

class DefaultController extends Controller {

    public $layout = '/layouts/wdcalendar';

    public function actionIndex() {
        $this->settingsForJs();
        $this->render('index');
    }

    protected function beforeRender($view) {
        if (!$this->module->embed) {
            $this->layout = '/layouts/wdcalendar';
        }

        return parent::beforeRender($view);
    }

    /**
     * actionDatafeed 
     *
     * this action makes it possible for us to call datafeed as a Yii
     * and it just simply loads the original datafeed.php file
     *
     * @access public
     * @return void
     */
    public function actionDatafeed() {
        $method = $_GET["method"];
        $model = new Jqcalendar();
        switch ($method) {
            case 'add':
                $ret = $model->addCalendar($_POST["CalendarStartTime"], $_POST["CalendarEndTime"], $_POST["CalendarTitle"], $_POST["IsAllDayEvent"]);
                break;
            case 'list':
                $ret = $model->listCalendar($_POST["showdate"], $_POST["viewtype"]);
                break;
            case 'adddetails':
                $st = $_POST["stpartdate"] . " " . $_POST["stparttime"];
                $et = $_POST["etpartdate"] . " " . $_POST["etparttime"];
                if (isset($_GET["id"]) && (int) $_GET['id']) {
                    $ret = $model->updateDetailedCalendar($_GET["id"], $st, $et, $_POST["Subject"], isset($_POST["IsAllDayEvent"]) ? 1 : 0, $_POST["Description"], $_POST["Location"], $_POST["colorvalue"], $_POST["timezone"]);
                } else {
                    $ret = $model->addDetailedCalendar($st, $et, $_POST["Subject"], isset($_POST["IsAllDayEvent"]) ? 1 : 0, $_POST["Description"], $_POST["Location"], $_POST["colorvalue"], $_POST["timezone"]);
                }
                break;
            case 'remove':
                $ret = $model->removeCalendar($_POST["calendarId"]);
                break;
        }
        echo json_encode($ret);
    }

    /**
     * actionEdit  
     * 
     * this action makes it possible for us to call edit as a Yii action
     * and it just simply loads the original edit.php file
     *
     * @access public
     * @return void
     */
    public function actionEdit() {
        $wdcalendar_assets = $this->module->getAssetsUrl();
        $id = (int)$_GET['id'];
        $event = Jqcalendar::model()->findByPk($id);
        $this->render('edit', array(
            'wdcalendar_assets' => $wdcalendar_assets,
            'event' => $event
        ));
    }

    /**
     * settingsForJs 
     * 
     * @access public
     * @return void
     */
    public function settingsForJs() {
        $wdcalendar_assets = $this->module->getAssetsUrl();

        $cs = Yii::app()->clientScript;
        $cs->registerLinkTag("stylesheet", "text/css", $wdcalendar_assets . '/css/alert.css', NULL);
        $cs->registerLinkTag("stylesheet", "text/css", $wdcalendar_assets . '/css/calendar.css', NULL);
        $cs->registerLinkTag("stylesheet", "text/css", $wdcalendar_assets . '/css/colorselect.css', NULL);
        $cs->registerLinkTag("stylesheet", "text/css", $wdcalendar_assets . '/css/dailog.css', NULL);
        $cs->registerLinkTag("stylesheet", "text/css", $wdcalendar_assets . '/css/dp.css', NULL);
        $cs->registerLinkTag("stylesheet", "text/css", $wdcalendar_assets . '/css/dropdown.css', NULL);
        $cs->registerLinkTag("stylesheet", "text/css", $wdcalendar_assets . '/css/main.css', NULL);
        $cs->registerLinkTag("stylesheet", "text/css", $wdcalendar_assets . '/css/Error.css', NULL);

        $cs->registerScriptFile($wdcalendar_assets . '/js/Common.js', CClientScript::POS_END);

        // for EDIT
        $cs->registerScriptFile($wdcalendar_assets . '/js/jquery.form.js', CClientScript::POS_END);
        //$cs->registerScriptFile( $wdcalendar_assets . '/js/jquery.validate.js', CClientScript::POS_END);
        $cs->registerScriptFile($wdcalendar_assets . '/js/datepicker_lang_US.js', CClientScript::POS_END);
        $cs->registerScriptFile($wdcalendar_assets . '/js/jquery.datepicker.js', CClientScript::POS_END);
        $cs->registerScriptFile($wdcalendar_assets . '/js/jquery.dropdown.js', CClientScript::POS_END);
        $cs->registerScriptFile($wdcalendar_assets . '/js/jquery.colorselect.js', CClientScript::POS_END);



        $cs->registerScriptFile($wdcalendar_assets . '/js/jquery.alert.js', CClientScript::POS_END);
        $cs->registerScriptFile($wdcalendar_assets . '/js/jquery.ifrmdailog.js', CClientScript::POS_END);
        $cs->registerScriptFile($wdcalendar_assets . '/js/wdCalendar_lang_CN.js', CClientScript::POS_END);
        $cs->registerScriptFile($wdcalendar_assets . '/js/jquery.calendar.js', CClientScript::POS_END);
        $cs->registerScriptFile($wdcalendar_assets . '/js/wdcal.js', CClientScript::POS_END);
        $cs->registerScript('absolute_datafeed_url', 'var absolute_datafeed_url="' . Yii::app()->controller->createAbsoluteUrl('/wdcalendar/default/datafeed') . '";', CClientScript::POS_HEAD);
        $cs->registerScript('absolute_edit_url', 'var absolute_edit_url="' . Yii::app()->controller->createUrl('/wdcalendar/default/edit') . '";', CClientScript::POS_HEAD);
        $cs->registerScript('absolute_default_url', 'var absolute_default_url="' . Yii::app()->controller->createUrl('/wdcalendar/default/') . '";', CClientScript::POS_HEAD);
        $cs->registerScript('wd_url_separator', "var wd_url_separator='" . ( Yii::app()->urlManager->urlFormat == 'get' ? '&' : '?' ) . "';", CClientScript::POS_HEAD);

        // and finally let's load the calendar options
        $wd_options_out = '{';
        foreach ($this->module->getWdOptions() as $option => $val) {
            // JS: means we are passing a JS variable/function/callback etc
            if (preg_match('/^JS:/', $val)) {
                $wd_options_out .= $option . ':' . str_replace('JS:', '', $val) . ',';
            } else {
                $wd_options_out .= "$option:\"$val\",";
            }
        }
        $wd_options_out = preg_replace('/,$/', '}', $wd_options_out);
        $cs->registerScript('wd_options', 'var wd_options=' . $wd_options_out . ';', CClientScript::POS_HEAD);
    }

}
