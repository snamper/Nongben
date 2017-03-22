<?php

namespace Webmall\Data;

class UserCourseData extends BaseData{

    //定义表前缀
    protected $tablePrefix = 'st_academy_';

    /**
     * 获取查询条件
     * @param $conditions
     * @return array
     */
    public function getCondition($conditions){
        $where = array();
        if(isset($conditions['id']) && !empty($conditions['id'])){
            $where['user_course.user_id'] = array('EQ' ,$conditions['id']);
        }
        if(isset($conditions['status']) && !empty($conditions['status'])){
            $where['user_course.status'] = array('EQ', $conditions['status']);
        }
        return $where;
    }

    /**
     * 单条记录查找
     * @param $id
     * @return mixed
     */
    public function getById($id){
        $data = $this->table('__USER_COURSE__ AS user_course')
            ->field('user_course.*')
            ->where('id=%d',$id)
            ->find();
        return $data;
    }

    public function getTime($id,$user_id){
        $data = $this->table('__USER_COURSE__ AS user_course')
            ->field('user_course.*')
            ->where('course_id = %d AND user_id = %d',$id,$user_id)
            ->find();
        return $data;
    }

    public function getRelByCourseId($id){
        $data = $this->table('__USER_COURSE__ AS user_course')
            ->field('user_course.relationship')
            ->where('course_id=%d',$id)
            ->find();

        return $data['relationship'];
    }

    /**
     * 按user_id查找
     * @param $id
     * @return mixed
     */
    public function getByUserId($id){

        $data = $this->table('__USER_COURSE__ AS user_course')
            ->field('course.*,file.path as img_path')
            ->join('__COURSE__ AS course ON course.id = user_course.course_id','left')
            ->join(C('DB_PREFIX_COMMON').'file AS file ON file.id = course.image','left')
            ->where('user_id=%d',$id)
            ->select();

        return $data;
    }

    /**
     * 获取课程（已完成/待继续）
     * @param $conditions
     * @return mixed
     */
    public function getListByUser($conditions){
        $where = $this->getCondition($conditions);

        $data = $this->table('__USER_COURSE__ AS user_course')
            ->field('course.id,course.name,course.type,course.learned_count,course.comment_count,teacher.name as teacher_name,file.path,user_course.relationship')
            ->join('__COURSE__ AS course ON course.id = user_course.course_id','LEFT')
            ->join(C('DB_PREFIX_COMMON') . 'file AS file ON file.id = course.image','LEFT')
            ->join('__TEACHER__ AS teacher ON teacher.id = course.teacher_id','LEFT')
            ->where($where)
            ->select();

        return $data;
    }

    /**
     * 判断是否存在这条记录
     * @param $course_id
     * @param $user_id
     * @return bool|mixed
     */
    public function is_exist($course_id,$user_id){

        $data = $this->table('__USER_COURSE__ AS user_course')
            ->where('user_id = %d and course_id=%d',$user_id,$course_id)
            ->find();
        if(!empty($data)){
            return $data;
        }else{
            return false;
        }
    }
}