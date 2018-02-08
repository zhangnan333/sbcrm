<?php

class smallsliderWidget extends CWidget {

    public $adsType;
    public $words = 20;
    public $limit;
    public $is_order = true;
    public $divId;
    public $width;
    public $height;
    public $class;
    public $adsId;
    public function run() {
        //注册需要的js
        $basePath = Yii::getPathOfAlias('application.extensions.Smallslider.assets');
        $baseUrl = Yii::app()->getAssetManager()->publish($basePath);
        $cs = Yii::app()->getClientScript();
        $cs->registerScriptFile($baseUrl . '/js/jquery.smallslider.js');
        $cs->registerCssFile($baseUrl . '/css/smallslider.css');
        //单选多选按钮判断
        $criteria = new CDbCriteria;
        $criteria->compare('state', 1);
        if($this->adsId){
            $criteria->compare('id', $this->adsId);
        }else{
            $criteria->compare('sort', $this->adsType);
        }
        $criteria->order = $this->is_order ? "sort_order DESC" : "RAND()";
        $criteria->select = "SUBSTRING(title, 1, " . $this->words . ") AS title,images,url";
        //随机获取图片数量
        $criteria->limit = $this->limit;
        $data = Ads::model()->findAll($criteria);
        if (!empty($data)) {
            $eString = "<div id='".$this->divId."' class='" . $this->class . " smallslider' style='width:" . $this->width . ";height:" . $this->height . "'>";
            $eString.= "<ul>";
            foreach ($data as $sData) {
                $title = $sData['title'] . '...';
                $image = Yii::app()->baseUrl.'/' . $sData['images'];
                $url = $sData['url'];
                $eString.= '<li>
                <a target="_blank" href="' . $url . '">
                <img src="' . $image . '" title="" alt="' . $title . '" />
                </a>
            </li>';
            }
            $eString.= "</ul>";
            $scriptStr = '
            $(function(){
                $("#' . $this->divId . '").smallslider();
            })
        ';
            echo $eString . "</div>";
            Yii::app()->clientScript->registerScript($this->divId, $scriptStr, CClientScript::POS_READY);
        }
    }

}