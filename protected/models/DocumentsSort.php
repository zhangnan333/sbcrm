<?php

/**
 * This is the model class for table "documents_sort".
 *
 * The followings are the available columns in table 'documents_sort':
 * @property string $id
 * @property string $sort_name
 * @property string $sort_note
 */
class DocumentsSort extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return DocumentsSort the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'documents_sort';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('sort_name', 'required'),
            array('sort_name', 'length', 'max' => 255),
            array('sort_note', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, sort_name, sort_note', 'safe', 'on' => 'search'),
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
            'sort_name' => '分类名称',
            'sort_note' => '备注',
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
        $criteria->compare('sort_name', $this->sort_name, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Get name by id
     * @param type $id
     * @return string
     */
    public function getNameById($id) {
        $id = (int) $id;
        if ($id == 0) {
            return '公告';
        } else {
            $model = $this->findByPk($id);
            if ($model) {
                return $model->sort_name;
            } else {
                return '';
            }
        }
    }

}