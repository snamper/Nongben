<?php

namespace Academy\Data;

class UserLikeData extends BaseData{

    //定义表前缀
    protected $tablePrefix = 'st_academy_';

    /**
     * 是否点赞
     * @param $course_id
     * @param $user_id
     * @return bool
     */
    public function isLike($course_id,$user_id){
        $data = $this->table('__USER_LIKE__ AS user_like')                  //不能用like
            ->where('course_id = %d AND user_id = %d',$course_id,$user_id)
            ->find();

        if(!empty($data)){
            return true;
        }else{
            return false;
        }
    }
}