<?php

/**
 * 系统权限角色资源分配模型
 * This is the model class for table "sys_role_acl".
 *
 * The followings are the available columns in table 'sys_role_acl':
 * @property string $id
 * @property string $rid
 * @property string $controller
 * @property string $action
 * @property string $access
 */
class SysRoleAcl extends CActiveRecord {

    public $accessArray = array(
        'allow' => '允许',
        'deny' => '禁止',
    );

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return SysRoleAcl the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'sys_role_acl';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('rid, controller, action', 'required'),
            array('rid', 'numerical'),
            array('controller, action', 'length', 'max' => 255),
            array('access', 'length', 'max' => 5),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, rid, controller, action, access', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'rid' => '角色ID',
            'controller' => '控制器',
            'action' => '方法',
            'access' => '权限',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('rid', $this->rid);
        $criteria->compare('controller', $this->controller);
        $criteria->compare('action', $this->action);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * 判断权限
     * @param string $controller
     * @param string $action
     * @return string 
     */
    public function checkAccess($controller, $action) {
        $controller = strtolower($controller);
        $action = strtolower($action);
        $rid = Yii::app()->request->cookies['rid'];
        if (empty($rid->value)) {
            return 'deny';
            exit;
        }
        $criteria = new CDbCriteria();
        $criteria->compare('rid', $rid->value);
        $access = 'deny';
        foreach ($this->findAll($criteria) as $acl) {

            $acl->action = strtolower($acl->action);
            $acl_controller = '*';
            if ($acl->controller != '*') {
                $roleS = RoleSource::model()->findByPk($acl->controller);
                $acl_controller = strtolower($roleS->source_value);
            } else {
                $acl_controller = '*';
            }

            if ($acl_controller == '*' && $acl->action == '*') {
                $access = $acl->access;
            } else if ($acl_controller == $controller && $acl->action == '*') {
                $access = $acl->access;
            } else if ($acl_controller == $controller && $acl->action == $action) {
                $access = $acl->access;
            }
        }
        return $access;
    }

}