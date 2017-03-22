<?php

namespace Webmall\Data;

class UserCollectData extends BaseData{

    //定义表前缀
    protected $tablePrefix = 'st_academy_';

    /**
     * 获取收藏课程
     * @param $id
     * @return mixed
     */
    public function getByUserId($id){

        $data = $this->table('__USER_COLLECT__ AS collect')
            ->field('course.*,file.path as img_path')
            ->join('__COURSE__ AS course ON course.id = collect.course_id','LEFT')
            ->join(C('DB_PREFIX_COMMON') . 'file AS file ON file.id = course.image','LEFT')
            ->where('collect.user_id = %d',$id)
            ->select();

        return $data;
    }

    /**
     * 是否收藏
     * @param $course_id
     * @param $user_id
     * @return bool
     */
    public function isCollect($course_id,$user_id){
        if(empty($user_id)) {
            return false;
        }else {
            $data = $this->table('__USER_COLLECT__ AS collect')
                ->where('course_id = %d AND user_id = %d', $course_id, $user_id)
                ->find();
            if (!empty($data)) {
                return true;
            } else {
                return false;
            }
        }
    }
}