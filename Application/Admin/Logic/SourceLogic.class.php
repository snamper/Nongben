<?php

namespace Admin\Logic;


class SourceLogic extends BaseLogic{

    /**
     * @var \Admin\Data\SourceData
     */
    protected $sourceData;

    public function _initialize(){
        $this->sourceData = D('Source', 'Data');
    }

    /**
     * 获取单条数据
     * @param $id
     * @return mixed
     */
    public function getById($id){
        return $this->sourceData->getById($id);
    }

    /**
     * 获取多条数据
     * @return mixed
     */
    public function getList(){
        return $this->sourceData->getList();
    }

    /**
     * 添加数据
     * @param $data
     * @return bool
     */
    public function saveSource($data){

        $Source = D('Source');

        if($Source->create($data)){
            return $Source->add();
        }else{
            return false;
        }
    }

    /**
     * 修改数据
     * @param $data
     * @return bool
     */
    public function editSource($data){
        $Source = D('Source');

        if($Source->create($data)){
            return $Source->save();
        }else{
            return false;
        }
    }

    /**
     * 删除数据
     * @param $data
     * @return mixed
     */
    public function delSource($data){
        $Source = D('Source');

        return $Source->delete($data);
    }
}