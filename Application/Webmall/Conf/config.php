<?php
return array(
    //'配置项'=>'配置值'
    'DEFAULT_THEME'     =>    'Default', //前台模板主题

    //模板静态文件路径解析
    'TMPL_PARSE_STRING' => array (
        '__IMG__'    => __ROOT__ . '/Public/' . MODULE_NAME  . '/images',
        '__CSS__'    => __ROOT__ . '/Public/' . MODULE_NAME  . '/css',
        '__JS__'     => __ROOT__ . '/Public/' . MODULE_NAME  . '/js',
    ),

);