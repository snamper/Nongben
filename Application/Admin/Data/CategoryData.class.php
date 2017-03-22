<?php

namespace Admin\Data;

class CategoryData extends BaseData{

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
            $where['category.id'] = array('EQ', $conditions['id']);
        }
        if (isset($conditions['parent']) && !empty($conditions['parent'])) {
            $where['category.parent'] = array('EQ', $conditions['parent']);
        }else{
            $where['category.parent'] = array('EQ', 0);
        }
        if (isset($conditions['path']) && !empty($conditions['path'])) {
            $where['category.path'] = array('EQ', $conditions['path']);
        }
        if (isset($conditions['grade']) && !empty($conditions['grade'])) {
            $where['category.grade'] = array('EQ', $conditions['grade']);
        }
        if (isset($conditions['name']) && !empty($conditions['name'])) {
            $where['category.name'] = array('LIKE', '%'. $conditions['name'] .'%');
        }
        if (isset($conditions['code']) && !empty($conditions['code'])) {
            $where['category.code'] = array('EQ', $conditions['code']);
        }
        if (isset($conditions['sort']) && !empty($conditions['sort'])) {
            $where['category.sort'] = array('EQ', $conditions['sort']);
        }

        return $where;
    }

    /**
     * 单条记录查找
     * @param $id
     * @return mixed
     */
    public function getById($id){
        return $this->table('__CATEGORY__ AS category')
                    ->field('category.*')
                    ->where('id=%d',$id)
                    ->find();
    }

    /**
     * 多条记录查找
     * @param $conditions
     * @return mixed
     */
    public function getList($conditions){

        $where = $this->getCondition($conditions);

        $data = $this->table('__CATEGORY__ AS category')
            ->field('category.*')
            ->where($where)
            ->select();

        return $data;
    }

    /**
     * 根据路径查找记录
     * @param $path
     * @return mixed
     */
    public function getListByPath($path){
        $condition['path'] = array('like',$path.'_%');
        $data = $this->table('__CATEGORY__ AS category')
            ->field('category.id,category.name')
            ->where($condition)
            ->order('path asc')
            ->find();

        return $data;

    }

    public function getCategoryList($conditions){
        $where = $this->getCondition($conditions);

        $data = $this->table('__CATEGORY__ AS category')
            ->field('id,name')
            ->where($where)
            ->select();

        return $data;
    }
}