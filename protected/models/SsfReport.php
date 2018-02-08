<?php

/**
 * This is the model class for table "ssf_report".
 *
 * The followings are the available columns in table 'ssf_report':
 * @property string $id
 * @property string $u_id
 * @property string $ssf_money
 * @property string $paid_money
 * @property string $pai_date
 * @property string $ssf_date
 */
class SsfReport extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return SsfReport the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'ssf_report';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('u_id, ssf_money, paid_money, ssf_date', 'required'),
            array('u_id', 'length', 'max' => 11),
            array('ssf_money, paid_money', 'length', 'max' => 10),
            array('ssf_date', 'length', 'max' => 7),
            array('pai_date, admin_id', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, u_id, ssf_money, paid_money, pai_date, ssf_date', 'safe', 'on' => 'search'),
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
            'u_id' => '客户',
            'ssf_money' => '社保金额',
            'paid_money' => '实付金额',
            'pai_date' => '操作时间',
            'ssf_date' => '社保月份',
            'admin_id' => '操作人'
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
        $criteria->compare('ssf_money', $this->ssf_money, true);
        $criteria->compare('paid_money', $this->paid_money, true);
        $criteria->compare('pai_date', $this->pai_date, true);
        $criteria->compare('ssf_date', $this->ssf_date);
        $criteria->compare('admin_id', $this->ssf_date);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public function beforeSave() {
        parent::beforeSave();
        $this->admin_id = Yii::app()->user->id;
        return true;
    }

}