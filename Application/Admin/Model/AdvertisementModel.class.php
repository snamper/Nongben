<?php

namespace Admin\Model;

class AdvertisementModel extends BaseModel{
    //定义表前缀
    protected $tablePrefix = 'st_academy_';
    // 自动完成
    protected $_auto = array(
        array('gmt_create', 'get_date', self::MODEL_INSERT, 'function'),
        array('gmt_update', 'get_date', self::MODEL_BOTH, 'function'),
    );
}