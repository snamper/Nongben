<?php

namespace Admin\Controller;

class FileController extends BaseController{


    /**
     * @var \Admin\Logic\FileLogic
     */
    protected $fileLogic;

    public function _initialize(){
        $this->fileLogic = D('File', 'Logic');
    }

    /**
     * 数据列表
     */
    public function index(){
        $conditions = $this->getAvailableData();
        $pagePara = get_page_para();
        $fileList = $this->fileLogic->getList($conditions,$pagePara);

        $this->assign("list",$fileList['items']);
        $this->assign("pager",$fileList['pager']);
        $this->assign("params",$conditions);
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
        $file = $this->fileLogic->getById($id);

        $this->assign("file",$file);
        $this->display();
    }

    /**
     * 查看视图
     */
    public function detail($id){
        $file = $this->fileLogic->getById($id);

        $this->assign("file",$file);
        $this->display();
    }

    /**
     * 添加操作
     */
    public function do_add(){
        $data = $this->getAvailableData();
        $result = $this->fileLogic->saveFile($data);

        $this->ajaxAuto($result,'添加');
    }

    /**
     * 编辑操作
     */
    public function do_edit(){
        $data = $this->getAvailableData();
        $result = $this->fileLogic->editFile($data);

        $this->ajaxAuto($result,'修改');
    }

    /**
     * 删除操作
     */
    public function do_del($id){
        $result = $this->fileLogic->delFile($id);

        $this->ajaxAuto($result,'删除');
    }
}
