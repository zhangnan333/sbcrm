<?php

/**
 * This is the model class for table "customer_recharge".
 *
 * The followings are the available columns in table 'customer_recharge':
 * @property string $id
 * @property string $u_id
 * @property integer $u_type
 * @property string $money
 * @property string $money_entry
 * @property string $send_bank_name
 * @property string $send_bank_card
 * @property string $bank_name
 * @property string $bank_card
 * @property string $data_entry
 * @property string $admin_id
 */
class CustomerRecharge extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return CustomerRecharge the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'customer_recharge';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('u_type, u_id, money', 'required'),
            array('u_type', 'numerical', 'integerOnly' => true),
            array('u_id, admin_id', 'length', 'max' => 11),
            array('money', 'numerical'),
            array('send_bank_name, send_bank_card, bank_name, bank_card', 'length', 'max' => 255),
            array('money_entry, data_entry', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, u_id, u_type, money, money_entry, send_bank_name, send_bank_card, bank_name, bank_card, data_entry, admin_id', 'safe', 'on' => 'search'),
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
            'u_id' => '客户ID',
            'u_type' => '客户类型',
            'money' => '金额',
            'money_entry' => '到帐时间',
            'send_bank_name' => '付款银行',
            'send_bank_card' => '付款卡号',
            'bank_name' => '收款银行',
            'bank_card' => '收款卡号',
            'data_entry' => '录入时间',
            'admin_id' => '操作人',
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
        $criteria->compare('u_id', $this->u_id);
        $criteria->compare('u_type', $this->u_type);
        $criteria->compare('money', $this->money, true);
        $criteria->compare('money_entry', $this->money_entry, true);
        $criteria->compare('send_bank_name', $this->send_bank_name, true);
        $criteria->compare('send_bank_card', $this->send_bank_card, true);
        $criteria->compare('bank_name', $this->bank_name, true);
        $criteria->compare('bank_card', $this->bank_card, true);
        $criteria->compare('data_entry', $this->data_entry, true);
        $criteria->compare('admin_id', $this->admin_id, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public function beforeSave() {
        parent::beforeSave();
        $this->admin_id = Yii::app()->user->id;
        return true;
    }

    /**
     * get user balance
     * @param type $u_id
     * @param type $u_type
     * @return type
     */
    public function getBalance($u_id, $u_type) {
        $u_id = (int) $u_id;
        $u_type = (int) $u_type;
        $sql = "SELECT SUM(money) AS all_money FROM " . $this->tableName() . " WHERE u_id=$u_id AND u_type=$u_type";
        $come_money = Yii::app()->db->createCommand($sql)->queryRow();
        switch ($u_type) {
            case 1://个人
                $sql = "SELECT SUM(paid_money) AS all_money FROM ssf_report WHERE u_id=$u_id";
                break;
            case 2://企业
                $sql = "SELECT SUM(paid_money) AS all_money FROM ssf_report WHERE u_id IN (SELECT id FROM customer WHERE b_id=$u_id) ";
                break;
        }
        $deduct_money = Yii::app()->db->createCommand($sql)->queryRow();
        if ($deduct_money) {
            return $come_money['all_money'] - $deduct_money['all_money'];
        } else {
            return $come_money['all_money'];
        }
    }

}