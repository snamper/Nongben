<?php

namespace Admin\Data;

class CommentData extends BaseData{

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
            $where['comment.id'] = array('EQ', $conditions['id']);
        }
        if (isset($conditions['type']) && !empty($conditions['type'])) {
            $where['comment.type'] = array('EQ', $conditions['type']);
        }
        if (isset($conditions['be_comment_id']) && !empty($conditions['be_comment_id'])) {
            $where['comment.be_comment_id'] = array('EQ', $conditions['be_comment_id']);
        }
        if (isset($conditions['comment']) && !empty($conditions['comment'])) {
            $where['comment.comment'] = array('LIKE', '%'.$conditions['comment'].'%');
        }
        if (isset($conditions['name']) && !empty($conditions['name'])) {
            $where['user.name'] = array('LIKE', '%'.$conditions['name'].'%');
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
        return $this->table('__COMMENT__ AS comment')
                    ->field('comment.*')
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

        $data = $this->table('__COMMENT__ AS comment')
            ->field('comment.*,user.name as name')
            ->join(C('DB_PREFIX_COMMON').'user as user on user.id = comment.user_id', 'LEFT')
            ->where($where)
            ->page($pagePara->pageIndex, $pagePara->pageSize)
            ->selectPage();

        return $data;
    }

    /**
     * 多条记录查找(不分页)
     * @param $id
     * @return mixed
     */
    public function getCommentList($id){
        $data['items'] = $this->table('__COMMENT__ AS comment')
            ->field('comment.*, user.username as name')
            ->join(C('DB_PREFIX_COMMON').'user as user on user.id = comment.user_id', 'LEFT')
            ->where('comment.be_comment_id = %d',$id)
            ->order('comment.gmt_create asc')
            ->select();

        $data['comment_count'] = $this->table('__COMMENT__ AS comment')
            ->where('comment.be_comment_id = %d',$id)
            ->Count('id');

        return $data;
    }

}