<?php

class searchFieldWidget extends CWidget {

    /**
     * @var 保存/更新URL
     */
    public $titleText='输入关键字...';
    /**
     * @var 数据模型
     */
    public $inputName,$inputId,$initText;
    public $inputClass='input-1';
    /**
     * @var 生成脚手架
     */
    public function run() {
       echo '<input type="text" name="'.$this->inputName.'"'; 
//       echo 'onFocus="if(this.value==\''.$this->initText.'\')this.value=\'\';" ';
//       echo 'onBlur="if(this.value==\'\')this.value=\''.$this->initText.'\';" ';
       echo 'id="'.$this->inputId.'" title="'.$this->titleText.'" ';
       echo 'value="'.$this->initText.'" class="'.$this->inputClass.' tip"/>';
    }
}