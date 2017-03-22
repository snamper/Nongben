<?php

namespace Admin\Model;

class LogModel extends BaseModel{
    //定义表前缀
    protected $tablePrefix = 'st_common_';
    // 自动完成
    protected $_auto = array(
        array('status', 1, self::MODEL_INSERT, 'string'),
        array('gmt_operate', 'get_date', self::MODEL_INSERT, 'function'),
        array('ip', 'get_client_ip', self::MODEL_INSERT, 'function'),
    );
}