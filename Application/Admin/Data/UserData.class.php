<?php

namespace Admin\Data;

class UserData extends BaseData{

    //定义表前缀
    protected $tablePrefix = 'st_common_';

    /**
     * 多条记录查找
     * @return mixed
     */
    public function getList(){

        $data = $this->table('__USER__ AS user')
            ->field('user.*')
            ->select();

        return $data;
    }

}