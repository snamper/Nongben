<?php
namespace Webmall\Controller;

class CommentController extends BaseController {

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 获取评论列表
     */
    public function getComment(){
        $id = $this->getAvailableData();

        $commentLogic = D('Comment','Logic');
        $data = $commentLogic->getCommentList($id);
        $this->ajaxAuto($data);
    }

    /**
     * 评论
     */
    public function comment(){
        $conditions = $this->getAvailableData();
        if(empty($this->user)){
            $this->ajaxError('请先登陆','',301);
        }
        $commentLogic = D('Comment','Logic');
        $conditions['user_id'] = $this->user['id'];

        $data = $commentLogic->comment($conditions);
        $this->ajaxAuto($data);
    }

    /**
     * 获取未读消息
     */
    public function getUnreadMessage(){
        $commentLogic = D('Comment','Logic');
        $data = $commentLogic->getUnreadMessage($this->user['id']);
        $this->ajaxAuto($data);
    }

    /**
     * 获取未读消息
     */
    public function getMyMessage(){
        $commentLogic = D('Comment','Logic');
        $data = $commentLogic->getMyMessage($this->user['id']);
        $this->ajaxAuto($data);
    }

    /**
     * 阅读消息
     */
    public function readMessage(){
        $commentLogic = D('Comment','Logic');
        $data = $commentLogic->readMessage($this->user['id']);
        $this->ajaxAuto($data);
    }

    /**
     * 判断是否为自己评论自己
     */
    public function is_equal(){
        $conditions = $this->getAvailableData();
        if(!isset($conditions['be_user_id'])){
            $this->ajaxError('Bad Input parameter');
        }

        if($conditions['be_user_id'] == $this->user['id']){
            $this->ajaxError('The Same user','',301);
        }else{
            $this->ajaxSuccess();
        }
    }

    /**
     * 删除评论
     */
    public function delComment(){
        $conditions = $this->getAvailableData();
        if(!isset($conditions['id']) || !isset($conditions['type']) || !isset($conditions['be_comment_id'])){
            $this->ajaxError('Bad Input parameter');
        }

        $commentLogic = D('Comment','Logic');
        $data = $commentLogic->delComment($conditions);
        $this->ajaxAuto($data);
    }

}