<?php

class BusinessController extends Controller {

    public $layout = 'main';

    /**
     * @var返回过滤数组
     * @author nirsh
     * @version 5.0
     * @demo 
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * @var返回验证条件 如果不需要验证权限 把$isPriv 设置为allow
     * @author nirsh
     * @version 5.0
     * @demo 
     *    switch($action){
     *      case "login":
     *          $isPriv = 'allow'
     *          break;
     *      default:
     *          $isPriv = $this->checkAccess($controller, $action);
     *      }
     */
    public function accessRules() {
        $controller = Yii::app()->getController()->id;
        $action = Yii::app()->getController()->action->id;
        //登录不需要判断权限
        $isPriv = $this->checkAccess($controller, $action);
        return array(
            array($isPriv,
                'actions' => array($action),
                'users' => array('*'),
            )
        );
    }

    /**
     * 访问某条具体的记录.
     * @param $id 某条记录的主键
     * @author nirsh
     * @demo 
     * @modifly 
     * @version 5.0
     */
    public function actionView($id) {
        $visit_logs = VisitLog::model()->getLogsByU(2, $id);
        $this->render('view', array(
            'model' => $this->loadModel($id),
            'visit_logs' => $visit_logs
        ));
    }

    /**
     * 创建动作
     * @author nirsh
     * @demo 
     * @modifly 
     * @version 5.0
     */
    public function actionCreate() {
        $this->layout = 'simple';
        $model = new Business;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Business'])) {
            $model->attributes = $_POST['Business'];
            if ($model->save()) {
                $url = $this->rewriteCreateUrl('view', array('id' => $model->id));
                $this->redirect($url);
            }
        }
        
        //客服人员
        $kfs = SysAdmin::model()->findAllByAttributes(array('rid' => 8));
        //业务人员
        $responsible = SysAdmin::model()->findAllByAttributes(array('rid' => 9));

        $this->render('create', array(
            'model' => $model,
            'kfs' => $kfs, 
            'responsible' => $responsible,
        ));
    }

    /**
     * 更新数据 
     * @param 主键id
     * @author nirsh
     * @demo 
     * @modifly 
     * @version 5.0
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Business'])) {
            $model->attributes = $_POST['Business'];
            if ($model->save()) {
                $url = $this->rewriteCreateUrl('view', array('id' => $model->id));
                $this->redirect($url);
            }
        }
        
        //客服人员
        $kfs = SysAdmin::model()->findAllByAttributes(array('rid' => 8));
        //业务人员
        $responsible = SysAdmin::model()->findAllByAttributes(array('rid' => 9));

        $this->render('update', array(
            'model' => $model,
            'kfs' => $kfs, 
            'responsible' => $responsible,
        ));
    }

    /**
     * 删除记录 
     * @param 主键id
     * @author nirsh
     * @demo 
     * @modifly 
     * @version 5.0
     */
    public function actionDelete() {
        $sId = $_REQUEST['id'];
        if (is_array($sId)) {
            foreach ($sId as $id) {
                if($id > 1){
                    $tModel = $this->loadModel($id);
                    $tModel->delete();
                }
                
            }
        } else {
            $tModel = $this->loadModel($sId);
            $tModel->delete();
        }
        if (isset($_REQUEST['ajax'])) {
            echo "菜单删除成功";
        } else {
            $this->redirect($this->rewriteCreateUrl('admin'));
        }
    }

    /**
     * 列表动作 
     * @param 主键id
     * @author nirsh
     * @demo 
     * @modifly 
     * @version 5.0
     */
    public function actionIndex() {
        $model = new Business('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_REQUEST['Business']))
            $model->attributes = $_REQUEST['Business'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * 数据管理
     * @param 主键id
     * @author nirsh
     * @demo 
     * @modifly 
     * @version 5.0
     */
    public function actionAdmin() {
        $model = new Business('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_REQUEST['Business']))
            $model->attributes = $_REQUEST['Business'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * 返回数据模型是基于主键所得到的变量 
     * @param 主键id
     * @author nirsh
     * @demo 
     * @modifly 
     * @version 5.0
     */
    public function loadModel($id) {
        $model = Business::model()->findByPk((int) $id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * ajax验证
     * @param 主键id
     * @author nirsh
     * @demo 
     * @modifly 
     * @version 5.0
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'business-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
