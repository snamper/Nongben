<?php

namespace Webmall\Logic;


class SourceLogic extends BaseLogic{

    /**
     * @var \Admin\Data\SourceData
     */
    protected $sourceData;

    public function _initialize(){
        $this->sourceData = D('Source', 'Data');
    }

    /**
     * 获取多条数据
     * @return mixed
     */
    public function getList(){
        return $this->sourceData->getList();
    }

}