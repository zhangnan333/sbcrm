<?php

/**
 * This is the model class for table "business".
 *
 * The followings are the available columns in table 'business':
 * @property string $id
 * @property integer $c_status
 * @property string $business_name
 * @property string $address
 * @property string $tel
 * @property string $buy_date
 * @property string $linkman
 * @property string $min_sprice
 * @property string $unit_price
 * @property string $kf_id
 * @property string $responsible
 */
class Business extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Business the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'business';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('business_name', 'unique'),
            array('business_name, tel', 'required'),
            array('c_status', 'numerical', 'integerOnly' => true),
            array('business_name, address', 'length', 'max' => 255),
            array('tel', 'length', 'max' => 20),
            array('linkman', 'length', 'max' => 50),
            array('min_sprice, unit_price', 'length', 'max' => 10),
            array('kf_id, responsible', 'length', 'max' => 11),
            array('buy_date, comment_info, over_date, personnel, finance, fax, mobile, email, express, bill, change_personnel_day, pay_day, pay_type, service_info', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, c_status, business_name, address, tel, buy_date, linkman, min_sprice, unit_price, kf_id, responsible, fax, mobile, email, express, bill, change_personnel_day, pay_day, pay_type, service_info', 'safe', 'on' => 'search'),
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
            'business_name' => '企业名称',
            'address' => '收件地址',
            'tel' => '电话',
            'buy_date' => '签约时间',
            'over_date' => '合同到期时间',
            'linkman' => '联络专员',
            'personnel' => '人员变动',
            'finance' => '财务核对',
            'min_sprice' => '最低服务费',
            'unit_price' => '每人服务费',
            'kf_id' => '客服',
            'responsible' => '负责人',
            'comment_info' => '备注',
            'fax' => '传真',
            'mobile' => '手机',
            'email' => '电子邮箱',
            'express' => '快递公司',
            'bill' => '发票/台账',
            'change_personnel_day' => '增减员申报时间',
            'pay_day' => '付款时间',
            'pay_type' => '付款方式',
            'service_info' => '服务项目',
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
        $criteria->compare('business_name', $this->business_name, true);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('tel', $this->tel, true);
        $criteria->compare('buy_date', $this->buy_date, true);
        $criteria->compare('kf_id', $this->kf_id);
        $criteria->compare('responsible', $this->responsible);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }
    
    /**
     * 生成操作按钮
     * @return type
     */
    public function createActionButton(){
        $button =  CHtml::link("报表", Yii::app()->createUrl("ssfReport/create", array("b_id" => $this->id)), array("class" => "gradient-btn"));
        $button .= $this->id > 1 ? CHtml::link("充值", Yii::app()->createUrl("customerRecharge/create", array("u_id" => $this->id, "u_type" => "2")), array("class" => "gradient-btn")) : "";
        return $button;
    }
    
    public function getNameById($id){
        $id = (int)$id;
        $model = $this->findByPk($id);
        if($model){
            return $model->business_name;
        }else{
            return null;
        }
    }

}