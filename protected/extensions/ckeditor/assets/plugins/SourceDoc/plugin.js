//CKEDITOR.plugins.add("SourceDoc", {
//    requires: ["dialog"],
//    init: function(a)
//    {
//        a.addCommand("SourceDoc", new CKEDITOR.dialogCommand("SourceDoc"));
//        a.ui.addButton("SourceDoc", {
//            label: "插入代码",
//            command: "SourceDoc",
//            icon: this.path + "dialogs/doc.png"
//        });
//        CKEDITOR.dialog.add("SourceDoc", this.path + "dialogs/dialog.js");
//    }
//});

( function() {
    CKEDITOR.plugins.add( 'SourceDoc',
    {
        requires: [ 'iframedialog_r' ],
        init: function( editor )
        {
            var height = 380, width = 650;
            var bUrl = CKEDITOR.basePath;
            var pos = bUrl.lastIndexOf('/');
            bUrl = bUrl.substring(0,pos);
            pos = bUrl.lastIndexOf('/');
            bUrl = bUrl.substring(0,pos);
            pos = bUrl.lastIndexOf('/');
            bUrl = bUrl.substring(0,pos);
            CKEDITOR.dialog.addIframe(
                'myiframedialogDialog',
                '选择关联文档',
                bUrl+'/admin.php?r=scAdmin/gridSelect/data&model=information', width, height,
                function()
                {
                    // Iframe loaded callback.
                },
                function(){
                    var iObj = $("#select_iframe",parent.document.body).contents();
                    var dObj = iObj.find("#information_select_grid_content tr");
                    var rString = "";
                    $.each(dObj,function(n,o){
                        var tdObj = $(o).find('td');
                        $.each(tdObj,function(tn,to){
                           var dId = $(to).eq(1).html(); 
                           var dvalue = $(to).eq(2).html(); 
                            rString+="<a herf='"+bUrl+"information/view/id"+dId+"'>"+dvalue+"</a>";
                        });
                    });
                    editor.insertHtml(rString); 
                }
            );
            editor.addCommand( 'SourceDoc', new CKEDITOR.dialogCommand( 'myiframedialogDialog' ) );
            editor.ui.addButton( 'SourceDoc',
            {
                label: '选择关联的系统文档',
                command: 'SourceDoc',
                icon: this.path + 'doc.png'
            });
        }
    });

})();
//问题集中处理
//1)对应问题
//2)操作类型 插入 or 跟新