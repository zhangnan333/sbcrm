<?php

/**
 * This is the model class for table "customer_ssf_snap".
 *
 * The followings are the available columns in table 'customer_ssf_snap':
 * @property string $id
 * @property string $ssf_id
 * @property string $ssf_name
 * @property string $base_number
 * @property string $business
 * @property string $personal
 * @property integer $is_change
 * @property string $ssf_date
 */
class CustomerSsfSnap extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return CustomerSsfSnap the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'customer_ssf_snap';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('is_change, ssf_order', 'numerical', 'integerOnly' => true),
            array('ssf_id', 'length', 'max' => 11),
            array('ssf_name', 'length', 'max' => 255),
            array('base_number', 'length', 'max' => 10),
            array('business, personal', 'length', 'max' => 3),
            array('ssf_date', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, ssf_id, ssf_name, base_number, business, personal, is_change, ssf_date', 'safe', 'on' => 'search'),
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
            'ssf_id' => '社保ID',
            'ssf_name' => '社保名称',
            'base_number' => '基数',
            'business' => '企业比例',
            'personal' => '个人比例',
            'is_change' => '是否浮动',
            'ssf_date' => '月份',
            'ssf_order' => '排序'
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
        $criteria->compare('ssf_id', $this->ssf_id);
        $criteria->compare('ssf_name', $this->ssf_name, true);
        $criteria->compare('base_number', $this->base_number, true);
        $criteria->compare('business', $this->business, true);
        $criteria->compare('personal', $this->personal, true);
        $criteria->compare('is_change', $this->is_change);
        $criteria->compare('ssf_date', $this->ssf_date, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * 更新快照
     * @param type $ssf_date
     * @return boolean
     */
    public function updateSnap($ssf_date = null) {
        $ssf_date = empty($ssf_date) ? date('Y-m') : $ssf_date;
        $sql = "DELETE FROM " . $this->tableName() . " WHERE ssf_date='{$ssf_date}'";
        $query = Yii::app()->db->createCommand($sql)->execute();
        if ($query !== FALSE) {
            $sql = "INSERT INTO customer_ssf_snap (ssf_id, ssf_name, base_number, business, personal, is_change, ssf_order, ssf_date) SELECT id, ssf_name, base_number, business, personal, is_change, ssf_order, '{$ssf_date}' FROM ssf";
            return Yii::app()->db->createCommand($sql)->execute();
        } else {
            return false;
        }
    }
    
    public function updateSnapOrder($ssf_id, $order){
        $ssf_id = (int)$ssf_id;
        $order = (int)$order;
        if($ssf_id){
            $sql = "UPDATE customer_ssf_snap SET ssf_order=$order WHERE ssf_id=$ssf_id";
            return Yii::app()->db->createCommand($sql)->execute();
        }else{
            return 0;
        }
    }

}