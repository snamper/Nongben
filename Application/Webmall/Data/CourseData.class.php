<?php

namespace Webmall\Data;

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

        if (isset($conditions['type']) && !empty($conditions['type'])) {
            $where['course.type'] = array('EQ', $conditions['type']);
        }
        if (isset($conditions['name']) && !empty($conditions['name'])){
            $map['course.name'] = array('LIKE', '%'.$conditions['name'].'%');
            $map['teacher.name'] = array('LIKE', '%'.$conditions['name'].'%');
            $map['_logic'] = 'or';
            $where['_complex'] = $map;
        }
        if (isset($conditions['is_recommend']) && !empty($conditions['is_recommend'])) {
            $where['course.is_recommend'] = array('EQ', 1);
        }else if(isset($conditions['category']) && !empty($conditions['category'])){
            $where['course.category_id'] = array('EQ', $conditions['category']);
        }
        return $where;
    }

    /**
     * 根据id获取课程
     * @param $id
     * @return mixed
     */
    public function getById($id){
        return $this->table('__COURSE__ AS course')
                    ->field('course.*,file_video.path as path_video')
                    ->join(C('DB_PREFIX_COMMON') . 'file AS file_img ON file_img.id = course.image','LEFT')
                    ->join(C('DB_PREFIX_COMMON') . 'file AS file_video ON file_video.id = course.video','LEFT')
                    ->join('__CATEGORY__ AS category ON category.id = course.category_id','LEFT')
                    ->where('course.id=%d',$id)
                    ->find();
    }

    /**
     * 获取课程数目
     * @param $conditions
     * @return mixed
     */
    public function getCount($conditions){
        return $this->table('__COURSE__ AS course')
            ->where('category_id = %d',$conditions)
            ->Count();
    }


    /**
     * 根据分类获取最新课程列表
     * @param $cat
     * @param $pagePara
     * @return mixed
     */
    public function getNewCourseByCat($cat, $pagePara){

        $data = $this->table('__COURSE__ AS course')
            ->field('course.id,course.name,course.learned_count,course.comment_count,course.teacher,file.path,course.description')
            ->join(C('DB_PREFIX_COMMON') . 'file AS file ON file.id = course.image','LEFT')
            ->where('course.category_id = %d',$cat)
            ->page($pagePara->pageIndex,$pagePara->pageSize)
            ->order('course.gmt_create desc')
            ->selectPage();

        $conditions['category'] = $cat;
        $data['count'] = $this->getCount($conditions);
        return $data;
    }

    /**
     * 根据分类获取热门课程列表
     * @param $cat
     * @param $pagePara
     * @return mixed
     */
    public function getHotCourseByCat($cat, $pagePara){

        $data = $this->table('__COURSE__ AS course')
            ->field('course.id,course.name,course.teacher,course.learned_count,course.comment_count,file.path,course.description')
            ->join(C('DB_PREFIX_COMMON') . 'file AS file ON file.id = course.image','LEFT')
            ->where('course.category_id = %d',$cat)
            ->page($pagePara->pageIndex,$pagePara->pageSize)
            ->order('course.learned_count desc,course.gmt_create desc')
            ->selectPage();

        $conditions['category'] = $cat;
        $data['count'] = $this->getCount($conditions);
        return $data;
    }

    /**
     * 获取最新推荐课程列表（4门）
     * @return mixed
     */
    public function getRecommendCourse(){
        $data = $this->table('__COURSE__ AS course')
            ->field('course.id,course.name,file.path')
            ->join(C('DB_PREFIX_COMMON') . 'file AS file ON file.id = course.image','LEFT')
            ->where('is_recommend = 1')
            ->order('course.gmt_create desc')
            ->limit(4)
            ->select();

        return $data;
    }

    /**
     * 获取最新课程（8门）
     * @return mixed
     */
    public function getNewCourse(){

        $data = $this->table('__COURSE__ AS course')
            ->field('course.id,course.name,file.path,course.teacher,course.learned_count,course.comment_count')
            ->join(C('DB_PREFIX_COMMON') . 'file AS file ON file.id = course.image','LEFT')
            ->where('is_recommend != 1')
            ->order('course.gmt_create desc')
            ->limit(8)
            ->select();

        return $data;
    }

    /**
     * 获取热门课程（8门）
     * @return mixed
     */
    public function getHotCourse(){

        $data = $this->table('__COURSE__ AS course')
            ->field('course.id,course.name,file.path,course.teacher,course.learned_count,course.comment_count')
            ->join(C('DB_PREFIX_COMMON') . 'file AS file ON file.id = course.image','LEFT')
            ->where('is_recommend != 1')
            ->order('course.learned_count desc')
            ->limit(8)
            ->select();

        return $data;
    }

    /**
     * 获取课程详情
     * @param $id
     * @return mixed
     */
    public function getCourseDetail($id){
        $data = $this->table('__COURSE__ AS course')
            ->field('course.id,course.name,course.teacher,course.learned_count,course.comment_count,course.description,file_img.path as img_path,category.name AS category_name')
            ->join(C('DB_PREFIX_COMMON') . 'file AS file_img ON file_img.id = course.image','LEFT')
            ->join('__CATEGORY__ AS category ON category.id = course.category_id','LEFT')
            ->where('course.id = %d',$id)
            ->find();
        return $data;
    }

}