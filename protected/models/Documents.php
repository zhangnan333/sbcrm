<?php

/**
 * This is the model class for table "documents".
 *
 * The followings are the available columns in table 'documents':
 * @property string $id
 * @property string $sort_id
 * @property string $title
 * @property string $info
 * @property string $user_id
 * @property string $post_time
 * @property string $update_time
 */
class Documents extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Documents the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'documents';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title, info, sort_id', 'required'),
            array('sort_id, user_id', 'length', 'max' => 11),
            array('title', 'length', 'max' => 255),
            array('info, update_time', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, sort_id, title, info, user_id, post_time, update_time', 'safe', 'on' => 'search'),
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
            'sort_id' => '文档分类',
            'title' => '标题',
            'info' => '内容',
            'user_id' => '发布者',
            'post_time' => '发布时间',
            'update_time' => '修改时间',
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
        $criteria->compare('sort_id', $this->sort_id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('info', $this->info, true);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('post_time', $this->post_time, true);
        $criteria->compare('update_time', $this->update_time, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    
    public function beforeSave() {
        parent::beforeSave();
        $this->user_id = Yii::app()->user->id;
        $this->update_time = date('Y-m-d H:i:s');
        return true;
    }

}