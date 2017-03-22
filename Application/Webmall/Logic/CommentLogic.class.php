<?php

namespace Webmall\Logic;

class CommentLogic extends BaseLogic{

    /**
     * @var \Academy\Data\CommentData
     */
    protected $commentData;
    protected $courseLogic;

    public function _initialize(){
        $this->commentData = D('Comment', 'Data');
        $this->courseLogic = D('Course', 'Logic');
    }

    /**
     * 获取评论列表
     * @param $id
     * @return mixed
     */
    public function getCommentList($id){
        return $this->commentData->getCommentList($id);
    }

    /**
     * 获取视频动态
     */
    public function getComment(){
        return $this->commentData->getComment();
    }

    /**
     * 获取未读消息
     * @param $id
     * @return mixed
     */
    public function getUnreadMessage($id){
        return $this->commentData->getUnreadMessage($id,1);
    }

    /**
     * 获取我的消息
     * @param $id
     * @return mixed
     */
    public function getMyMessage($id){
        return $this->commentData->getUnreadMessage($id,2);
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

        $commentFlag1 = $this->delByParent($conditions['id']);
        if($commentFlag1 === false){
            $trans->rollback();
            return false;
        }

        $trans->commit();
        return true;
    }

    /**
     * 评论
     * @param $conditions
     * @return bool
     */
    public function comment($conditions){
        $trans = D('Course');
        $trans->startTrans();
        $courseFlag = $this->courseLogic->setInc($conditions['be_comment_id'],'comment_count');
        if($courseFlag == 0){
            $trans->rollback();
            return false;
        }

        $commentFlag = $this->saveComment($conditions);
        if($commentFlag === false){
            $trans->rollback();
            return false;
        }

        $trans->commit();
        return true;
    }

    /**
     * 阅读消息
     * @param $id
     * @return mixed
     */
    public function readMessage($id){
        $Comment = D('Comment');

        return $Comment->where('be_user_id = %d',$id)->setField('status',2);
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
}