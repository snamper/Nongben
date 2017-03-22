<?php

namespace Admin\Controller;


class CategoryController extends BaseController{

    /**
     * @var \Admin\Logic\CategoryLogic
     */
    protected $categoryLogic;

    public function _initialize(){
        $this->categoryLogic = D('Category', 'Logic');
    }

    /**
     * 数据列表
     */
    public function index(){
        $conditions = $this->getAvailableData();

        $categoryList = $this->categoryLogic->getList($conditions);

        if(isset($conditions['parent'])){
            $category = $this->categoryLogic->getById($conditions['parent']);
            $this->assign('category',$category);
        }


        $this->assign("list",$categoryList);
        $this->assign("params",$conditions);
        $this->display();
    }

    /**
     * 添加视图
     */
    public function add($parent = 0){

        if($parent){
            $category = $this->categoryLogic->getById($parent);
            $this->assign('category',$category);
        }
        $this->assign("parent",$parent);
        $this->display();
    }

    /**
     * 编辑视图
     */
    public function edit($id){
        $category = $this->categoryLogic->getById($id);

        $this->assign("category",$category);
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
        $result = $this->categoryLogic->saveCategory($data);

        $this->ajaxAuto($result,'添加',U('category/index'));
    }

    /**
     * 编辑操作
     */
    public function do_edit(){
        $data = $this->getAvailableData();
        if(empty($data['sort'])){
            $data['sort'] = 1;
        }
        $result = $this->categoryLogic->editCategory($data);

        $this->ajaxAuto($result,'修改');
    }

    /**
     * 删除操作
     */
    public function do_del($id){
        $result = $this->categoryLogic->delCategory($id);

        $this->ajaxAuto($result,'删除');
    }

    /**
     * 多条记录查询(select联动选择)
     */
    public function get_category_list(){
        $id = I('id');
        if(!isset($id) || empty($id)){
            $conditions['parent'] = 0;
            $conditions['grade'] = 1;
        }else{
            $conditions['parent'] = $id;
        }

        $data = $this->categoryLogic->getCategoryList($conditions);
        $this->ajaxReturn($data);
    }

}
