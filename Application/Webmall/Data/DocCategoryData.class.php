<?php

namespace Academy\Data;

class DocCategoryData extends BaseData{

    //定义表前缀
    protected $tablePrefix = 'st_common_';
    
    /**
     * 获取查询条件
     * @param $conditions
     * @return array
     */
    public function getCondition($conditions){
        $where = array();
        return $where;
    }

    /**
     * 单条记录查找
     * @param $id
     * @return mixed
     */
    /*public function getById($id){
        return $this->table('__CATEGORY__ AS category')
                    ->field('category.*')
                    ->where('id=%d',$id)
                    ->find();
    }*/

    /**
     * 多条记录查找
     * @param $conditions
     * @param $pagePara
     * @return mixed
     */
    /*public function getList($conditions,$pagePara){
        $where = $this->getCondition($conditions);

        $data = $this->table('__CATEGORY__ AS category')
            ->field('category.*')
            ->where($where)
            ->page($pagePara->pageIndex, $pagePara->pageSize)
            ->selectPage();

        return $data;
    }*/

    /**
     * 多条记录查询(不分页)
     * @param $conditions
     * @return mixed
     */
    /*public function getCategoryList($conditions){
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
    }*/

    /**
     * 根据父级分类查找
     * @param $id
     * @return mixed
     */
    public function getByParent($id){
        $data = $this->table('__DOC_CATEGORY__ AS category')
            ->field('category.id,category.name')
            ->where('parent=%d AND status=1',$id)
            ->order('sort asc')
            ->select();
        return $data;
    }

    /**
     * 根据code查找
     * @param $code
     * @return mixed
     */
    public function getIdByCode($code){
        $data = $this->table('__DOC_CATEGORY__ AS category')
            ->field('category.id')
            ->where("code='%s'",$code)
            ->find();
        return $data['id'];
    }
}