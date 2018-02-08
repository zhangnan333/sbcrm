<?php

/**
 * This is the model class for table "album".
 *
 * The followings are the available columns in table 'album':
 * @property string $id
 * @property string $album_title
 * @property string $album_describe
 * @property string $creation_time
 * @property string $photographer
 * @property string $cover
 * @property integer $show_home
 * @property string $dir
 * @property string $order_sort
 * @property string $create_time
 */
class Album extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Album the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'album';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('album_title, cover', 'required'),
            array('show_home', 'numerical', 'integerOnly' => true),
            array('album_title, photographer, cover, dir', 'length', 'max' => 255),
            array('order_sort', 'length', 'max' => 5),
            array('album_describe, creation_time, create_time', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, album_title, album_describe, creation_time, photographer, cover, show_home, dir, order_sort, create_time', 'safe', 'on' => 'search'),
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
            'album_title' => '相册标题',
            'album_describe' => '相册描述',
            'creation_time' => '创作时间',
            'photographer' => '摄影师',
            'cover' => '封面图片',
            'show_home' => '主页显示',
            'dir' => '相册目录',
            'order_sort' => '排序',
            'create_time' => '添加时间',
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
        $criteria->compare('album_title', $this->album_title, true);
        $criteria->compare('album_describe', $this->album_describe, true);
        $criteria->compare('creation_time', $this->creation_time, true);
        $criteria->compare('photographer', $this->photographer, true);
        $criteria->compare('show_home', $this->show_home);
        $criteria->compare('create_time', $this->create_time, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

}