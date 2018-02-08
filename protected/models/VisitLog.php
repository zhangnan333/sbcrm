<?php

/**
 * This is the model class for table "visit_log".
 *
 * The followings are the available columns in table 'visit_log':
 * @property string $id
 * @property integer $u_type
 * @property string $u_id
 * @property string $info
 * @property string $vu_id
 * @property string $visit_date
 */
class VisitLog extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return VisitLog the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'visit_log';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('info, u_type, u_id, vu_id', 'required'),
            array('u_type', 'numerical', 'integerOnly' => true),
            array('u_id, vu_id', 'length', 'max' => 11),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, u_type, u_id, info, vu_id, visit_date', 'safe', 'on' => 'search'),
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
            'u_type' => '客户类型',
            'u_id' => 'UID',
            'info' => '备注',
            'vu_id' => '回访人',
            'visit_date' => '回访时间',
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
        $criteria->compare('u_type', $this->u_type);
        $criteria->compare('u_id', $this->u_id);
        $criteria->compare('info', $this->info, true);
        $criteria->compare('vu_id', $this->vu_id);
        $criteria->compare('visit_date', $this->visit_date, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }
    
    /**
     * get visit logs by utype,uid
     * @param type $u_type
     * @param type $u_id
     * @return type
     */
    public function getLogsByU($u_type, $u_id){
        $cr = new CDbCriteria;
        $cr->compare('u_type', (int)$u_type);
        $cr->compare('u_id', (int)$u_id);
        $cr->order = 'id DESC';
        return VisitLog::model()->findAll($cr);
    }

}