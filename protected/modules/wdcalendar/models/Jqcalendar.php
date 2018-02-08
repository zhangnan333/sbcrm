<?php

/**
 * This is the model class for table "jqcalendar".
 *
 * The followings are the available columns in table 'jqcalendar':
 * @property integer $Id
 * @property string $Subject
 * @property string $Location
 * @property string $Description
 * @property string $StartTime
 * @property string $EndTime
 * @property integer $IsAllDayEvent
 * @property string $Color
 * @property string $RecurringRule
 */
class Jqcalendar extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Jqcalendar the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'jqcalendar';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('IsAllDayEvent, UserId', 'required'),
            array('IsAllDayEvent', 'numerical', 'integerOnly' => true),
            array('Subject', 'length', 'max' => 1000),
            array('Location, Color', 'length', 'max' => 200),
            array('Description', 'length', 'max' => 255),
            array('RecurringRule', 'length', 'max' => 500),
            array('StartTime, EndTime', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('Id, Subject, Location, Description, StartTime, EndTime, IsAllDayEvent, Color, RecurringRule', 'safe', 'on' => 'search'),
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
            'Id' => 'ID',
            'Subject' => '标题',
            'Location' => '地点',
            'Description' => '描述',
            'StartTime' => '开始时间',
            'EndTime' => '结束时间',
            'IsAllDayEvent' => '全天',
            'Color' => '标题颜色',
            'RecurringRule' => '循环规则',
            'UserId' => '用户'
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

        $criteria->compare('Id', $this->Id);
        $criteria->compare('UserId', $this->UserId);
        $criteria->compare('Subject', $this->Subject, true);
        $criteria->compare('Location', $this->Location, true);
        $criteria->compare('Description', $this->Description, true);
        $criteria->compare('StartTime', $this->StartTime, true);
        $criteria->compare('EndTime', $this->EndTime, true);
        $criteria->compare('IsAllDayEvent', $this->IsAllDayEvent);
        $criteria->compare('Color', $this->Color, true);
        $criteria->compare('RecurringRule', $this->RecurringRule, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * 快捷添加日程
     * @param type $st
     * @param type $et
     * @param type $sub
     * @param type $ade
     * @return type
     */
    function addCalendar($st, $et, $sub, $ade) {
        $ret = array();
        try {
            $this->setIsNewRecord(TRUE);
            $this->unsetAttributes();
            $this->attributes = array(
                'Subject' => $sub,
                'StartTime' => $st,
                'EndTime' => $et,
                'IsAllDayEvent' => $ade,
                'UserId' => Yii::app()->user->id,
            );

            if ($this->save()) {
                $ret['IsSuccess'] = true;
                $ret['Msg'] = 'Add success';
                $ret['Data'] = $this->Id;
            } else {
                $ret['IsSuccess'] = false;
                $ret['Msg'] = join(',', $this->errors);
            }
        } catch (Exception $e) {
            $ret['IsSuccess'] = false;
            $ret['Msg'] = $e->getMessage();
        }
        return $ret;
    }

    /**
     * 日程列表
     * @param type $day
     * @param type $type
     * @return type
     */
    public function listCalendar($day, $type) {
        $phpTime = strtotime($day);
        //echo $phpTime . "+" . $type;
        switch ($type) {
            case "month":
                $st = mktime(0, 0, 0, date("m", $phpTime), 1, date("Y", $phpTime));
                $et = mktime(0, 0, -1, date("m", $phpTime) + 1, 1, date("Y", $phpTime));
                break;
            case "week":
                //suppose first day of a week is monday 
                $monday = date("d", $phpTime) - date('N', $phpTime) + 1;
                //echo date('N', $phpTime);
                $st = mktime(0, 0, 0, date("m", $phpTime), $monday, date("Y", $phpTime));
                $et = mktime(0, 0, -1, date("m", $phpTime), $monday + 7, date("Y", $phpTime));
                break;
            case "day":
                $st = mktime(0, 0, 0, date("m", $phpTime), date("d", $phpTime), date("Y", $phpTime));
                $et = mktime(0, 0, -1, date("m", $phpTime), date("d", $phpTime) + 1, date("Y", $phpTime));
                break;
        }
        //echo $st . "--" . $et;
        return $this->listCalendarByRange($st, $et);
    }

    /**
     * 日程列表 
     * @param type $sd
     * @param type $ed
     * @return type
     */
    public function listCalendarByRange($sd, $ed) {
        $ret = array();
        $ret['events'] = array();
        $ret["issort"] = true;
        $ret["start"] = $this->php2JsTime($sd);
        $ret["end"] = $this->php2JsTime($ed);
        $ret['error'] = null;
        try {
            $cb = new CDbCriteria;
            $cb->addBetweenCondition('starttime', $this->php2MySqlTime($sd), $this->php2MySqlTime($ed));
            $cb->compare('UserId', Yii::app()->user->id);
            $query = $this->findAll($cb);

            foreach ($query as $row) {
                $ret['events'][] = array(
                    $row->Id,
                    $row->Subject,
                    $this->php2MySqlTime(strtotime($row->StartTime)),
                    $this->php2MySqlTime(strtotime($row->EndTime)),
                    $row->IsAllDayEvent,
                    0, //more than one day event
                    //$row->InstanceType,
                    0, //Recurring event,
                    $row->Color,
                    1, //editable
                    $row->Location,
                    '',
                    $row->Description
                );
            }
        } catch (Exception $e) {
            $ret['error'] = $e->getMessage();
        }
        return $ret;
    }

    /**
     * 修改日程
     * @param type $id
     * @param type $st
     * @param type $et
     * @param type $sub
     * @param type $ade
     * @param type $dscr
     * @param type $loc
     * @param type $color
     * @param type $tz
     * @return type
     */
    public function updateDetailedCalendar($id, $st, $et, $sub, $ade, $dscr, $loc, $color, $tz) {
        $ret = array();
        $id = (int) $id;
        $st = $this->php2MySqlTime(strtotime($st));
        $et = $this->php2MySqlTime(strtotime($et));
        try {
            $oldData = $this->findByPk($id);
            $oldData->attributes = array(
                'StartTime' => $st,
                'EndTime' => $et,
                'Subject' => $sub,
                'IsAllDayEvent' => $ade,
                'Description' => $dscr,
                'Location' => $loc,
                'Color' => $color,
            );

            if (!$oldData->update()) {
                $ret['IsSuccess'] = false;
                $ret['Msg'] = join(',', $this->errors);
            } else {
                $ret['IsSuccess'] = true;
                $ret['Msg'] = '修改成功';
            }
        } catch (Exception $e) {
            $ret['IsSuccess'] = false;
            $ret['Msg'] = $e->getMessage();
        }
        return $ret;
    }

    /**
     * 添加日程，详细
     * @param type $st
     * @param type $et
     * @param type $sub
     * @param type $ade
     * @param type $dscr
     * @param type $loc
     * @param type $color
     * @param type $tz
     * @return type
     */
    public function addDetailedCalendar($st, $et, $sub, $ade, $dscr, $loc, $color, $tz) {
        $ret = array();
        $st = $this->php2MySqlTime(strtotime($st));
        $et = $this->php2MySqlTime(strtotime($et));
        try {
            $this->setIsNewRecord(TRUE);
            $this->unsetAttributes();
            $this->attributes = array(
                'StartTime' => $st,
                'EndTime' => $et,
                'Subject' => $sub,
                'IsAllDayEvent' => $ade,
                'Description' => $dscr,
                'Location' => $loc,
                'Color' => $color,
                'UserId' => Yii::app()->user->id,
            );

            if (!$this->save()) {
                $ret['IsSuccess'] = false;
                $ret['Msg'] = join(',', $this->erros);
            } else {
                $ret['IsSuccess'] = true;
                $ret['Msg'] = '添加成功';
                $ret['Data'] = $this->Id;
            }
        } catch (Exception $e) {
            $ret['IsSuccess'] = false;
            $ret['Msg'] = $e->getMessage();
        }
        return $ret;
    }

    public function removeCalendar($id) {
        $ret = array();
        try {
            $id = (int) $id;

            if (!$this->deleteByPk($id)) {
                $ret['IsSuccess'] = false;
                $ret['Msg'] = join(',', $this->errors);
            } else {
                $ret['IsSuccess'] = true;
                $ret['Msg'] = '删除成功';
            }
        } catch (Exception $e) {
            $ret['IsSuccess'] = false;
            $ret['Msg'] = $e->getMessage();
        }
        return $ret;
    }

    public function php2JsTime($phpDate) {
        return date("m/d/Y H:i", $phpDate);
    }

    public function php2MySqlTime($phpDate) {
        return date("Y-m-d H:i:s", $phpDate);
    }

}