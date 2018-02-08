<?php

/**
 * 模型对应数据库表 "m_role".
 *
 * 以下是可用表m_role的栏位:
 * @property integer $id
 * @property string $menu_pid
 * @property integer $s_name
 */
class MRole extends CActiveRecord {

    /**
     * 返回指定的基于“ar”的静态模型类.
     * @return MRole the static model class
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
        return 'm_role';
    }

    /**
     * 返回验证规则
     * @author nirsh
     * @version 5.0
     * @example
     */
    public function rules() {
        return array(
            array('menu_pid, s_name', 'required'),
            array('s_name', 'numerical', 'integerOnly' => true),
            array('menu_pid', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, menu_pid, s_name', 'safe', 'on' => 'search'),
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
            'menu_pid' => '菜单选项',
            's_name' => '角色列表',
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
        $criteria->compare('menu_pid', $this->menu_pid, true);
        $criteria->compare('s_name', $this->s_name);

        return new CActiveDataProvider(get_class($this), array(
                    'criteria' => $criteria,
                ));
    }

}