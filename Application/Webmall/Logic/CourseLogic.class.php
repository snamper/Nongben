<?php

namespace Webmall\Logic;

class CourseLogic extends BaseLogic{


    protected $courseData;
    protected $userCollectData;
    protected $userCourseLogic;
    protected $userLogic;

    public function _initialize(){
        $this->courseData = D('Course', 'Data');
        $this->userCollectData = D('UserCollect', 'Data');
        $this->userCourseLogic = D('UserCourse','Logic');
        $this->userLogic = D('User','Logic');
    }

    /**
     * 根据id获取课程
     * @param $id
     * @return mixed
     */
    public function getById($id){
        return $this->courseData->getById($id);
    }

    /**
     * 获取用户相关的课程信息
     * @param $conditions
     * @return mixed
     */
    public function getListByUser($conditions){
        return $this->userCourseLogic->getListByUser($conditions);
    }


    /**
     * 获取用户收藏的课程
     * @param $id
     * @return mixed
     */
    public function getCollectCourse($id){
        return $this->userCollectData->getCollectCourse($id);
    }

    /**
     * 根据分类获取最新课程（分页）
     * @param $cat
     * @param $pagePara
     * @return mixed
     */
    public function getNewCourseByCat($cat, $pagePara=null){
        return $this->courseData->getNewCourseByCat($cat, $pagePara);
    }

    /**
     * 根据分类获取热门课程（分页）
     * @param $cat
     * @param $pagePara
     * @return mixed
     */
    public function getHotCourseByCat($cat, $pagePara=null){
        return $this->courseData->getHotCourseByCat($cat, $pagePara);
    }

    /**
     * 获取推荐课程（4门）
     * @return mixed
     */
    public function getRecommendCourse(){
        return $this->courseData->getRecommendCourse();
    }

    /**
     * 获取最新课程（8门）
     * @param $conditions
     * @return mixed
     */
    public function getNewCourse($conditions){
        return $this->courseData->getNewCourse($conditions);
    }

    /**
     * 获取热门课程（8门）
     * @param $conditions
     * @return mixed
     */
    public function getHotCourse($conditions){
        return $this->courseData->getHotCourse($conditions);
    }

    /**
     * 获取课程数目
     * @param $conditions
     * @return mixed
     */
    public function getCount($conditions){
        return $this->courseData->getCount($conditions);
    }

    /**
     * 获取课程详情
     * @param $id
     * @return mixed
     */
    public function getCourseDetail($id, $user){
        $data = $this->courseData->getCourseDetail($id);
        if(!empty($user)) {
            $data['is_collect'] = $this->userCollectData->isCollect($id);
        }
        return $data;
    }

    /**
     * 获取该分类下的其它课程
     * @param $id
     * @param $user_id
     * @param $category
     * @param null $pagePara
     * @return mixed
     */
    public function getOtherCourse($id,$category,$pagePara = null,$user_id){
        return $this->courseData->getOtherCourse($id,$category,$pagePara,$user_id);
    }

    /**
     * 某字段+1
     * @param $id
     * @param $field
     * @return bool
     */
    public function setInc($id,$field){
        $Course = D('Course');
        return $Course->where('id = %d',$id)->setInc($field,1);
    }

    /**
     * 某字段-$count
     * @param $id
     * @param $field
     * @param int $count
     * @return bool
     */
    public function setDec($id,$field,$count = 1){
        $Course = D('Course');
        return $Course->where('id = %d',$id)->setDec($field,$count);
    }

    /**
     * 观看视频
     * @param $id
     * @param $user_id
     * @return bool
     */
    public function start($id,$user_id){
        //是否为待继续
        $flag = $this->userCourseLogic->is_exist($id, $user_id);
        //不是，添加数据，课程表learned_count
        if ($flag === false) {
            $data['course_id'] = $id;
            $data['user_id'] = $user_id;
            $this->userCourseLogic->saveUserCourse($data);
        }
        $this->setInc($id,'learned_count');
        $this->userLogic->setInc($user_id,'study_count');

        //查找课程信息
        return $this->getById($id);
    }
}