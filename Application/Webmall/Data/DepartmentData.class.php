<?php

namespace Academy\Data;

class DepartmentData extends BaseData{

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
            $where['department.id'] = array('EQ', $conditions['id']);
        }
        if (isset($conditions['parent']) && !empty($conditions['parent'])) {
            $where['department.parent'] = array('EQ', $conditions['parent']);
        }else{
            $where['department.parent'] = array('EQ', 0);
        }
        if (isset($conditions['path']) && !empty($conditions['path'])) {
            $where['department.path'] = array('EQ', $conditions['path']);
        }
        if (isset($conditions['grade']) && !empty($conditions['grade'])) {
            $where['department.grade'] = array('EQ', $conditions['grade']);
        }
        if (isset($conditions['name']) && !empty($conditions['name'])) {
            $where['department.name'] = array('LIKE', '%'. $conditions['name'] .'%');
        }
        if (isset($conditions['code']) && !empty($conditions['code'])) {
            $where['department.code'] = array('EQ', $conditions['code']);
        }
        if (isset($conditions['status']) && !empty($conditions['status'])) {
            $where['department.status'] = array('EQ', $conditions['status']);
        }
        if (isset($conditions['sort']) && !empty($conditions['sort'])) {
            $where['department.sort'] = array('EQ', $conditions['sort']);
        }
        if (isset($conditions['has_children']) && !empty($conditions['has_children'])) {
            $where['department.has_children'] = array('EQ', $conditions['has_children']);
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
        return $this->table('__DEPARTMENT__ AS department')
            ->field('department.*')
            ->where('id=%d',$id)
            ->find();
    }

    /**
     * 多条记录查找
     * @param $conditions
     * @param $pagePara
     * @return mixed
     */
    public function getList($conditions,$pagePara){
        $where = $this->getCondition($conditions);

        $data = $this->table('__DEPARTMENT__ AS department')
            ->field('department.*')
            ->where($where)
            ->page($pagePara->pageIndex, $pagePara->pageSize)
            ->selectPage();

        return $data;
    }

    /**
     * 多条记录查询(不分页)
     * @param $conditions
     * @return mixed
     */
    public function getDepartmentList($conditions){
        $where = $this->getCondition($conditions);

        $data = $this->table('__DEPARTMENT__ AS department')
            ->field('department.id, department.name')
            ->where($where)
            ->select();

        return $data;
    }

    public function getDepartmentArr($department_id){
        $data = $this->table('__DEPARTMENT__ AS department')
            ->field('department.id')
            ->where('parent=%d or id=%d',$department_id,$department_id)
            ->select();
        return $data;
    }
}