<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController {

    /**
     * @var string the default layout for the controller view. Defaults to 'column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = 'column1';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();
    
    /**
     * 游戏
     * @var type 
     */
    public $games = array();
    /**
     * 游戏服务区
     * @var type 
     */
    public $game_servers = array();
    
    /**
     * 网站
     * @var type 
     */
    public $game_stores = array();

    /**
     * 判断角色权限
     * @param string $controller 控制器
     * @param string $action 方法
     * @return string allow, deny
     */
    public function checkAccess($controller, $action) {
        $rid = Yii::app()->request->cookies['rid'];
        if (empty($rid->value) || Yii::app()->user->isGuest) {
            return 'deny';
        } else {
            $model = new SysRoleAcl;
            return $model->checkAccess($controller, $action);
        }
    }

    /**
      +-----------------------------------------------------
     * 说明 
     * @param 
     * @return 
     * @author vseach@163.com
      +-----------------------------------------------------
     * @example
     */
    public function rewriteCreateUrl($rute, $params = array()) {
        $params = $params;
        return $this->createUrl($rute, $params);
    }

    /**
     * 获取菜单操作按钮
     * @param id 菜单ID
     * @return string
     * @example 
     * @author nirsh
     */
    public function getColumnOptions($id, $action = '') {
        $vUrl = $this->rewriteCreateUrl($action . '/view', array('id' => $id));
        $uUrl = $this->rewriteCreateUrl($action . '/update', array('id' => $id));
        $dUrl = $this->rewriteCreateUrl($action . '/delete', array('id' => $id));
        $view = '<a title="查看" href="' . $vUrl . '" class="gradient-btn">查看</a>';
        $editor = '<a title="编辑" href="' . $uUrl . '" class="gradient-btn">编辑</a>';
        $cancel = '<a rel="' . $action . '" title="删除" href="javascript:void(0)" durl ="' . $dUrl . '" onclick="deleteByUrl(this)" class="gradient-btn">删除</a>';
        return $view . $editor . $cancel;
    }

    
}
