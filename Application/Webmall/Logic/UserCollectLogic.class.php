<?php

namespace Webmall\Logic;


class UserCollectLogic extends BaseLogic{

    /**
     * @var \Academy\Data\UserCollectData
     */
    protected $userCollectData;

    public function _initialize(){
        $this->userCollectData = D('UserCollect', 'Data');
    }

    public function isCollect($course_id,$user_id){
        return $this->userCollectData->isCollect($course_id,$user_id);
    }

    /**
     * 获取用户收藏课程
     * @param $id
     * @return mixed
     */
    public function getByUserId($id){
        return $this->userCollectData->getByUserId($id);
    }

    /**
     * 收藏/取消收藏
     * @param $type
     * @param $course_id
     * @param $user_id
     * @return bool|mixed
     */
    public function collect($type,$course_id,$user_id){

        $type = trim($type);
        switch($type){
            case 'collect':
                $data['course_id'] = $course_id;
                $data['user_id'] = $user_id;
                //dump($data);
                $collectFlag = $this->saveCollect($data);
                if($collectFlag === false){
                    return false;
                }
                return 'collect';
            break;
            case 'cancel':
                $collectFlag = $this->delCollect($course_id,$user_id);
                if($collectFlag === false){
                    return false;
                }
                return 'cancel';
            break;
        }
    }

    /**
     * @param $data
     * @return bool|mixed
     */
    public function saveCollect($data){
        $collect = D('UserCollect');
        if($collect->create($data)){
            return $collect->add();
        }else{
            return false;
        }
    }

    /**
     * @param $course_id
     * @param $user_id
     * @return mixed
     */
    public function delCollect($course_id,$user_id){
        $collect = D('UserCollect');
        return $collect->where('course_id = %d and user_id=%d',$course_id,$user_id)
                    ->delete();
    }
}