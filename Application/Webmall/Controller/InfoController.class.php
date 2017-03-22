<?php
namespace Webmall\Controller;
use Think\Controller;

class InfoController extends Controller {

    protected $infoLogic;

    public function _initialize(){
        $this->infoLogic = D('Info', 'Logic');
    }

    public function news(){
        //获取所有资讯列表
        $info = $this->infoLogic->getList();
        foreach($info as $k=>$v){
            $info[$k]['description'] = strip_tags(htmlspecialchars_decode($v['content']));
        }
        //获取热门资讯列表
        $hotInfo = $this->infoLogic->getHotList();
        foreach($hotInfo as $k=>$v){
            $HotInfo[$k]['description'] = strip_tags(htmlspecialchars_decode($v['content']));
        }

        $this->assign('info',$info);
        $this->assign('hotInfo',$hotInfo);
        $this->display();
    }

    public function detail($id){
        $this->infoLogic->setAsc($id);
        $res = $this->infoLogic->getById($id);

        $this->assign('info',$res['info']);
        $this->assign('pre',$res['pre']);
        $this->assign('next',$res['next']);
        $this->display();
    }
}