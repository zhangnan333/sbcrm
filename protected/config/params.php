<?php

// this contains the application parameters that can be maintained via GUI
return array(
    // this is displayed in the header section
    'title' => '游戏销售站数据中心',
    // this is used in error pages
    'adminEmail' => 'freeflowf@gmail.com',
    // number of posts displayed per page
    'postsPerPage' => 10,
    // maximum number of comments that can be displayed in recent comments portlet
    'recentCommentCount' => 10,
    // maximum number of tags that can be displayed in tag cloud portlet
    'tagCloudCount' => 20,
    // whether post comments need to be approved before published
    'commentNeedApproval' => true,
    // the copyright information displayed in the footer section
    'copyrightInfo' => 'Copyright &copy; 2009 by usfine.com.',
    
    //客户状态 
    'cStatus' => array(
        '0' => '新咨询',
        1 => '签约',
        2 => '暂停',
        4 => '停缴',
        8 => '终止',  
    ),
    'cStatusHtml' => array(
        0 => '<font color="#008500">新咨询</font>',
        1 => '<font color="blue">签约</font>',
        2 => '<font color="red">暂停</font>',
        4 => '<font color="#ffb273">停缴</font>',
        8 => '<font color="#999">终止</font>',  
    ),
    //客户类型
    'cType' => array(
        1 => '个人',
        2 => '企业'
    ),
    //性别
    'sexs' => array(
        0 => '未设置',
        '男' => '男',
        '女' => '女',
    ),
    /**
     * 服务费缴费方式
     * 当方式为按月支付时，服务费计入当月应付总费用
     */
    'scTypes' => array(
        'month' => '月',
        'semester' => '半年',
        'year' => '年'
    ),
);
