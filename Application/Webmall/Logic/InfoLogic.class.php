<?php

namespace Webmall\Logic;

class InfoLogic extends BaseLogic{

    /**
     * @var \Admin\Data\InfoData
     */
    protected $InfoData;

    public function _initialize(){
        $this->InfoData = D('Info', 'Data');
    }

    /**
     * 获取资讯详情
     * @param $id
     * @return mixed
     */
    public function getById($id){
        return $this->InfoData->getById($id);
    }

    /**
     * 获取资讯列表
     * @return mixed
     */
    public function getList(){
        return $this->InfoData->getList();
    }
    public function getListLimit(){
        return $this->InfoData->getListLimit();
    }

    /**
     * 获取热门资讯列表
     * @return mixed
     */
    public function getHotList(){
        return $this->InfoData->getHotList();
    }

    /**
     * 浏览次数+1
     * @param $id
     * @return bool
     */
    public function setAsc($id){
        $Info = D('info');
        return $Info->where('id=%d',$id)->setInc('count');
    }
}