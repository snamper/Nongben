<?php

namespace Webmall\Data;

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
        if (isset($conditions['status']) && !empty($conditions['status'])) {
            $where['category.status'] = array('EQ', $conditions['status']);
        }
        if (isset($conditions['sort']) && !empty($conditions['sort'])) {
            $where['category.sort'] = array('EQ', $conditions['sort']);
        }
        if (isset($conditions['has_children']) && !empty($conditions['has_children'])) {
            $where['category.has_children'] = array('EQ', $conditions['has_children']);
        }
        if (isset($conditions['type']) && !empty($conditions['type'])) {
            $where['category.type'] = array('EQ', $conditions['type']);
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
                    ->field('id,name')
                    ->where('id=%d',$id)
                    ->find();
    }

    /**
     * 根据父节点查找
     * @param $id
     * @return mixed
     */
    public function getByParent($id){
        $data = $this->table('__CATEGORY__ AS category')
            ->field('category.id,category.name')
            ->where('parent=%d',$id)
            ->order('sort asc')
            ->select();
        return $data;
    }


    /**
     * 多条记录查找
     * @param $conditions
     * @param $pagePara
     * @return mixed
     */
    public function getList($conditions,$pagePara){
        $where = $this->getCondition($conditions);

        $data = $this->table('__CATEGORY__ AS category')
            ->field('category.*')
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
    public function getCategoryList($conditions){
        $where = $this->getCondition($conditions);

        $data = $this->table('__CATEGORY__ AS category')
            ->field('category.id, category.name')
            ->where($where)
            ->select();

        return $data;
    }

    public function getCategoryArr($category_id){
        $data = $this->table('__CATEGORY__ AS category')
                ->field('category.id')
                ->where('parent=%d or id=%d',$category_id,$category_id)
                ->select();
        return $data;
    }
}