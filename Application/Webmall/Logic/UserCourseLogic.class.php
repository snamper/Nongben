<?php

namespace Webmall\Logic;

class UserCourseLogic extends BaseLogic{

    /**
     * @var \Webmall\Data\UserCourseData
     */
    protected $userCourseData;

    public function _initialize(){
        $this->userCourseData = D('UserCourse', 'Data');
    }

    /**
     * 获取单条数据
     * @param $id
     * @return mixed
     */
    public function getById($id){
        return $this->userCourseData->getById($id);
    }

    /**
     * 获取单条数据
     * @param $id
     * @param $user_id
     * @return mixed
     */
    public function getTime($id,$user_id){
        return $this->userCourseData->getTime($id,$user_id);
    }

    /**
     * 获取数据by user_id
     * @param $id
     * @return mixed
     */
    public function getByUserId($id){
        return $this->userCourseData->getByUserId($id);
    }

    /**
     * 获取单条数据
     * @param $id
     * @return mixed
     */
    public function getRelByCourseId($id){
        return $this->userCourseData->getRelByCourseId($id);
    }

    /**
     * 获取用户相关的课程信息
     * @param $conditions
     * @return mixed
     */
    public function getListByUser($conditions){
        return $this->userCourseData->getListByUser($conditions);
    }

    /**
     * 是否存在这条记录
     * @param $course_id
     * @param $user_id
     * @return mixed
     */
    public function is_exist($course_id,$user_id){
        return $this->userCourseData->is_exist($course_id,$user_id);
    }

    /**
     * 保存数据
     * @param $data
     * @return bool|mixed
     */
    public function saveUserCourse($data){
        $UserCourse = D('UserCourse');
        if($UserCourse->create($data)){
            return $UserCourse->add();
        }else{
            return false;
        }

    }

    /**
     * 修改数据
     * @param $data
     * @return bool
     */
    public function editUserCourse($data){
        $UserCourse = D('UserCourse');
        if($UserCourse->create($data)){
            return $UserCourse->save();
        }else{
            return false;
        }
    }

    /**
     * 删除数据
     * @param $id
     * @return mixed
     */
    public function delUserCourse($id){
        $Course = D('UserCourse');

        return $Course->where('course_id = %d',$id)->setField('status',CourseStatusEnum::DELETE);
    }

}