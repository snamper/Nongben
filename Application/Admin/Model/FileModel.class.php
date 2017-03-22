<?php

namespace Admin\Model;

class FileModel extends BaseModel{
    //定义表前缀
    protected $tablePrefix = 'st_common_';
    // 自动完成
    protected $_auto = array(
        array('status', 1, self::MODEL_INSERT, 'string'),
        array('gmt_create', 'get_date', self::MODEL_INSERT, 'function'),
    );
}