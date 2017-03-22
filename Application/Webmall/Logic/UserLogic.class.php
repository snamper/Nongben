<?php

namespace Webmall\Logic;


class UserLogic extends BaseLogic{

    /**
     * @var \Academy\Data\UserData
     */
    protected $userData;

    public function _initialize(){
        $this->userData = D('User', 'Data');
    }

    public function getById($id){
        return $this->userData->getById($id);
    }

    /**
     * 登陆
     * @param $conditions
     * @return bool
     */
    public function login($conditions){
        $res = $this->userData->login($conditions);
        if(!empty($res)){
            $this->autoLogin($res);
            return true;
        }else{
            return false;
        }
    }

    public function logout(){
        session('user_auth', null);
        session('user_auth_sign', null);
    }

    /**
     * 注册
     * @param $data
     */
    public function register($data){
        $res = $this->saveUser($data);
        if($res){
            $auth = array(
                'id'              => $res,
                'username'        => $data['username'],
                'gmt_login'  => $data['gmt_login'],
            );

            session('user_auth', $auth);
            session('user_auth_sign',data_auth_sign($auth));
        }
    }

    /**
     * 修改绑定邮箱
     * @param $data
     * @return bool
     */
    public function editEmail($data){
        $res = $this->userData->login($data);
        if(empty($res)){
            return 'errorPsw';
        }
        $res = $this->checkUsername($data['email']);
        if(empty($res)){
            return 'existEmail';
        }
        $data['username'] = $data['email'];
        $this->editUser($data);
    }

    /**
     * 保存用户
     * @param $data
     * @return bool
     */
    public function saveUser($data){
        $User = D('User');
        if($User->create($data)){
            return $User->add();
        }else{
            return false;
        }
    }

    /**
     * 重置密码
     * @param $data
     * @return bool
     */
    public function editUser($data){
        $User = D('User');
        if($User->create($data)){
            return $User->save();
        }else{
            return false;
        }
    }

    /**
     * 某字段+1
     * @param $id
     * @param $field
     * @return bool
     */
    public function setInc($id,$field){
        $Course = D('User');
        return $Course->where('id = %d',$id)->setInc($field,1);
    }

    /**
     * 检查用户名是否存在
     * @param $username
     * @return bool
     */
    public function checkUsername($username){
        if($this->userData->checkUsername($username)){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 设置缓存
     * @param $user
     */
    protected function autoLogin($user){
        $User = D('User');

        /* 更新登录信息 */
        $data = array(
            'id' => $user['id'],
            'gmt_login'  => get_date(),
            'login_count' => $user['login_count'] + 1,
        );

        $User->where('id = %d',$user['id'])->save($data);

        /* 记录登录SESSION和COOKIES */
        $auth = array(
            'id'              => $user['id'],
            'username'        => $user['username'],
            'gmt_login'  => $user['gmt_login'],
        );

        session('user_auth', $auth);
        session('user_auth_sign', data_auth_sign($auth));
    }
}