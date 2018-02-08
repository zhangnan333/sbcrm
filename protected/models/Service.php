<?php

/**
 * This is the model class for table "service".
 *
 * The followings are the available columns in table 'service':
 * @property string $id
 * @property string $name
 * @property string $price
 * @property string $content
 * @property string $product_style
 * @property string $photo_num
 * @property string $truing_num
 * @property string $tag
 * @property string $order_sort
 * @property integer $status
 */
class Service extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Service the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'service';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, content, price, truing_num', 'required'),
            array('status', 'numerical', 'integerOnly' => true),
            array('name, product_style, photo_num', 'length', 'max' => 255),
            array('price, order_sort', 'numerical'),
            array('truing_num, tag', 'length', 'max' => 4),
            array('content', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, price, content, product_style, photo_num, truing_num, tag, order_sort, status', 'safe', 'on' => 'search'),
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
            'name' => '套餐名称',
            'price' => '价格',
            'content' => '套餐内容',
            'product_style' => '照片形式',
            'photo_num' => '照片数量',
            'truing_num' => '精修数量',
            'tag' => '标签',
            'order_sort' => '排序',
            'status' => '状态',
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

        $criteria->compare('id', $this->id, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('price', $this->price, true);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('product_style', $this->product_style, true);
        $criteria->compare('photo_num', $this->photo_num, true);
        $criteria->compare('truing_num', $this->truing_num, true);
        $criteria->compare('tag', $this->tag, true);
        $criteria->compare('order_sort', $this->order_sort, true);
        $criteria->compare('status', $this->status);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

}