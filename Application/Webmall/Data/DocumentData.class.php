<?php

namespace Academy\Data;

class DocumentData extends BaseData{

    //定义表前缀
    protected $tablePrefix = 'st_academy_'; 
    
    /**
     * 获取查询条件
     * @param $conditions
     * @return array
     */
    public function getCondition($conditions){
        $where = array();
        $where['document.status'] = array('EQ', 1);
        if (isset($conditions['type']) && !empty($conditions['type'])) {
            $where['document.type'] = array('EQ', $conditions['type']);
        }
        if (isset($conditions['category']) && !empty($conditions['category'])) {
            $where['document.category_id'] = array('EQ', $conditions['category']);
        }
        return $where;
    }


    /**
     * 获取文章数目
     * @param $conditions
     * @return mixed
     */
    public function getCount($conditions){
        $where = $this->getCondition($conditions);

        return $this->table('__DOCUMENT__ AS document')
            ->where($where)
            ->Count();
    }

    /**
     * 根据分类获取最新文章列表（分页）
     * @param $conditions
     * @param $pagePara
     * @return mixed
     */
    public function getNewDocumentByCat($conditions, $pagePara){
        $where = $this->getCondition($conditions);

        $data = $this->table('__DOCUMENT__ AS document')
            ->field('document.id,document.title,document.gmt_create,document.count')
            ->where($where)
            ->page($pagePara->pageIndex,$pagePara->pageSize)
            ->order('document.gmt_create desc')
            ->selectPage();

        return $data;
    }

    /**
     * 根据分类获取热门文章列表（分页）
     * @param $conditions
     * @param $pagePara
     * @return mixed
     */
    public function getHotDocumentByCat($conditions, $pagePara){
        $where = $this->getCondition($conditions);

        $data = $this->table('__DOCUMENT__ AS document')
            ->field('document.id,document.title,document.gmt_create,document.count')
            ->where($where)
            ->page($pagePara->pageIndex,$pagePara->pageSize)
            ->order('document.count desc')
            ->selectPage();

        return $data;
    }

    /**
     * 获取文章详情
     * @param $id
     * @return mixed
     */
    public function getDocumentDetail($id){
        $data = $this->table('__DOCUMENT__ AS document')
            ->field('document.*')
            ->where('document.id = %d',$id)
            ->find();
        $data['content'] = htmlspecialchars_decode($data['content']);

        return $data;
    }


}