<?php

/**
 * This is the model class for table "ssf".
 * 
 * 社保基金项，当基数为0时企业和个人比例为固定值
 *
 * The followings are the available columns in table 'ssf':
 * @property string $id
 * @property string $ssf_name
 * @property string $base_number
 * @property string $business
 * @property string $personal
 * @property integer $is_change
 * @property string $ssf_date
 */
class Ssf extends CActiveRecord {

    public $changes = array(
        0 => '固定',
        1 => '浮动',
    );

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Ssf the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'ssf';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('ssf_name, base_number, business, personal, ssf_type', 'required'),
            array('is_change, ssf_order', 'numerical', 'integerOnly' => true),
            array('ssf_name', 'length', 'max' => 255),
            array('base_number', 'length', 'max' => 10),
            array('business, personal', 'length', 'max' => 6),
            array('ssf_date', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, ssf_name, base_number, business, personal, is_change, ssf_date', 'safe', 'on' => 'search'),
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
            'ssf_name' => '名称',
            'base_number' => '基数',
            'business' => '企业比列',
            'personal' => '个人比列',
            'is_change' => '是否浮动',
            'ssf_date' => '添加时间',
            'ssf_type' => '社保类型',
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
        $criteria->compare('ssf_name', $this->ssf_name, true);
        $criteria->compare('base_number', $this->base_number, true);
        $criteria->compare('business', $this->business, true);
        $criteria->compare('personal', $this->personal, true);
        $criteria->compare('is_change', $this->is_change);
        $criteria->compare('ssf_type', $this->ssf_type);
        $criteria->order = 'ssf_order DESC';

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    /**
     * get ssf info by id
     * @param type $id
     * @return null
     */
    public function getSsfInfoById($id) {
        $data = $this->findByPk($id);
        if ($data) {
            return "<table class='cssf_info'>
                    <tr>
                    <th rowspan='2'>{$data->ssf_name}</th>
                        <th>基数</th>
                        <th>企业比例</th>
                        <th>个人比例</th>
                    </tr>
                    <tr>
                    <td>{$data->base_number}</td>
                    <td>{$data->business}%</td>
                    <td>{$data->personal}%</td></tr>
                </table>";
            //return CHtml::link($data->ssf_name, '#', array('class' => 'tip', 'title' => "基数：" . $data->base_number));
        } else {
            return null;
        }
    }
    
    /**
     * 生成输入框
     * @author flwof
     * @param type $name
     * @param type $id
     * @param type $val 
     */
    public static function createInput($name, $id, $val) {
        echo CHtml::textField("{$name}_{$id}", $val, array('rel-id' => $id, 'rel-field' => $name, 'onchange' => "updateField(this)"));
    }

}