<?php

namespace Admin\Controller;

class AdvertisementController extends BaseController{


    /**
     * @var \Admin\Logic\AdvertisementLogic
     */
    protected $advertisementLogic;

    public function _initialize(){
        $this->advertisementLogic = D('Advertisement', 'Logic');
    }

    /**
     * 数据列表1
     */
    public function index(){
        $advertisementList = $this->advertisementLogic->getList();

        $this->assign("list",$advertisementList);
        $this->display();
    }

    /**
     * 添加视图
     */
    public function add(){
        $this->display();
    }

    /**
     * 编辑视图
     */
    public function edit($id){
        $advertisement = $this->advertisementLogic->getById($id);
        $this->assign("advertisement",$advertisement);
        $this->display();
    }

    /**
     * 添加操作
     */
    public function do_add(){
        $data = $this->getAvailableData();
        if(empty($data['sort'])){
            $data['sort'] = 1;
        }
        $result = $this->advertisementLogic->saveAdvertisement($data);

        $this->ajaxAuto($result,'添加',U('Advertisement/index'));
    }

    /**
     * 编辑操作
     */
    public function do_edit(){
        $data = $this->getAvailableData();
        if(empty($data['sort'])){
            $data['sort'] = 1;
        }
        $result = $this->advertisementLogic->editAdvertisement($data);

        $this->ajaxAuto($result,'修改',U('advertisement/index'));
    }

    /**
     * 删除操作
     */
    public function do_del($id){
        $result = $this->advertisementLogic->delAdvertisement($id);

        $this->ajaxAuto($result,'删除');
    }
}
