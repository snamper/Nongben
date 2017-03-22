<?php

namespace Admin\Logic;

class UserCourseLogic extends BaseLogic{

    /**
     * @var \Admin\Data\UserCourseData
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
     *
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

    public function deleteUserCourse($userId){
        $UserCourse = D('UserCourse');
        return $UserCourse->where('user_id = %d',$userId)->delete();
    }

    /**
     * 添加数据
     * @param $data
     * @param $userId
     * @return bool
     */
    public function saveUserCourse($data,$userId){
        $UserCourse = D('UserCourse');
        $map = array();
        foreach($data['course'] as $key=>$val){
            $map[] = array(
                'user_id'  =>  $userId,
                'relationship' => $data['relationship'][$key],
                'course_id'  =>  $val
            );
        }
        if(empty($map)){
            return false;
        }else{
            $UserCourse->addAll($map);
            return $UserCourse->where('user_id = %d',$userId)->count('id');
        }
    }

    /**
     * 修改数据
     * @param $data
     * @param $userId
     * @return bool
     */
    public function editUserCourse($data,$userId){
        $UserCourse = D('UserCourse');
        $this->deleteUserCourse($userId);
        $map = array();
        foreach($data['course'] as $key=>$val){
            $map[] = array(
                'user_id'  =>  $userId,
                'relationship' => $data['relationship'][$key],
                'course_id'  =>  $val
            );
        }
        if(empty($map)){
            return false;
        }else{
            return $UserCourse->addAll($map);
        }
    }

    /**
     * 删除数据
     * @param $id
     * @return mixed
     */
    public function delUserCourse($id){
        $UserCourse = D('UserCourse');

        return $UserCourse->delete($id);
    }
}