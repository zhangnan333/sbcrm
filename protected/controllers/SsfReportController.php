<?php

class SsfReportController extends Controller {

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
        $this->render('view', array(
            'model' => $this->loadModel($id),
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
        $model = new SsfReport;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['SsfReport'])) {
            $model->attributes = $_POST['SsfReport'];
            if ($model->save()) {
                $url = $this->rewriteCreateUrl('view', array('id' => $model->id));
                $this->redirect($url);
            }
        }
        
        $b_id = (int)  Yii::app()->request->getQuery('b_id', 0);
        $ssf_date = isset($_GET['ssf_date']) ? $_GET['ssf_date'] : date('Y-m');
        $business = Business::model()->findByPk($b_id);

        $this->render('create', array(
            'model' => $model,
            'b_id' => $b_id,
            'ssf_date' => $ssf_date,
            'business' => $business,
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

        if (isset($_POST['SsfReport'])) {
            $model->attributes = $_POST['SsfReport'];
            if ($model->save()) {
                $url = $this->rewriteCreateUrl('view', array('id' => $model->id));
                $this->redirect($url);
            }
        }

        $this->render('update', array(
            'model' => $model,
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
                $tModel = $this->loadModel($id);
                $tModel->delete();
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
        $model = new SsfReport('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_REQUEST['SsfReport']))
            $model->attributes = $_REQUEST['SsfReport'];

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
        $model = new SsfReport('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_REQUEST['SsfReport']))
            $model->attributes = $_REQUEST['SsfReport'];

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
        $model = SsfReport::model()->findByPk((int) $id);
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
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'ssf-report-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    
    /**
     * API
     */
    public function actionApi(){
        switch ($_POST['action']){
            case 'koukuan'://捐款
                $u_id = (int)$_POST['u_id'];
                $ssf_money = (float)$_POST['ssf_money'];
                $ssf_date = $_POST['ssf_date'];
                //计算余额
                switch($_POST['u_type']){
                    case 1://个人
                        $all_money = CustomerRecharge::model()->getBalance($u_id, 1);
                        break;
                    case 2://企业
                        $customer = Customer::model()->findByPk($u_id);
                        $all_money = CustomerRecharge::model()->getBalance($customer->b_id, 2);
                        break;
                    default:
                        echo '客户类型错误';
                        exit;
                        break;
                }
                //扣款记录
                if($all_money >= $ssf_money){
                    $model = new SsfReport;
                    $model->attributes = array(
                        'u_id' => $u_id,
                        'ssf_money' => $ssf_money,
                        'paid_money' => $ssf_money,
                        'ssf_date' => $ssf_date
                    );
                    if($model->save()){
                        echo 1;
                    }else{
                        echo '扣款失败，请重试';
                    }
                }else{
                    echo '余额不足！';
                }
                break;
        }
        
    }

}
