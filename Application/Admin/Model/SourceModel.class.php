<?php

namespace Admin\Model;

class SourceModel extends BaseModel{
    //定义表前缀
    protected $tablePrefix = 'st_common_';
    // 自动完成
    protected $_auto = array(
        array('gmt_create', 'get_date', self::MODEL_INSERT, 'function'),
        array('gmt_update', 'get_data', self::MODEL_UPDATE, 'function'),
    );
}