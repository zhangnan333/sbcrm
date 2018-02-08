<?php

/**
 * This is the model class for table "customer_ssf".
 *
 * The followings are the available columns in table 'customer_ssf':
 * @property string $id
 * @property string $u_id
 * @property string $ssf_id
 * @property string $add_date
 * @property string $add_user
 */
class CustomerSsf extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return CustomerSsf the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'customer_ssf';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('u_id, ssf_id', 'required'),
            array('u_id, ssf_id, add_user', 'length', 'max' => 11),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, u_id, ssf_id, add_date, add_user', 'safe', 'on' => 'search'),
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
            'u_id' => '姓名',
            'ssf_id' => '社保基金',
            'add_date' => '添加时间',
            'add_user' => '添加人',
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
        $criteria->compare('ssf_id', $this->ssf_id);
        $criteria->compare('add_date', $this->add_date, true);
        $criteria->compare('add_user', $this->add_user);
        $criteria->order = 'ssf_id ASC';

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }
    
    /**
     * get ssf buy uid
     * 排序按从大到小
     * @param type $uid
     * @return type
     */
    public function getSsfByUid($uid, $ssf_date){
        $sql= "select a.u_id,b.* from customer_ssf as a left join customer_ssf_snap as b on a.ssf_id=b.ssf_id where u_id=" . $uid . " AND b.ssf_date='{$ssf_date}' ORDER BY b.ssf_order DESC";
        $ssfs = Yii::app()->db->createCommand($sql)->queryAll();
        if($ssfs){
            return $ssfs;
        }else{
            CustomerSsfSnap::model()->updateSnap($ssf_date);
            $this->getSsfByUid($uid, $ssf_date);
        }
    }
    
    public function beforeSave() {
        parent::beforeSave();
        $this->add_user = Yii::app()->user->id;
        return true;
    }

}