<?php

namespace Admin\Model;

class UserModel extends BaseModel{
    //定义表前缀
    protected $tablePrefix = 'st_common_';
    // 自动完成
    protected $_auto = array(
        array('is_black', 0, self::MODEL_INSERT, 'string'),
        array('points', 0, self::MODEL_INSERT, 'string'),
        array('gmt_create', 'get_date', self::MODEL_INSERT, 'function'),
        array('gmt_update', 'get_date', self::MODEL_BOTH, 'function')
    );
}