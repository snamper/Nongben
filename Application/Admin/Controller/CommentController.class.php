<?php

namespace Admin\Controller;

class CommentController extends BaseController{


    /**
     * @var \Admin\Logic\CommentLogic
     */
    protected $commentLogic;
    protected $courseLogic;

    public function _initialize(){
        $this->commentLogic = D('Comment', 'Logic');
        $this->courseLogic = D('Course', 'Logic');
    }

    /**
     * 数据列表
     */
    public function index(){
        $conditions = $this->getAvailableData();
        $pagePara = get_page_para();
        $commentList = $this->commentLogic->getList($conditions,$pagePara);

        $this->assign("list",$commentList['items']);
        $this->assign("pager",$commentList['pager']);
        $this->assign("params",$conditions);
        $this->display();
    }



    /**
     * 查看视图
     * @param $be_comment_id
     */
    public function detail($be_comment_id){
        $course = $this->courseLogic->getById($be_comment_id);
        $comment = $this->commentLogic->getCommentList($be_comment_id);

        $this->assign('comment_count',$comment['comment_count']);
        $this->assign("comment",$comment['items']);
        $this->assign("course",$course);
        $this->display();
    }

    /**
     * 删除操作
     */
    public function do_del(){
        $conditions = $this->getAvailableData();
        $result = $this->commentLogic->delComment($conditions);

        $this->ajaxAuto($result,'删除');
    }
}
