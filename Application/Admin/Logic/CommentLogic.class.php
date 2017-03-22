<?php

namespace Admin\Logic;

class CommentLogic extends BaseLogic{

    /**
     * @var \Admin\Data\CommentData
     */
    protected $commentData;
    protected $courseLogic;

    public function _initialize(){
        $this->commentData = D('Comment', 'Data');
        $this->courseLogic = D('Course', 'Logic');
    }

    /**
     * 获取单条数据
     * @param $id
     * @return mixed
     */
    public function getById($id){
        return $this->commentData->getById($id);
    }

    /**
     * 获取多条数据
     * @param $conditions
     * @param null $pagePara
     * @return mixed
     */
    public function getList($conditions,$pagePara = null){
        return $this->commentData->getList($conditions,$pagePara);
    }

    /**
     * 删除评论
     * @param $conditions
     * @return bool
     */
    public function delComment($conditions){
        $Comment = D('Comment');
        $trans = D('Course');
        $trans->startTrans();
        if($conditions['type'] == 1){
            $count = $Comment->where('parent = %d',$conditions['id'])->count();
            $count++;
            $courseFlag = $this->courseLogic->setDec($conditions['be_comment_id'],'comment_count',$count);
            if($courseFlag == 0){
                $trans->rollback();
                return false;
            }
        }
        $commentFlag = $this->do_del($conditions['id']);
        if($commentFlag === false){
            $trans->rollback();
            return false;
        }

        $trans->commit();
        return true;
    }

    /**
     * 添加数据
     * @param $data
     * @return bool
     */
    public function saveComment($data){

        $Comment = D('Comment');

        if($Comment->create($data)){
            return $Comment->add();
        }else{
            return false;
        }
    }

    /**
     * 修改数据
     * @param $data
     * @return bool
     */
    public function editComment($data){
        $Comment = D('Comment');

        if($Comment->create($data)){
            return $Comment->save();
        }else{
            return false;
        }
    }

    /**
     * 删除数据
     * @param $id
     * @return mixed
     */
    public function do_del($id){
        $Comment = D('Comment');

        return $Comment->delete($id);
    }

    public function delByParent($id){
        $Comment = D('Comment');

        return $Comment->where('parent = %d',$id)->delete();
    }

    /**
     * 获取多条数据(不分页)
     * @param $id
     * @return mixed
     */
    public function getCommentList($id){
        $data = $this->commentData->getCommentList($id);

        return $data;
    }
}