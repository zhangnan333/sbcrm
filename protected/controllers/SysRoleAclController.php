<?php

class SysRoleAclController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = 'main';

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
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new SysRoleAcl;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['SysRoleAcl'])) {
            
            foreach($_POST['actions'] as $action)
            {
                $model->unsetAttributes();
                $model->setIsNewRecord(true);
                $model->attributes = $_POST['SysRoleAcl'];
                $model->action = $action;
                $model->save();
            }
                $this->redirect(array('admin'));
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
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['SysRoleAcl'])) {
            $model->attributes = $_POST['SysRoleAcl'];
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
    public function actionDelete() {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $model = new SysRoleAcl();
            $ids = isset($_POST['id'])?$_POST['id']:$_GET['id'];
            if(is_array($ids))
                $model->deleteAllByAttributes(array('id' => $ids));
            else
                $model->deleteByPk($ids);

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
        $dataProvider = new CActiveDataProvider('SysRoleAcl');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new SysRoleAcl('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['SysRoleAcl']))
            $model->attributes = $_GET['SysRoleAcl'];

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
        $model = SysRoleAcl::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'sys-role-acl-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    
    public function actionAjax()
    {
        if(Yii::app()->request->isAjaxRequest)
        {
            switch ($_POST['action'])
            {
                case 'getActions':
                    $controller = trim($_POST['controller']);
                    $s = SysRoleSource::model()->findByAttributes(array('source_value'=>$controller));
                    $actions = SysRoleSource::model()->findAll("pid=$s->id");
                    echo CJSON::encode($actions);
                    break;
            }
        }
    }

}
