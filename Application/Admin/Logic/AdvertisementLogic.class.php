<?php

namespace Admin\Logic;


class AdvertisementLogic extends BaseLogic{

    /**
     * @var \Admin\Data\AdvertisementData
     */
    protected $advertisementData;

    public function _initialize(){
        $this->advertisementData = D('Advertisement', 'Data');
    }

    /**
     * 获取单条数据
     * @param $id
     * @return mixed
     */
    public function getById($id){
        return $this->advertisementData->getById($id);
    }

    /**
     * 获取多条数据
     * @return mixed
     */
    public function getList(){
        return $this->advertisementData->getList();
    }

    /**
     * 添加数据
     * @param $data
     * @return bool
     */
    public function saveAdvertisement($data){

        $Advertisement = D('Advertisement');

        if($Advertisement->create($data)){
            return $Advertisement->add();
        }else{
            return false;
        }
    }

    /**
     * 修改数据
     * @param $data
     * @return bool
     */
    public function editAdvertisement($data){
        $Advertisement = D('Advertisement');

        if($Advertisement->create($data)){
            return $Advertisement->save();
        }else{
            return false;
        }
    }

    /**
     * 删除数据
     * @param $data
     * @return mixed
     */
    public function delAdvertisement($data){
        $Advertisement = D('Advertisement');

        return $Advertisement->delete($data);
    }
}