<?php

namespace Academy\Data;

class MyCourseData extends BaseData{

    //定义表前缀
    protected $tablePrefix = 'st_academy_';


    /**
     * 单条记录查找
     * @param $id
     * @return mixed
     */
    public function getById($id){
        $data = $this->table('__MY_COURSE__ AS my_course')
            ->field('my_course.*')
            ->where('id=%d',$id)
            ->find();
        return $data;
    }

    /**
     * 课程与用户的关系
     * @param $course_id
     * @param $user_id
     * @return mixed
     */
    public function getRel($course_id,$user_id){
        $data = $this->table('__MY_COURSE__ AS my_course')
            ->field('my_course.relationship')
            ->where('course_id=%d AND user_id=%d',$course_id,$user_id)
            ->find();

        if(!empty($data)){
            return $data['relationship'];
        }else{
            return 3;
        }
    }

    /**
     * 按user_id查找
     * @param $id
     * @return mixed
     */
    public function getByUserId($id){

        $data = $this->table('__MY_COURSE__ AS my_course')
            ->field('my_course.*')
            ->where('user_id=%d',$id)
            ->select();

        return $data;
    }

}