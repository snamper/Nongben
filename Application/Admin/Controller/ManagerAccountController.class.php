<?php
/**
 * Created by PhpStorm.
 * User: KU04PC
 * Date: 2015/5/6
 * Time: 21:13
 */
namespace Admin\Controller;



class ManagerAccountController extends BaseController{


    /**
     * @var \Admin\Logic\ManagerAccountLogic
     */
    protected $managerAccountLogic;
    /**
     * @var \Admin\Logic\RoleLogic
     */
    protected $roleLogic;

    public function _initialize(){
        $this->managerAccountLogic = D('ManagerAccount', 'Logic');
        $this->roleLogic = D('Role', 'Logic');
    }

    /**
     * 数据列表
     */
    public function index(){
        $conditions = $this->getAvailableData();
        $pagePara = get_page_para();
        if($this->managerData['role_id'] != 1){
            $conditions['hide_role_id'] = 1;
        }
        $managerAccountList = $this->managerAccountLogic->getList($conditions,$pagePara);

        $this->assign("list",$managerAccountList['items']);
        $this->assign("pager",$managerAccountList['pager']);
        $this->assign("params",$conditions);
        $this->display();
    }

    /**
     * 添加视图
     */
    public function add(){
        $conditions = array();
        if($this->managerData['role_id'] != 1){
            $conditions['hide_role_id'] = 1;
        }
        $roles = $this->roleLogic->getList($conditions);

        $this->assign('roles',$roles);
        $this->display();
    }

    /**
     * 编辑视图
     */
    public function edit($id){
        $conditions = array();
        if($this->managerData['role_id'] != 1){
            $conditions['hide_role_id'] = 1;
        }
        $roles = $this->roleLogic->getList($conditions);
        $managerAccount = $this->managerAccountLogic->getById($id);
        if($managerAccount['role_id']==$this->managerData['role_id']){
            $this->assign('flag',true);
        }
        $this->assign('roles',$roles);
        $this->assign("managerAccount",$managerAccount);
        $this->display();
    }

    /**
     * 查看视图
     */
    public function detail($id){
        $managerAccount = $this->managerAccountLogic->getById($id);

        $this->assign("managerAccount",$managerAccount);
        $this->display();
    }

    /**
     * 添加操作
     */
    public function do_add(){
        $data = $this->getAvailableData();
        if($this->managerAccountLogic->getByUsername($data['username'])){
            $this->ajaxError('用户名已存在');
        }
        $result = $this->managerAccountLogic->saveManagerAccount($data);

        $this->ajaxAuto($result,'添加');
    }

    /**
     * 编辑操作
     */
    public function do_edit(){
        $data = $this->getAvailableData();

        $result = $this->managerAccountLogic->editManagerAccount($data);

        $this->ajaxAuto($result,'修改');
    }

    /**
     * 删除操作
     */
    public function do_del($id){
        $result = $this->managerAccountLogic->delManagerAccount($id);

        $this->ajaxAuto($result,'删除');
    }
}