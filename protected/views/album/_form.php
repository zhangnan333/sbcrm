<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/plupload/browserplus-min.js");
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/plupload/plupload.js");
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/plupload/plupload.gears.js");
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/plupload/plupload.silverlight.js");
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/plupload/plupload.flash.js");
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/plupload/plupload.browserplus.js");
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/plupload/plupload.html4.js");
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/plupload/plupload.html5.js");
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/plupload/jquery.plupload.queue/jquery.plupload.queue.js");
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/plupload/i18n/cn.js");
?>
<div class="flexform">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'album-form',
        'enableAjaxValidation' => false
            ));
    ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'cover'); ?>
        <div id="cover_box" style="float: left;">
            <img id="cover_img" src="<?php echo Yii::app()->baseUrl; ?>/images/nopic.png" style="border:1px solid #ddd;padding: 2px;" />
            <div id="filelist">No runtime found.</div>
            <div style="margin-top: 5px;">
                <a class="button" id="pickfiles" href="#"><span>浏览本地图片</span></a>
                <a class="button blue" id="uploadfiles" href="#"><span>上传</span></a>
            </div>

        </div>
        <?php
        echo $form->hiddenField($model, 'cover');
        echo $form->hiddenField($model, 'dir');
        ?>
        <?php echo $form->error($model, 'cover', array('class' => 'form-msg-error-advanced')); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'album_title'); ?>
        <?php echo $form->textField($model, 'album_title', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'album_title', array('class' => 'form-msg-error-advanced')); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'album_describe'); ?>
        <?php echo $form->textArea($model, 'album_describe', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'album_describe', array('class' => 'form-msg-error-advanced')); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'photographer'); ?>
        <?php echo $form->textField($model, 'photographer', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'photographer', array('class' => 'form-msg-error-advanced')); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'show_home'); ?>
        <?php echo $form->textField($model, 'show_home'); ?>
        <?php echo $form->error($model, 'show_home', array('class' => 'form-msg-error-advanced')); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'order_sort'); ?>
        <?php echo $form->textField($model, 'order_sort', array('size' => 5, 'maxlength' => 5)); ?>
        <?php echo $form->error($model, 'order_sort', array('class' => 'form-msg-error-advanced')); ?>
    </div>


    <div class="action">
        <?php echo CHtml::submitButton($model->isNewRecord ? '创建' : '保存'); ?>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- form -->
<div class="clear"></div>
<script>
    $(function(){
        var uploader = new plupload.Uploader({
            runtimes : 'html5,flash,silverlight,browserplus',
            browse_button : 'pickfiles',
            container : 'cover_box',
            max_file_size : '1mb',
            url : '<?php echo Yii::app()->createUrl('plupload/upload'); ?>',
            flash_swf_url : '<?php echo Yii::app()->baseUrl; ?>/js/plupload/plupload.flash.swf',
            silverlight_xap_url : '<?php echo Yii::app()->baseUrl; ?>/js/plupload/plupload.silverlight.xap',
            filters : [
                {title : "Image files", extensions : "jpg,gif,png"},
            ],
            resize : {width : 192, height : 144, quality : 100},
            multipart_params : {dir : '<?php echo $model->dir; ?>'}
        });
        
        uploader.bind('Init', function(up, params) {
            $('#filelist').html("<div>Current runtime: " + params.runtime + "</div>");
        });

        $('#uploadfiles').click(function(e) {
            uploader.start();
            e.preventDefault();
        });

        uploader.init();

        uploader.bind('FilesAdded', function(up, files) {
            $.each(files, function(i, file) {
                $('#filelist').append(
                '<div id="' + file.id + '">' +
                    file.name + ' (' + plupload.formatSize(file.size) + ') <b></b>' +
                    '</div>');
            });

            up.refresh(); // Reposition Flash/Silverlight
        });

        uploader.bind('UploadProgress', function(up, file) {
            $('#' + file.id + " b").html(file.percent + "%");
        });

        uploader.bind('Error', function(up, err) {
            $('#filelist').append("<div>Error: " + err.code +
                ", Message: " + err.message +
                (err.file ? ", File: " + err.file.name : "") +
                "</div>").show();

            up.refresh(); // Reposition Flash/Silverlight
        });

        uploader.bind('FileUploaded', function(up, file, info) {
            $('#' + file.id + " b").html("100%");
            re = $.parseJSON(info.response);
            $('#cover_img').attr('src', '<?php echo Yii::app()->baseUrl; ?>/album/'+re.filePath);
            $("#Album_cover").val(re.filePath);
        });
    });
</script>