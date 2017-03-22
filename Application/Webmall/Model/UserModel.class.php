<?php

namespace Webmall\Model;

class UserModel extends BaseModel{
    //定义表前缀
    protected $tablePrefix = 'st_common_';
    // 自动完成
    protected $_auto = array(
        array('study_count', 0, self::MODEL_INSERT, 'string'),
        array('login_count', 1, self::MODEL_INSERT, 'string'),
        array('comment_count', 0, self::MODEL_INSERT, 'string'),
        array('gmt_login', 'get_date', self::MODEL_INSERT, 'function'),
        array('gmt_create', 'get_date', self::MODEL_INSERT, 'function'),
        array('gmt_update', 'get_date', self::MODEL_BOTH, 'function')
    );
}