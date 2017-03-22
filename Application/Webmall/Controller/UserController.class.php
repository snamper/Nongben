<?php
namespace Webmall\Controller;

class UserController extends BaseController {

    /**
     * @var \Webmall\Logic\userLogic
     */
    protected $userLogic;
    public function _initialize()
    {
        $this->userLogic = D('User','Logic');
    }

    /**
     * 用户登陆
     */
    public function login(){
        $this->display();
    }

    public function userLogin(){
        $data = $this->getAvailableData();
        $res = $this->userLogic->login($data);
        $this->ajaxAuto($res,'登陆');
    }

    /**
     * 注销
     */
    public function logout(){
        if(user_is_login()){
            $this->userLogic->logout();
            session('[destroy]');
            $this->redirect('Academy/index');
        } else {
            $this->redirect('Academy/index');
        }
    }
}