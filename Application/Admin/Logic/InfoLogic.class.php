<?php

namespace Admin\Logic;

class InfoLogic extends BaseLogic{

    /**
     * @var \Admin\Data\InfoData
     */
    protected $InfoData;

    public function _initialize(){
        $this->InfoData = D('Info', 'Data');
    }

    /**
     * 获取单条数据
     * @param $id
     * @return mixed
     */
    public function getById($id){
        return $this->InfoData->getById($id);
    }

    /**
     * 获取多条数据
     * @return mixed
     */
    public function getList(){
        return $this->InfoData->getList();
    }

    /**
     * 添加数据
     * @param $data
     * @return bool
     */
    public function saveInfo($data){

        $Info = D('Info');

        if($Info->create($data)){
            return $Info->add();
        }else{
            return false;
        }
    }

    /**
     * 修改数据
     * @param $data
     * @return bool
     */
    public function editInfo($data){
        $Info = D('Info');

        if($Info->create($data)){
            return $Info->save();
        }else{
            return false;
        }
    }

    /**
     * 删除数据
     * @param $id
     * @return mixed
     */
    public function delInfo($id){
        $Info = D('Info');

        return $Info->delete($id);
    }

}