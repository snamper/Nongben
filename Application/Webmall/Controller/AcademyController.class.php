<?php
namespace Webmall\Controller;
class AcademyController extends BaseController {

    protected $infoLogic;
    protected $categoryLogic;
    protected $advertisementLogic;
    protected $courseLogic;
    protected $collectLogic;
    protected $commentLogic;

    public function _initialize()
    {
        $this->infoLogic = D('Info','Logic');
        $this->categoryLogic = D('Category', 'Logic');
        $this->advertisementLogic = D('Advertisement', 'Logic');
        $this->courseLogic = D('Course','Logic');
        $this->collectLogic = D('UserCollect', 'Logic');
        $this->commentLogic = D('Comment','Logic');
    }

    public function index(){
        //获取一级分类
        $category = $this->categoryLogic->getByParent(0);
        foreach($category as $k=>$v){
            $category[$k]['child'] =  $this->categoryLogic->getByParent($v['id']);
        }

        //获取广告
        $adv = $this->advertisementLogic->getAdvList();
        //获取资讯
        $info = $this->infoLogic->getListLimit();
        //获取推荐课程（4门）
        $recommendCourse = $this->courseLogic->getRecommendCourse();
        //获取最新课程（8门）
        $newCourse = $this->courseLogic->getNewCourse();
        //获取热门课程（8门）
        $hotCourse = $this->courseLogic->getHotCourse();
        //获取视频互动
        $comment = $this->commentLogic->getComment();

        $this->assign('hot',$hotCourse);
        $this->assign('new',$newCourse);
        $this->assign('recommend',$recommendCourse);
        $this->assign('adv',$adv);
        $this->assign('category',$category);
        $this->assign('cat',$category);
        $this->assign('info',$info);
        $this->assign('user',$this->user);
        $this->assign('comment',$comment);
        $this->display();
    }
    /**
     * 获取分类列表
     */
    public function course(){
        $data = $this->getAvailableData();
        $pagePara = get_page_para();

        $category = $this->categoryLogic->getByparent($data['id']);
        //dump($category);
        if(empty($category)){
            $cat[0] = $this->categoryLogic->getById($data['id']);
            $course = $this->courseLogic->getNewCourseByCat($cat[0]['id'],$pagePara);
        }else{
            $cat = $category;
            $course = $this->courseLogic->getNewCourseByCat($cat[0]['id'],$pagePara);
        }
        foreach($course['items'] as $k => $v){
            $course['items'][$k]['collect'] = $this->collectLogic->isCollect($v['id'],1);
        }

        //dump($cat);
        //dump($course);
        $this->assign('course',$course['items']);
        $this->assign('count', $course['count']);
        $this->assign('cat',$cat);
        $this->assign('user',$this->user);
        $this->display();
    }

    /**
     * 根据类别获取最新课程（分页）
     */
    public function getNewCourseByCat(){
        $conditions = $this->getAvailableData();
        $pagePara = get_page_para($conditions['pageIndex'],$conditions['pageSize']);

        $courseLogic = D('Course','Logic');
        $data = $courseLogic->getNewCourseByCat($conditions['id'],$pagePara);
        foreach($data['items'] as $k => $v){
            $data['items'][$k]['collect'] = $this->collectLogic->isCollect($v['id'],$this->user['id']);
        }
        //dump($data);
        //exit;
        $this->ajaxAuto($data);
    }

    /**
     * 根据类别获取热门课程（分页）
     */
    public function getHotCourseByCat(){
        $conditions = $this->getAvailableData();
        $pagePara = get_page_para($conditions['pageIndex'],$conditions['pageSize']);

        $courseLogic = D('Course','Logic');
        $data = $courseLogic->getHotCourseByCat($conditions['id'],$pagePara);
        foreach($data['items'] as $k => $v){
            $data['items'][$k]['collect'] = $this->collectLogic->isCollect($v['id'],$this->user['id']);
        }
        $this->ajaxAuto($data);
    }

    /**
     * 获取课程数目
     */
    public function getPage(){
        $conditions = $this->getAvailableData();

        $courseLogic = D('Course','Logic');
        $data = ceil($courseLogic->getCount($conditions['id'])/4);

        $this->ajaxAuto($data);
    }

    /**
     * 获取课程详情
     */
    public function detail(){
        $id = $this->getAvailableData();
        $data = $this->courseLogic->getCourseDetail($id, $this->user['id']);
        $is_collect = $this->collectLogic->isCollect($data['id'],$this->user['id']);
        $comment = $this->commentLogic->getCommentList($id);

        //dump($comment);
        $this->assign('comment',$comment);
        $this->assign('collect',$is_collect);
        $this->assign('course',$data);
        $this->assign('user',$this->user);
        $this->display();
    }

    /**
     * 收藏/取消收藏
     */
    public function collect(){
        $conditions = $this->getAvailableData();
        if(empty($this->user)){
            $this->ajaxError('请先登陆','','301');
        }else{
            $data = $this->collectLogic->collect($conditions['type'],$conditions['course_id'],$this->user['id']);
            if($data == 'collect'){
                $this->ajaxSuccess('','收藏成功');
            }else if($data == 'cancel'){
                $this->ajaxSuccess('','取消收藏成功');
            }else{
                $this->ajaxError('操作失败');
            }
        }
    }

    /**
     * 检查是否登陆
     */
    public function start(){
        if(empty($this->user)){
            $this->ajaxError('请先登陆','',301);
        }else{
            $this->ajaxSuccess();
        }
    }

    /**
     * 观看视频
     */
    public function play($id){
        if(empty($this->user)){
            $this->redirect('/Webmall/User/login');
        }else{
            $data = $this->courseLogic->start($id,$this->user['id']);
            $this->assign('course',$data);
            $this->assign('user',$this->user);
            $this->display();
        }
    }

}