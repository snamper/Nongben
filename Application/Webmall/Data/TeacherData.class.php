<?php
namespace Academy\Data;

class TeacherData extends BaseData{
    protected $tablePrefix="st_academy_";

    /**
     * 获取查询条件
     * @param $conditions
     * @return array
     */
    public function getCondition($conditions){
        $where = array();
        return $where;
    }

    public function getTeacherInfo($id){
        $data = $this->table('__TEACHER__ AS teacher')
            ->field('teacher.*,file.path AS avatar_path')
            ->join(C('DB_PREFIX_COMMON') . 'file AS file ON file.id = teacher.avatar','LEFT')
            ->where('teacher.id = %d',$id)
            ->find();

        return $data;
    }
}