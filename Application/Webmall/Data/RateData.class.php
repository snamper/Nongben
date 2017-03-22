<?php

namespace Academy\Data;


class RateData extends BaseData{

    //定义表前缀
    protected $tablePrefix = 'st_academy_';
    
    /**
     * 获取查询条件
     * @param $conditions
     * @return array
     */
    public function getCondition($conditions){
        $where = array();
        return $where;
    }

    /**
     * 获取单条数据
     * @param $id
     * @return mixed
     */
    public function getByUserId($id){
        return $this->table('__RATE__ AS rate')
                    ->field('rate.*')
                    ->where('user_id=%d',$id)
                    ->find();
    }

}