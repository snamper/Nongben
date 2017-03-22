<?php

namespace Academy\Logic;


class UserLikeLogic extends BaseLogic{

    /**
     * @var \Academy\Data\UserLikeData
     */
    protected $userLikeData;

    public function _initialize(){
        $this->userLikeData = D('UserLike', 'Data');
    }

    /**
     * 点赞/取消点赞
     * @param $type
     * @param $course_id
     * @param $user_id
     * @return bool|mixed
     */
    public function like($type,$course_id,$user_id){
        $like = D('UserLike');
        $type = trim($type);
        switch($type){
            case 'like':
                $data['course_id'] = $course_id;
                $data['user_id'] = $user_id;
                if($like->create($data)){
                    return $like->add();
                }else{
                    return false;
                }
            break;
            case 'cancel':
                return $like->where('course_id = %d and user_id=%d',$course_id,$user_id)->delete();
            break;
        }
    }

}