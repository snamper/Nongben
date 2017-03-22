<?php

namespace Admin\Logic;

class CourseLogic extends BaseLogic{

    /**
     * @var \Admin\Data\CourseData
     */
    protected $courseData;

    public function _initialize(){
        $this->courseData = D('Course', 'Data');
    }

    /**
     * 获取单条数据
     * @param $id
     * @return mixed
     */
    public function getById($id){
        return $this->courseData->getById($id);
    }
    public function getByCat($id){
        return $this->courseData->getByCat($id);
    }

    /**
     * 获取多条数据
     * @return mixed
     */
    public function getList(){
        return $this->courseData->getList();
    }
    public function getCatList(){
        return $this->courseData->getCatList();
    }
    public function getListByCat($id){
        return $this->courseData->getListByCat($id);
    }
    public function getByTeacherId($id){
        return $this->courseData->getByTeacherId($id);
    }

    /**
     * 添加数据
     * @param $data
     * @return bool
     */
    public function saveCourse($data){

        $Course = D('Course');

        if($Course->create($data)){
            return $Course->add();
        }else{
            return false;
        }
    }

    /**
     * 修改数据
     * @param $data
     * @return bool
     */
    public function editCourse($data){
        $Course = D('Course');

        if($Course->create($data)){
            return $Course->save();
        }else{
            return false;
        }
    }

    /**
     * 删除数据
     * @param $id
     * @return mixed
     */
    public function delCourse($id){
        $Course = D('Course');

        return $Course->where('id = %d',$id)->delete();
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
}