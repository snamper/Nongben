<?php
namespace Webmall\Controller;

class PersonalController extends BaseController {

    /**
     * @var \Webmall\Logic\UserCourseLogic
     * @var \Webmall\Logic\UserCollectLogic
     * @var \Webmall\Logic\UserLogic
     */
    protected $userCourseLogic;
    protected $userCollectLogic;
    protected $userLogic;

    public function _initialize(){
        $this->userCourseLogic = D('UserCourse', 'Logic');
        $this->userCollectLogic = D('UserCollect', 'Logic');
        $this->userLogic = D('User', 'Logic');
    }

    /**
     * 学习记录
     */
    public function personal(){
        //学习记录
        $user_course_list = $this->userCourseLogic->getByUserId($this->user['id']);

        //dump($user_course_list);
        $this->assign('course',$user_course_list);
        $this->assign('user',$this->user['username']);
        $this->display();
    }

    /**
     * 用户收藏
     */
    public function collect(){
        $user_collect_list = $this->userCollectLogic->getByUserId($this->user['id']);

        $this->assign('course',$user_collect_list);
        $this->assign('user',$this->user['username']);
        $this->display();
    }

    /**
     * 系统消息
     */
    public function msg_sys(){
        $this->assign('user',$this->user);
        $this->display();
    }

    /**
     * 我的消息
     */
    public function msg_my(){
        $this->assign('user',$this->user);
        $this->display();
    }

    /**
     *个人信息
     */
    public function info(){
        $this->assign('user',$this->user);
        $this->display();
    }

    /**
     * 修改个人信息
     */
    public function editInfo(){
        $data = $this->getAvailableData();

        $res = $this->userLogic->editUser($data);
        $this->ajaxAuto($res,'修改');
    }

    /**
     * 修改绑定邮箱
     */
    public function changeEmail(){
        $this->assign('user',$this->user);
        $this->display();
    }

    public function editEmail(){
        $data = $this->getAvailableData();

        $res = $this->userLogic->editEmail($data);
        if($res == 'existEmail'){
            $this->ajaxError('existEmail');
        }
        if($res == 'errorPsw'){
            $this->ajaxError('errorPsw');
        }
        $this->ajaxAuto($res,'修改');
    }

    /**
     * 学习统计
     */
    public function statistic(){
        $this->user['gmt_create'] = date('Y-m-d',time($this->user['gmt_create']));
        $this->assign('user',$this->user);
        $this->display();
    }

}