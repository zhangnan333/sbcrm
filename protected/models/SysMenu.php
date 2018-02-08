<?php

/**
 * 模型对应数据库表 "sys_menu".
 *
 * 以下是可用表sys_menu的栏位:
 * @property integer $id
 * @property string $m_name
 * @property integer $m_parent
 * @property string $m_path
 * @property integer $m_role
 * @property integer $m_order
 */
class SysMenu extends CActiveRecord {

    /**
     * 返回指定的基于“ar”的静态模型类.
     * @return SysMenu the static model class
     * @author nirsh
     * @example
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * 返回数据库表的名.
     * @author nirsh
     * @version 5.0
     * @example
     */
    public function tableName() {
        return 'sys_menu';
    }
    

    /**
     * 返回验证规则
     * @author nirsh
     * @version 5.0
     * @example
     */
    public function rules() {
        return array(
            array('m_name, m_parent, m_order', 'required'),
            array('m_parent, m_order', 'numerical', 'integerOnly' => true),
            array('m_name', 'length', 'max' => 50),
            array('m_path', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, m_name, m_parent, m_path, m_role, m_order', 'safe', 'on' => 'search'),
        );
    }

    /**
     * 返回关联规则数组。
     * @author nirsh
     * @version 5.0
     * @example
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    
    /*
     * 获取上级目录
     */
    public function getparent(){
       $criteria=new CDbCriteria;
       $criteria->compare('m_parent',0);
       return CHtml::listData(self::findAll($criteria), 'id', 'm_name');
    }
    
    /**
     * 获取字符菜单名称
     * @param string menu id
     * @return string
     * @author  nirsh 
     */
    public function getMenuNameByString($mString) {
        $sqlStr = addslashes($mString);
        if ($sqlStr) {
            $rString = "";
            $query = " id IN (" . $sqlStr . ") ";
            $mData = $this->findAll($query);
            foreach ($mData as $sData) {
                $rString.=$sData['m_name'] . ",";
            }
            return $rString;
        } else {
            return "没有菜单！";
        }
    }
    
    /**
     * 通过ID获取名称
     * @author nirsh
     * @version 5.0
     * @example
     */
    public function getNameById($id, $nameField) {
        $res = $this->findByPk($id);
        return $res[$nameField] ? $res[$nameField] : '';
    }

    /**
     * 返回属性标签(名称= >标签)数组
     * @author nirsh
     * @version 5.0
     * @example
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'm_name' => '菜单名称',
            'm_parent' => '上级',
            'm_path' => '目录',
            'm_order' => '排序',
        );
    }

    /**
     * 设置查询相关条件
     * @author nirsh
     * @version 5.0
     * @example
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('m_name', $this->m_name, true);
        $criteria->compare('m_parent', $this->m_parent);
        $criteria->compare('m_path', $this->m_path, true);
        $criteria->compare('m_order', $this->m_order);

        return new CActiveDataProvider(get_class($this), array(
                    'criteria' => $criteria,
                ));
    }

}