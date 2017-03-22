<?php

namespace Webmall\Data;

class UserData extends BaseData{

    //定义表前缀
    protected $tablePrefix = 'st_common_';

    public function getCondition($conditions){
        $where = array();

        if(isset($conditions['username']) && !empty($conditions['username'])){
            $where['user.username'] = array('EQ',$conditions['username']);
        }
        if(isset($conditions['password']) && !empty($conditions['password'])){
            $where['user.password'] = array('EQ',$conditions['password']);
        }
        return $where;
    }
    /**
     * 登陆
     * @param $conditions
     * @return bool
     */
    public function login($conditions){
        $where = $this->getCondition($conditions);
        return $this->table('__USER__ AS user')
                ->where($where)
                ->find();
    }

    public function checkUsername($username){
        return $this->table('__USER__ AS user')
            ->where("username = '%s'",$username)
            ->find();
    }

    public function getById($id){
        return $this->table('__USER__ AS user')
            ->where("id = %d",$id)
            ->find();
    }
}