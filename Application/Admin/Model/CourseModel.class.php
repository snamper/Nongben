<?php

namespace Admin\Model;

class CourseModel extends BaseModel{
    //定义表前缀
    protected $tablePrefix = 'st_academy_';
    // 自动完成
    protected $_auto = array(
        array('gmt_create', 'get_date', self::MODEL_INSERT, 'function'),
        array('gmt_update', 'get_date', self::MODEL_BOTH, 'function'),
        array('learned_count', 0, self::MODEL_INSERT, 'string'),
        array('comment_count', 0, self::MODEL_INSERT, 'string'),
    );
}