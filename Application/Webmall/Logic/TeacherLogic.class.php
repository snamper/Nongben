<?php

namespace Academy\Logic;

class TeacherLogic extends BaseLogic{

    /**
     * @var \Academy\Data\TeacherData
     */
    protected $teacherData;

    public function _initialize(){
        $this->teacherData = D('Teacher', 'Data');
    }

    /**
     * 获取教师信息
     * @param $id
     * @return mixed
     */
    public function getTeacherInfo($id){
        return $this->teacherData->getTeacherInfo($id);
    }

    /**
     * 某字段+1
     * @param $id
     * @param $field
     * @return bool
     */
    public function setInc($id,$field){
        $Teacher = D('Teacher');
        return $Teacher->where('id = %d',$id)->setInc($field,1);
    }
}