<?php

/**
 * 后台首页几公共处理
 * @author nirsh
 */
class SiteController extends Controller {

    /**
     * 后台首页跳转
     */
    public $layout = "main";

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
//            array(
//                'COutputCache + sitemap,index,compare',
//                'duration' => 2592000,
//                'varyByParam' => array('format'),
//            ),
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        $controller = Yii::app()->getController()->id;
        $action = Yii::app()->getController()->action->id;
        $access = $this->checkAccess($controller, $action);
        return array(
            array('allow',
                'actions' => array('login', 'logout', 'error'),
                'users' => array('*'),
            ),
            array($access,
                'actions' => array($action),
                'users' => array('*'),
            ),
        );
    }

    /**
     * 首页
     */
    public function actionIndex() {
        //最新咨询客户
        $cb = new CDbCriteria;
        $cb->compare('c_status', 0);
        $cb->limit = 10;
        $new_customers = Customer::model()->findAll($cb);
        //公告
        $criteria = new CDbCriteria;
        $criteria->compare('sort_id', 0);
        $criteria->order = 'id DESC';
        $criteria->limit = 10;
        $announcement = Documents::model()->findAll($criteria);

        $this->render('index', array(
            'new_customers' => $new_customers,
            'announcement' => $announcement,
        ));
    }
    
    public function actionCalendar(){
        $this->render('calendar');
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $this->layout = 'empty';
        if (!Yii::app()->user->isGuest) {
            $this->redirect($this->createUrl('index'));
        }
        $model = new LoginForm;
        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {
                $url = Yii::app()->createUrl('site/index');
                $this->redirect($url);
            }
        }
        // display the login form
        $this->renderPartial('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $cookieUid = new CHttpCookie('uid', null);
        $cookieRid = new CHttpCookie('rid', null);
        Yii::app()->request->cookies['uid'] = $cookieUid;
        Yii::app()->request->cookies['rid'] = $cookieRid;
        $url = Yii::app()->createUrl('site/login');
        $this->redirect($url);
    }

    /**
     * 错误显示页面
     */
    public function actionError() {
        //print_r(Yii::app()->errorHandler->error);
        $this->layout = 'main';
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    public function actionSitemap() {
        if (isset($_GET['format'])) {
            $this->renderPartial('sitemap_html');
        } else {
            header('Content-Type: text/xml');
            $this->renderPartial('sitemap_xml');
        }
    }

    /**
     * 转向网站
     */
    public function actionGoto() {
        $url = $_GET['url'];
        $this->redirect($url);
    }

}
