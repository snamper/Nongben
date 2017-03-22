<?php
namespace Webmall\Controller;

class ApiController extends BaseController {

    /**
     * @var \Webmall\Logic\userLogic
     */
    protected $userLogic;
    public function _initialize()
    {
        $this->userLogic = D('User','Logic');
    }

    /**
     * 用户注册
     */
    public function register(){
        $data = $this->getAvailableData();

        //检查是否被注册
        if($this->userLogic->checkUsername($data['username'])){
            $this->ajaxError('regEmailExist');
        }
        $res = $this->userLogic->register($data);
        $this->ajaxAuto($res,'注册');
    }

    /**
     * 用户登陆
     */
    public function login(){
        $data = $this->getAvailableData();

        $formDataNot = $this->userLogic->checkUsername($data['username']);
        if(!$formDataNot){
            $this->ajaxError('formDataNot');
        }

        $res = $this->userLogic->login($data);
        if(!$res){
            $this->ajaxError('false');
        }else{
            $this->ajaxSuccess($res);
        }
    }
}