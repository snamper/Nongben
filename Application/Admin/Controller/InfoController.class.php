<?php

namespace Admin\Controller;



class InfoController extends BaseController{

    protected $infoLogic;

    public function _initialize(){
        $this->infoLogic = D('Info', 'Logic');
    }

    /**
     * 数据列表
     */
    public function index(){
        $infoList = $this->infoLogic->getList();

        $this->assign("list",$infoList);
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
        $info = $this->infoLogic->getById($id);

        $this->assign("info",$info);
        $this->display();
    }

    /**
     * 查看视图
     */
    public function detail($id){
        $activity = $this->infoLogic->getById($id);

        $this->assign("activity",$activity);
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
        $result = $this->infoLogic->saveInfo($data);

        $this->ajaxAuto($result,'添加',U('info/index'));
    }

    /**
     * 编辑操作
     */
    public function do_edit(){
        $data = $this->getAvailableData();
        if(empty($data['sort'])){
            $data['sort'] = 1;
        }
        $result =$this->infoLogic->editInfo($data);

        $this->ajaxAuto($result,'修改',U('info/index'));
    }

    /**
     * 删除操作
     * @param $id
     */
    public function do_del($id){
        $result = $this->infoLogic->delInfo($id);

        $this->ajaxAuto($result,'删除');
    }

}
