<?php

namespace Webmall\Logic;

class AdvertisementLogic extends BaseLogic{

    /**
     * @var \Admin\Data\AdvertisementData
     */
    protected $advertisementData;

    public function _initialize(){
        $this->advertisementData = D('Advertisement', 'Data');
    }

    /**
     * 获取广告列表
     * @return mixed
     */
    public function getAdvList(){
        return $this->advertisementData->getAdvList();
    }
}