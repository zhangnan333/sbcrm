<?php

/**
 * This is the model class for table "ssf_types".
 *
 * The followings are the available columns in table 'ssf_types':
 * @property string $id
 * @property string $name
 */
class SsfTypes extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return SsfTypes the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'ssf_types';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name', 'safe', 'on' => 'search'),
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
            'name' => '社保类型',
        );
    }

    /**
     * Get type name.
     * @param type $id
     * @return string
     */
    public function getTypeName($id) {
        $id = (int) $id;
        if ($id == 0) {
            return '通用项目';
        } else {
            $model = $this->findByPk($id);
            return $model->name;
        }
    }
    
    /**
     * 获取用户社保类型
     * @param type $id
     * @return null
     */
    public function getUserTypeNameById($id){
        $id = (int) $id;
        if ($id == 0) {
            return null;
        } else {
            $model = $this->findByPk($id);
            return $model->name;
        }
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
        $criteria->compare('name', $this->name, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}