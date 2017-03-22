<?php
return array(
    'DEFAULT_MODULE'        =>  'Webmall',  // 默认模块
    'TMPL_CACHE_ON'         =>  false,        // 是否开启模板编译缓存,设为false则每次都会重新编译
    'TMPL_CACHE_PREFIX'     =>  '',         // 模板缓存前缀标识，可以动态改变
    'TMPL_CACHE_TIME'       =>  0,         // 模板缓存有效期 0 为永久，(以数字为值，单位:秒)
    'PUBLIC_UPLOAD_PATH'    => './Public/',    //公共的文件上传路径
    'SHOW_PAGE_TRACE'       => false,
    'AU_KEY'                => '2347adfas……&*(',

    // URL配置
    'URL_CASE_INSENSITIVE' => false, //默认false 表示URL区分大小写 true则表示不区分大小写
    'VAR_URL_PARAMS' => '', // PATHINFO URL参数变量
    'URL_PATHINFO_DEPR' => '/', //PATHINFO URL分割符
    'URL_MODEL'             => 2,

    // 完整域名部署
    'APP_SUB_DOMAIN_DEPLOY'   =>    1, // 开启子域名配置
    'APP_SUB_DOMAIN_RULES'    =>    array(
//        '10.18.11.144:81'  => 'Account/Index',
        '10.18.11.24:81'  => 'Account/Index',
        'm.doohan.com'  => 'Wapsite',
    ),

    'URL_MODULE_MAP'=>array(
        'm'      =>  'Wapsite',
        'mall'      =>  'Wapmall',
    ),

    // 用户中心域名配置
//    'ACCOUNT_DOMAIN_URL'     => 'http://10.18.11.144:81',
//    'ACCOUNT_M_DOMAIN_URL'     => 'http://10.18.11.144:81',

    'ACCOUNT_DOMAIN_URL'     => 'http://10.18.11.24:81',
    'ACCOUNT_M_DOMAIN_URL'     => 'http://10.18.11.24:81',

    //'DB_PREFIX' => 'dh_common_', // 数据库表前缀
    'DB_PREFIX_COMMON' => 'st_common_', // 公用信息数据表前缀
    'DB_PREFIX_PIN' => 'dh_pin_', // 拼车信息数据表前缀
    'DB_PREFIX_TUAN' => 'dh_tuan_', // 拼车信息数据表前缀

    //数据库配置1
    'DB_MAIN' => array(
        'DB_TYPE' => 'mysqli', // 数据库类型
        'DB_HOST' => 'localhost', // 服务器地址
        'DB_NAME' => 'nongben', // 数据库名
        'DB_USER' => 'gst', // 用户名
        'DB_PWD' => 'BD6JFXjetUNCnLWB', // 密码
        'DB_PORT' => '3306', // 端口
    ),

    //邮件配置
    'THINK_EMAIL' => array(
        'SMTP_HOST'   => 'smtp.lierda.com', //SMTP服务器
        'SMTP_PORT'   => '25', //SMTP服务器端口
        'SMTP_USER'   => 'xxx@lierda.com', //SMTP服务器用户名
        'SMTP_PASS'   => 'xxx', //SMTP服务器密码
        'FROM_EMAIL'  => 'xxx@lierda.com', //发件人EMAIL
        'FROM_NAME'   => 'ThinkPHP', //发件人名称
        'REPLY_EMAIL' => '', //回复EMAIL（留空则为发件人EMAIL）
        'REPLY_NAME'  => '', //回复名称（留空则为发件人名称）
    ),

    'ERROR_PAGE' =>'/Home/Public/404.html',
    //'URL_CONTROLLER_MAP'    =>    array('index'=>'route'),

    //微信配置
    'WECHAT' => array(
        'APPID' => 'wx370440bd9823658b',
        'APPSECRET' => '109c4f88e1ffefc4558e307af99dc045'
    ),


    //商城配置
    'SHOP'  => array(
        'GOODS_CATEGORY'    => 4, //商城分类所属的根节点ID
    )
);