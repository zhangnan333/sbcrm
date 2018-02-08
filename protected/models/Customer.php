<?php

/**
 * This is the model class for table "customer".
 *
 * The followings are the available columns in table 'customer':
 * @property string $id
 * @property integer $c_status
 * @property string $name
 * @property string $id_card
 * @property string $sex
 * @property string $hk_addr
 * @property string $mobile
 * @property string $phone
 * @property string $buy_date
 * @property string $over_date
 * @property string $kf_id
 * @property string $responsible
 * @property string $comment_info
 * @property string $b_id
 */
class Customer extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Customer the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'customer';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, ssf_type', 'required'),
            array('name+mobile', 'ext.uniqueMultiColumnValidator.uniqueMultiColumnValidator'),
            array('c_status', 'numerical', 'integerOnly' => true),
            array('wages, service_charge', 'numerical'),
            array('name, phone', 'length', 'max' => 50),
            array('id_card', 'length', 'max' => 18),
            array('sex', 'length', 'max' => 3),
            array('hk_addr', 'length', 'max' => 255),
            array('mobile', 'length', 'max' => 15),
            array('kf_id, responsible, b_id', 'length', 'max' => 11),
            array('buy_date, over_date, comment_info, sc_type', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, c_status, name, id_card, sex, hk_addr, mobile, phone, buy_date, over_date, kf_id, responsible, comment_info, b_id', 'safe', 'on' => 'search'),
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
            'c_status' => '客户状态',
            'name' => '姓名',
            'id_card' => '身份证号',
            'sex' => '性别',
            'hk_addr' => '户口所在地',
            'mobile' => '手机',
            'phone' => '电话',
            'buy_date' => '服务开始时间',
            'over_date' => '服务终止时间',
            'kf_id' => '客服',
            'responsible' => '负责人',
            'comment_info' => '备注',
            'b_id' => '所属企业客户',
            'wages' => '工资',
            'ssf_type' => '社保类型',
            'service_charge' => '服务费',
            'sc_type' => '缴费方式',
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
        $criteria->compare('c_status', $this->c_status);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('id_card', $this->id_card, true);
        $criteria->compare('mobile', $this->mobile, true);
        $criteria->compare('phone', $this->phone, true);
        $criteria->compare('buy_date', $this->buy_date, true);
        $criteria->compare('over_date', $this->over_date, true);
        $criteria->compare('kf_id', $this->kf_id);
        $criteria->compare('responsible', $this->responsible);
        if ($this->b_id > 0) {
            $criteria->compare('b_id', $this->b_id);
        } else {
            $criteria->addCondition('b_id=0');
        }


        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }
    
    /**
     * get name by id
     * @param type $id
     * @return null
     */
    public function getNameById($id){
        $data = $this->findByPk($id);
        if($data){
            return $data->name;
        }else{
            return null;
        }
    }
    
    /**
     * 生成操作按钮
     * @return type
     */
    public function createActionButton(){
        $button = $this->b_id == 1 ? CHtml::link("充值", Yii::app()->createUrl("customerRecharge/create", array("u_id" => $this->id, "u_type" => "1")), array("class" => "gradient-btn")) : "";
        return $button;
    }

}