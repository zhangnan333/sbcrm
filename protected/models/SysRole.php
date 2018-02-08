<?php

/**
 * 系统权限角色模型
 * This is the model class for table "sys_role".
 *
 * The followings are the available columns in table 'sys_role':
 * @property string $id
 * @property string $role_name
 * @property string $role_info
 */
class SysRole extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return SysRole the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'sys_role';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('role_name', 'required'),
            array('role_name', 'length', 'max' => 255),
            array('role_info', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, role_name, role_info', 'safe', 'on' => 'search'),
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
            'role_name' => '角色名称',
            'role_info' => '角色描述',
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
        $criteria->compare('role_name', $this->role_name, true);
        $criteria->compare('role_info', $this->role_info, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }
    
        /**
     * 获取所有角色
     * @return array
     */
    public function getRoles() {
        $data = array();
        foreach ($this->findAll() as $v) {
            $data[$v['id']] = $v['role_name'];
        }
        return $data;
    }

    /**
     * 根据ID获取角色名
     * @param int $id
     * @return string 
     */
    public function getNameByPk($id) {
        $id = (int) $id;
        $data = $this->model()->findByPk($id);
        return $data['role_name'];
    }

}