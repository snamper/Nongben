<?php

namespace Admin\Controller;

class UserController extends BaseController{


    /**
     * @var \Admin\Logic\UserLogic
     */
    protected $userLogic;

    public function _initialize(){
        $this->userLogic = D('User', 'Logic');
    }

    /**
     * 数据列表
     */
    public function index(){
        $conditions = $this->getAvailableData();
        $userList = $this->userLogic->getList($conditions);

        $this->assign("list",$userList);
        $this->display();
    }

    /**
     * 删除操作
     */
    public function do_del($id){
        $result = $this->userLogic->delUser($id);

        $this->ajaxAuto($result,'删除');
    }

}
