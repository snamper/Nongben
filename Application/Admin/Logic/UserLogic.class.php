<?php

namespace Admin\Logic;


class UserLogic extends BaseLogic{

    protected $userData;

    public function _initialize(){
        $this->userData = D('User', 'Data');
    }


    /**
     * 获取多条数据
     * @return mixed
     */
    public function getList(){
        return $this->userData->getList();
    }

    /**
     * 删除数据
     * @param $id
     * @return mixed
     */
    public function delUser($id){
        $User = D('User');

        return $User->delete($id);
    }

}