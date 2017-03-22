<?php

namespace Admin\Data;

use Admin\Enum\ConfigStatusEnum;

class ConfigData extends BaseData{

    //定义表前缀
    protected $tablePrefix = 'st_common_';
    
    /**
     * 获取查询条件
     * @param $conditions
     * @return array
     */
    public function getCondition($conditions){
        $where = array();
        
        if (isset($conditions['id']) && !empty($conditions['id'])) {
            $where['config.id'] = array('EQ', $conditions['id']);
        }
        if (isset($conditions['name']) && !empty($conditions['name'])) {
            $where['config.name'] = array('EQ', $conditions['name']);
        }
        if (isset($conditions['value']) && !empty($conditions['value'])) {
            $where['config.value'] = array('EQ', $conditions['value']);
        }
        if (isset($conditions['type']) && !empty($conditions['type'])) {
            $where['config.type'] = array('EQ', $conditions['type']);
        }
        if (isset($conditions['gmt_create']) && !empty($conditions['gmt_create'])) {
            $where['config.gmt_create'] = array('EQ', $conditions['gmt_create']);
        }
        if (isset($conditions['note']) && !empty($conditions['note'])) {
            $where['config.note'] = array('EQ', $conditions['note']);
        }

        $where['config.status'] = array('EQ',ConfigStatusEnum::ACTIVE);

        return $where;
    }

    /**
     * 单条记录查找
     * @param $id
     * @return mixed
     */
    public function getById($id){
        return $this->table('__CONFIG__ AS config')
                    ->field('config.*')
                    ->where('id=%d',$id)
                    ->find();
    }

    /**
     * 多条记录查找
     * @param $conditions
     * @return mixed
     */
    public function getList($conditions,$pagePara){

        $where = $this->getCondition($conditions);

        $data = $this->table('__CONFIG__ AS config')
            ->field('config.*')
            ->where($where)
            ->select();

        return $data;
    }

    /**
     * 获取微信的token配置
     * @param $field_arr
     * @return mixed
     */
    public function get_wechat_config($field_arr){
        $conditions['name'] = array();

        foreach($field_arr as $key => $val){
            $conditions['name'][] = array('EQ',$val);
        }

        if(count($conditions['name']) > 0){
            $conditions['name'][] = 'or';
        }

        $data = $this->table('__CONFIG__ AS config')
            ->field('config.*')
            ->select();

        return $data;
    }


    public function get_shop_config($field_arr){
        $conditions['name'] = array();

        foreach($field_arr as $key => $val){
            $conditions['name'][] = array('EQ',$val);
        }

        if(count($conditions['name']) > 0){
            $conditions['name'][] = 'or';
        }

        $data = $this->table('__CONFIG__ AS config')
            ->field('config.*')
            ->where('type="system_shop"')
            ->select();

        return $data;
    }
}