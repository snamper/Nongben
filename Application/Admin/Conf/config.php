<?php
return array(
    'DEFAULT_THEME'     =>    'Default', //后台模板主题
    //'TMPL_ENGINE_TYPE'  =>    'Smarty',
    'TMPL_ACTION_ERROR' => 'Public:error',    //错误页面
    'TMPL_ACTION_SUCCESS' => 'Public:success',      //成功页面
    


    //模板静态文件路径解析
    'TMPL_PARSE_STRING' => array (
        '__IMG__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/images',
        '__CSS__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/css',
        '__JS__'     => __ROOT__ . '/Public/' . MODULE_NAME . '/js',
        '__TABLES__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/tables',
        '__FONTS__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/fonts',
        '__CSS1__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/css1',
        '__JS1__'     => __ROOT__ . '/Public/' . MODULE_NAME . '/js1',
        '__UPLOAD__'     => __ROOT__ . '/Public/' . MODULE_NAME . '/upload/',
    ),
    'PASSWORD_SALT_KEY' =>  'BFM!#@$^%',    //密码salt

    //日志设置
    'LOG_RECORD'            =>  false,   // 默认不记录日志
    'LOG_TYPE'              =>  'File', // 日志记录类型 默认为文件方式
    'LOG_LEVEL'             =>  'EMERG,ALERT,CRIT,ERR',// 允许记录的日志级别
    'LOG_EXCEPTION_RECORD'  =>  false,    // 是否记录异常信息日志

    'PAY' => array(
        // 支付宝支付相关常量
        'A_HOST' => 'http://app.lierdapark.com/mica/ali/pay',
        //'HOST' => 'http://10.18.11.208:8010/mica/ali/pay',
        'BUSINESS_TYPE_ID' => 8,   //1是积分充值 2是拼车 3是团购 4是园区消费。
        //'BUSINESS_TYPE_KEY' => 'ac0321ajm',
        'MONEY_TYPE' => 1,   //0是积分 1是人民币。
        'A_AUTH_SECRET' => '92dmzpmkvdaqf7lkb5ddaegbbeabi41q',    //支付宝签名秘钥
        'PAY_TYPE' => 0,      // 0=支付宝 1=微信 2=积分 3=钱包
    ),
    define('IS_LOG', true),//是否开启后台操作日志记录

    'SMS'   =>  array(
        'MSG_URL'       => 'http://183.136.236.86:8899/smsAccept/sendSms.action',
        'MSG_REPORT_URL'    => 'http://183.136.236.86:8899/smsAccept/batchReport.action',
        'MSG_BACH_URL'  =>  'http://183.136.236.86:8899/smsAccept/batchMt.action', //批量触发
        'MSG_SID'       => '710202',
        'MSG_CPID'      => '10010202',
        'MSG_KEY'       => 'A51w1E24w8x17wq248qw',
    ),

);