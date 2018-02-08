<?php

class WebCouponController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = 'fluid2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
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
                'actions' => array('index', 'view', 'create'),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($domain) {
        Yii::app()->theme = 'topmall';
        
        //打折码列表
        $dataProvider = new CActiveDataProvider('WebCoupon');
        $cr = new CDbCriteria;
        $cr->compare('status', 1);
        $cr->compare('web_domain', 'www.'.$domain);
        $dataProvider->setCriteria($cr);
        //web site
        $siteModel = WebSite::model()->findByAttributes(array('web_domain' => $domain));
        
        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'siteModel' => $siteModel
        ));

    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        Yii::app()->theme = 'topmall';
        $model = new WebCoupon;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['WebCoupon'])) {
            $model->attributes = $_POST['WebCoupon'];
            $model->expiration_date = date('Y-m-d', strtotime($_POST['WebCoupon']['expiration_date']));
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        Yii::app()->theme = 'topmall';
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['WebCoupon'])) {
            $model->attributes = $_POST['WebCoupon'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        Yii::app()->theme = 'topmall';
        
        //打折码列表
        $dataProvider = new CActiveDataProvider('WebCoupon');
        $cr = new CDbCriteria;
        $cr->compare('status', 1);
        $cr->group = 'web_domain';
        $dataProvider->setCriteria($cr);
        
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        Yii::app()->theme = 'topmall';
        
        $model = new WebCoupon('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['WebCoupon']))
            $model->attributes = $_GET['WebCoupon'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = WebCoupon::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'web-coupon-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
