<?php

namespace Admin\Data;

class FileData extends BaseData{

    //定义表前缀
    protected $tablePrefix = 'st_common_';
    
    /**
     * 获取查询条件
     * @param $conditions
     * @return array
     */
    public function getCondition($conditions){
        $where = array();
        
        if (isset($conditions['id']) && !empty($conditions['id'])) {
            $where['file.id'] = array('EQ', $conditions['id']);
        }
        if (isset($conditions['path']) && !empty($conditions['path'])) {
            $where['file.path'] = array('EQ', $conditions['path']);
        }
        if (isset($conditions['status']) && !empty($conditions['status'])) {
            $where['file.status'] = array('EQ', $conditions['status']);
        }
        if (isset($conditions['type']) && !empty($conditions['type'])) {
            $where['file.type'] = array('EQ', $conditions['type']);
        }
        if (isset($conditions['gmt_create']) && !empty($conditions['gmt_create'])) {
            $where['file.gmt_create'] = array('EQ', $conditions['gmt_create']);
        }
        if (isset($conditions['note']) && !empty($conditions['note'])) {
            $where['file.note'] = array('EQ', $conditions['note']);
        }
        return $where;
    }

    /**
     * 单条记录查找
     * @param $id
     * @return mixed
     */
    public function getById($id){
        return $this->table('__FILE__ AS file')
                    ->field('file.*')
                    ->where('id=%d',$id)
                    ->find();
    }

    /**
     * 多条记录查找
     * @param $conditions
     * @param $pageBounds
     * @return mixed
     */
    public function getList($conditions,$pagePara){

        $where = $this->getCondition($conditions);

        $data = $this->table('__FILE__ AS file')
            ->field('file.*')
            ->where($where)
            ->page($pagePara->pageIndex, $pagePara->pageSize)
            ->selectPage();

        return $data;
    }
}