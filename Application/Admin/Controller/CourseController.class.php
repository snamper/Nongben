<?php

namespace Admin\Controller;

class CourseController extends BaseController{

    /**
     * @var \Admin\Logic\CourseLogic
     * @var \Admin\Logic\CategoryLogic
     */
    protected $courseLogic;
    protected $categoryLogic;

    public function _initialize(){
        $this->courseLogic = D('Course', 'Logic');
        $this->categoryLogic = D('Category','Logic');
    }

    /**
     * 数据列表
     */
    public function index(){
        $courseList = $this->courseLogic->getList();

        $this->assign("list",$courseList);
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
        $course = $this->courseLogic->getById($id);
        $category = $this->categoryLogic->getCategoryString($course['category_id']);

        $this->assign("category",$category);
        $this->assign("course",$course);
        $this->display();
    }

    /**
     * 添加操作
     */
    public function do_add(){
        $data = $this->getAvailableData();
        $courseFlag = $this->courseLogic->saveCourse($data);

        $this->ajaxSuccess($courseFlag,'添加成功',U('index'));

    }

    /**
     * 编辑操作
     */
    public function do_edit(){
        $data = $this->getAvailableData();
        $result = $this->courseLogic->editCourse($data);

        $this->ajaxSuccess($result,'修改成功', U('index'));
    }

    /**
     * 删除操作
     */
    public function do_del($id){
        $courseFlag = $this->courseLogic->delCourse($id);
        $this->ajaxSuccess($courseFlag,'删除成功');
    }
}
