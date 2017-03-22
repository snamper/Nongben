<?php

namespace Webmall\Controller;
use Think\Controller;

class SourceController extends Controller{


    /**
     * @var \Admin\Logic\SourceLogic
     */
    protected $sourceLogic;

    public function _initialize(){
        $this->sourceLogic = D('Source', 'Logic');
    }

    /**
     * 数据列表
     */
    public function trace(){
        $sourceList = $this->sourceLogic->getList();

        $this->assign("list",$sourceList);
        $this->display();
    }

}
