<?php

/**
 * This is the model class for table "sys_admin".
 *
 * The followings are the available columns in table 'sys_admin':
 * @property string $id
 * @property string $user_name
 * @property string $user_pass
 * @property string $name
 * @property string $last_login
 * @property string $last_ip
 */
class SysAdmin extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return SysAdmin the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'sys_admin';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_name, rid', 'required'),
            array('user_name, name', 'length', 'max' => 255),
            array('user_pass', 'length', 'max' => 32),
            array('last_ip', 'length', 'max' => 11),
            array('last_login', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, user_name, user_pass, name, last_login, last_ip', 'safe', 'on' => 'search'),
        );
    }

    /**
     * 获取名称
     */
    public function getUserName($id) {
        $dModel = $this->findByPk($id);
        return $dModel->user_name;
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'user_name' => '用户名',
            'user_pass' => '密码',
            'name' => '姓名',
            'last_login' => '最后登录时间',
            'last_ip' => '最后登录IP',
            'rid' => '角色'
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
        $criteria->compare('user_name', $this->user_name, true);
        $criteria->compare('user_pass', $this->user_pass, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('last_login', $this->last_login, true);
        $criteria->compare('last_ip', $this->last_ip, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    /**
     * 生成密码
     * @param type $pass
     * @return type 
     */
    public function generationPassword($pass) {
        return md5($pass);
    }

    /**
     * get name by id
     * @param type $id
     * @return null
     */
    public function getNameById($id){
        $admin = $this->findByPk($id);
        if($admin)
            return $admin->name;
        else
            return null;
    }
}