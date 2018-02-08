<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
        <title>Plupload - Queue widget example</title>
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/js/plupload/jquery.plupload.queue/css/jquery.plupload.queue.css" type="text/css" media="screen" />

        <script src="<?php echo Yii::app()->baseUrl; ?>/js/plupload/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/plupload/browserplus-min.js"></script>

        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/plupload/plupload.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/plupload/plupload.silverlight.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/plupload/plupload.flash.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/plupload/plupload.browserplus.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/plupload/plupload.html4.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/plupload/plupload.html5.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/plupload/jquery.plupload.queue/jquery.plupload.queue.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/plupload/i18n/cn.js"></script>

    </head>
    <body>
        <div style="margin: auto;width: 1000px;">
            <h1>图片管理</h1>
            <div style="margin-right: 20px">
                <div id="flash_uploader" style="width: 800px; height: 330px;">
                    You browser doesn't have Flash, Silverlight or HTML5 support
                </div>

            </div>

            <div>
                <ul id="imgs" style="height:100px;">
                    <?php foreach ($photos as $v):?>
                    <li onclick="deleteImg('<?php echo $v->id;?>', this)">
                        <img width="192" height="144" src="<?php echo Yii::app()->baseUrl;?>/album/<?php echo $v->img;?>" />
                        <div style="position: absolute;height: 50px;background: #f3f3f3;width: 192px;line-height: 50px;margin-top: -50px;display: none;text-align: center;color: red;">删除</div>
                    </li>
                    <?php endforeach;?>
                </ul>
                <div style="clear:both;"></div>
            </div>
        </div>

        <script type="text/javascript">
            function deleteImg(id, obj){
                $.get("<?php echo $this->createUrl('delete');?>", {id:id}, function(data){
                    if(data==1){
                        $(obj).remove();
                    }
                });
            }
            $(function() {
                $("li").bind("mouseover", function(event){
                    $(this).find('div').show();
                    event.preventDefault();
                }).bind("mouseout", function(event){
                    $(this).find('div').hide();
                    event.preventDefault();
                });
                // Setup flash version
                $("#flash_uploader").pluploadQueue({
                    // General settings
                    runtimes : 'html5,flash,silverlight,',
                    url : '<?php echo Yii::app()->createUrl('plupload/upload'); ?>',
                    max_file_size : '10mb',
                    chunk_size : '1mb',
                    rename : true,
                    unique_names : true,
                    multiple_queues : true,
                    filters : [
                        {title : "Image files", extensions : "jpg,gif,png"}
                    ],

                    // Resize images on clientside if we can
                    //resize : {width : 600, height : 400, quality : 100},
                    multipart_params : {dir : "<?php echo $album->dir;?>", album_id:"<?php echo $album->id;?>"},

                    flash_swf_url : '<?php echo Yii::app()->baseUrl; ?>/js/plupload/plupload.flash.swf',
                    silverlight_xap_url : '<?php echo Yii::app()->baseUrl; ?>/js/plupload/plupload.silverlight.xap',
                    init : {
                        FileUploaded : function(up, file, info){
                            re = $.parseJSON(info.response);
                            var li = document.createElement('li');
                            var img = document.createElement('img');
                            img.setAttribute('src', '<?php echo Yii::app()->baseUrl; ?>/album/'+re.filePath);
                            img.setAttribute('width', '192');
                            
                            li.appendChild(img);
                            $("#imgs").append(li);
                        }
                    }
                });
	

            });
        </script>

    </body>
</html>