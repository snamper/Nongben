<?php

namespace Admin\Model;

class CommentModel extends BaseModel{
    //定义表前缀
    protected $tablePrefix = 'st_academy_';
    // 自动完成
    protected $_auto = array(
        array('gmt_create','get_date',self::MODEL_INSERT,'function'),
    );
}