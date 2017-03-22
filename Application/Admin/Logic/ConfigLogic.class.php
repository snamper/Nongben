<?php

namespace Admin\Logic;

use Think\Exception;

class ConfigLogic extends BaseLogic{

    /**
     * @var \Admin\Data\ConfigData
     */
    protected $configData;

    public function _initialize(){
        $this->configData = D('Admin/Config', 'Data');
    }

    /**
     * 获取单条数据
     * @param $id
     * @return mixed
     */
    public function getById($id){
        return $this->configData->getById($id);
    }

    /**
     * 获取多条数据
     * @param $conditions
     * @param null $pagePara
     * @return mixed
     */
    public function getList($conditions,$pagePara = null){
        return $this->configData->getList($conditions,$pagePara);
    }

    public function saveTuanConfig($data){
        $Config = D('Config');

        $Config->startTrans();

        try{
            // 取消行程原因
            foreach($data['return_order'] as $k=>$v){
                if(empty($v)){
                    throw new Exception('退货原因不能为空');
                }

                $config['id'] = $data['return_order_id'][$k];
                $config['value'] = $v;

                $Config->save($config);
            }

            $Config->commit();
            return true;
        }catch (\Exception $e){
            $Config->rollback();
            $this->error = $e->getMessage();
            return false;
        }
    }

    /**
     * 修改数据
     * @param $data
     * @return bool
     */
    public function editConfig($data){
        $Config = D('Config');

        if($Config->create($data)){
            return $Config->save();
        }else{
            return false;
        }
    }

    /**
     * 添加数据
     * @param $data
     * @return bool
     */
    public function saveConfig($data){
        $Apply = D('Config');

        if($Apply->create($data)){
            return $Apply->add();
        }else{
            return false;
        }
    }

    /**
     * 删除数据
     * @param $id
     * @return mixed
     */
    public function delConfig($id){
        $Config = D('Config');

        return $Config->delete($id);
    }

    /**
     * 获取微信的token配置
     * @param $field_arr
     * @return mixed
     */
    public function get_wechat_config($field_arr){
        $configList = $this->configData->get_wechat_config($field_arr);
        return $configList;
    }


    public function update_wechat_config($field,$value){
        $Config = D('Admin/Config');

        $Config->where("name = '%s'",$field)->setField('value',$value);
    }



    /**
     * 获取商城配置
     * @param $field_arr
     * @return mixed
     */
    public function get_shop_config($field_arr){
        $configList = $this->configData->get_shop_config($field_arr);
        $config = array();
        foreach($configList as $key=>$val){
            $config[$val['name']] = $val['value'];
        }
        return $config;
    }


    public function saveShopConfig($data){
        $Config = D('Config');

        $Config->startTrans();

        try{
            $Config->where('type="system_shop"')->delete();

            foreach($data as $k=>$v){
                $info = array();
                $info['name'] = $k;
                $info['value'] = $v;
                $info['status'] = 1;
                $info['type'] = 'system_shop';
                $info['gmt_create'] = get_date();

                $Config->data($info)->add();
            }

            $Config->commit();
            return true;
        }catch (\Exception $e){
            $Config->rollback();
            $this->error = $e->getMessage();
            return false;
        }
    }
}