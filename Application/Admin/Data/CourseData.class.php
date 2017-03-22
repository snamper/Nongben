<?php

namespace Admin\Data;

class CourseData extends BaseData{

    //定义表前缀
    protected $tablePrefix = 'st_academy_'; 
    
    /**
     * 获取查询条件
     * @param $conditions
     * @return array
     */
    public function getCondition($conditions){
        $where = array();
        
        if (isset($conditions['id']) && !empty($conditions['id'])) {
            $where['course.id'] = array('EQ', $conditions['id']);
        }
        if (isset($conditions['name']) && !empty($conditions['name'])) {
            $where['course.name'] = array('LIKE', '%'.$conditions['name'].'%');
        }
        if (isset($conditions['category']) && !empty($conditions['category'])) {
            $where['category.name   '] = array('LIKE', '%'.$conditions['category'].'%');
        }
        if (isset($conditions['type']) && !empty($conditions['type'])) {
            $where['course.type'] = array('EQ', $conditions['type']);
        }
        if (isset($conditions['is_recommend']) && $conditions['is_recommend'] != null) {
            $where['course.is_recommend'] = array('EQ', $conditions['is_recommend']);
        }
        if (isset($conditions['teacher_id']) && !empty($conditions['teacher_id'])) {
            $where['course.teacher_id'] = array('EQ', $conditions['teacher_id']);
        }
        if (isset($conditions['status']) && !empty($conditions['status'])) {
            $where['course.status'] = array('EQ', $conditions['status']);
        }
        if ((isset($conditions['gmt_start']) && !empty($conditions['gmt_start']))||(isset($conditions['gmt_end']) && !empty($conditions['gmt_end']))) {
            if(!empty($conditions['gmt_start']) && empty($conditions['gmt_end'])){
                $where['course.gmt_create'] = array('EGT', $conditions['gmt_start']);
            }elseif(empty($conditions['gmt_start']) && !empty($conditions['gmt_end'])){
                $where['course.gmt_create'] = array('ELT', $conditions['gmt_end'].' 23:59:59');
            }else{
                $where['course.gmt_create'] = array('BETWEEN', [$conditions['gmt_start'],$conditions['gmt_end'].' 23:59:59']);
            }
        }
        return $where;
    }

    /**
     * 单条记录查找
     * @param $id
     * @return mixed
     */
    public function getById($id){
        return $this->table('__COURSE__ AS course')
                    ->field('course.*,file_img.path as path_img,file_video.path as path_video,category.name as category_name')
                    ->join(C('DB_PREFIX_COMMON') . 'file AS file_img ON file_img.id = course.image','LEFT')
                    ->join(C('DB_PREFIX_COMMON') . 'file AS file_video ON file_video.id = course.video','LEFT')
                    ->join('__CATEGORY__ AS category ON category.id = course.category_id','LEFT')
                    ->where('course.id=%d',$id)
                    ->find();
    }

    /**
     * 多条记录查找
     * @return mixed
     */
    public function getList(){

        $data = $this->table('__COURSE__ AS course')
            ->field('course.*,file_img.path as path_img,file_video.path as path_video,category.name as category_name')
            ->join(C('DB_PREFIX_COMMON') . 'file AS file_img ON file_img.id = course.image','LEFT')
            ->join(C('DB_PREFIX_COMMON') . 'file AS file_video ON file_video.id = course.video','LEFT')
            ->join('__CATEGORY__ AS category ON category.id = course.category_id','LEFT')
            ->order('gmt_create asc')
            ->select();

        return $data;
    }

    public function getByCat($id){
        return $this->table('__COURSE__ AS course')
            ->field('course.*')
            ->where('course.category_id = %d AND status != 99',$id)
            ->find();
    }

    public function getCatList(){
        return $this->table('__COURSE__ AS course')
            ->field('course.category_id')
            ->group('category_id')
            ->select();
    }

    public function getListByCat($id){
        return $this->table('__COURSE__ AS course')
            ->field('course.name,course.id')
            ->where('category_id = %d',$id)
            ->select();
    }

    public function getByTeacherId($id){
        return $this->table('__COURSE__ AS course')
            ->field('course.*')
            ->where('teacher_id = %d',$id)
            ->select();
    }
}