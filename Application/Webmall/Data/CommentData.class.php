<?php

namespace Webmall\Data;

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
        
        if (isset($conditions['be_comment_id']) && !empty($conditions['be_comment_id'])) {
            $where['comment.be_comment_id'] = array('EQ', $conditions['be_comment_id']);
        }
        if (isset($conditions['type']) && !empty($conditions['type'])) {
            $where['comment.type'] = array('EQ', $conditions['type']);
        }
        if (isset($conditions['parent'])) {
            $where['comment.parent'] = array('EQ', $conditions['parent']);
        }
        if (isset($conditions['status']) && !empty($conditions['status'])) {
            $where['comment.status'] = array('EQ', $conditions['status']);
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
     * 获取未读消息
     * @param $id
     * @param $status
     * @return mixed
     */
    public function getUnreadMessage($id,$status){
        $res = $this->table('__COMMENT__ AS comment')
                    ->field('comment.*,user.name,user.avatar')
                    ->join(C('DB_PREFIX_COMMON').'user as user on user.id = comment.user_id','LEFT')
                    ->where('comment.be_user_id = %d AND comment.status = %d',$id,$status)
                    ->order('comment.gmt_create desc')
                    ->select();

        foreach($res as $k=>$v){
            $data[$k]['comment'] = array(
                'id' => $v['id'],
                'comment' => $v['comment'],
                'user_id' => $v['user_id'],
                'gmt_create' =>$v['gmt_create'],
                'name' => $v['name'],
                'avatar' => $v['avatar'],
            );
            $data[$k]['be_comment'] = $this->table('__COMMENT__ AS comment')
                ->field('comment,id,user_id')
                ->where('id = %d',$v['parent'])
                ->find();
            if($v['type'] == 1){
                $data[$k]['source'] = $this->table('__COURSE__ AS course')
                                ->field('name,type as kind')
                                ->where('id = %d',$v['be_comment_id'])
                                ->find();
            }else{
                $data[$k]['source'] = $this->table('__DOCUMENT__ AS document')
                                ->field('title as name')
                                ->where('id = %d',$v['be_comment_id'])
                                ->find();
            }
            $data[$k]['source']['id'] = $v['be_comment_id'];
            $data[$k]['source']['type'] = $v['type'];
        }

        return $data;
    }

    /**
     * 多条记录查找
     * @param $id
     * @return mixed
     */
    public function getCommentList($id){
        $data = $this->table('__COMMENT__ AS comment')
            ->field('comment.*, user.username')
            ->join(C('DB_PREFIX_COMMON').'user as user on user.id = comment.user_id', 'LEFT')
            ->where('be_comment_id = %d',$id)
            ->order('comment.gmt_create desc')
            ->select();

        return $data;
    }

    public function getComment(){
        $data = $this->table('__COMMENT__ AS comment')
            ->field('comment.*, user.username,course.id as course_id,course.name as course_name,file.path')
            ->join(C('DB_PREFIX_COMMON').'user as user on user.id = comment.user_id', 'LEFT')
            ->join('__COURSE__ AS course ON course.id = comment.be_comment_id', 'LEFT')
            ->join(C('DB_PREFIX_COMMON').'file as file on file.id = user.avatar', 'LEFT')
            ->order('comment.gmt_create desc')
            ->select();

        return $data;
    }

    /**
     * 查找被评论的评论
     * @param $id
     * @return mixed
     */
    public function getByParent($id){
       $data = $this->table('__COMMENT__ AS comment')
            ->field('comment.*, user.name,be_user.name as be_name')
            ->join(C('DB_PREFIX_COMMON').'user as user on user.id = comment.user_id', 'LEFT')
            ->join(C('DB_PREFIX_COMMON').'user as be_user on be_user.id = comment.be_user_id', 'LEFT')
            ->where('comment.parent = %d',$id)
            ->order('comment.gmt_create asc')
            ->select();
        return $data;
    }
}