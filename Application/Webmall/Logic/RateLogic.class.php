<?php

namespace Academy\Logic;

class RateLogic extends BaseLogic{

    protected $rateData;

    public function _initialize(){
        $this->rateData = D('Rate', 'Data');
    }

    /**
     * 获取单条数据
     * @param $id
     * @return mixed
     */
    public function getByUserId($id){
        return $this->rateData->getByUserId($id);
    }

    /**
     * 某字段+1
     * @param $id
     * @param $field
     * @return bool
     */
    public function setInc($id,$field){
        $Rate = D('Rate');
        return $Rate->where('id = %d',$id)->setInc($field,1);
    }
    public function setDec($id,$field){
        $Rate = D('Rate');
        return $Rate->where('id = %d',$id)->setDec($field,1);
    }

    /**
     * 添加数据
     * @param $data
     * @return bool|mixed
     */
    public function saveRate($data){
        $Rate = D('Rate');

        if($Rate->create($data)){
            return $Rate->add();
        }else{
            return false;
        }
    }

    /**
     * 修改数据
     * @param $data
     * @return bool
     */
    public function editRate($data){
        $Rate = D('Rate');

        if($Rate->create($data)){
            return $Rate->save();
        }else{
            return false;
        }
    }

}