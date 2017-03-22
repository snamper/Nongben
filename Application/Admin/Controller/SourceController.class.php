<?php

namespace Admin\Controller;

class SourceController extends BaseController{


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
    public function index(){
        $sourceList = $this->sourceLogic->getList();

        $this->assign("list",$sourceList);
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
        $source = $this->sourceLogic->getById($id);
        $this->assign("source",$source);
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
        $result = $this->sourceLogic->saveSource($data);

        $this->ajaxAuto($result,'添加',U('Source/index'));
    }

    /**
     * 编辑操作
     */
    public function do_edit(){
        $data = $this->getAvailableData();
        if(empty($data['sort'])){
            $data['sort'] = 1;
        }
        $result = $this->sourceLogic->editSource($data);

        $this->ajaxAuto($result,'修改',U('source/index'));
    }

    /**
     * 删除操作
     */
    public function do_del($id){
        $result = $this->sourceLogic->delSource($id);

        $this->ajaxAuto($result,'删除');
    }
}
