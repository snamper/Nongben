<?php

namespace Admin\Data;

class LogData extends BaseData{

    //定义表前缀
    protected $tablePrefix = 'st_common_';
    
    /**
     * 获取查询条件
     * @param $conditions
     * @return array
     */
    public function getCondition($conditions){
        $where = array();

        if (isset($conditions['account_type']) && !empty($conditions['account_type'])) {
            $where['log.account_type'] = array('EQ', $conditions['account_type']);
        }
        if (isset($conditions['username']) && !empty($conditions['username'])) {
            $where['manager_account.username'] = array('EQ', $conditions['username']);
        }
        if (isset($conditions['operate_name']) && !empty($conditions['operate_name'])) {
            $where['log.operate_name'] = array('EQ', $conditions['operate_name']);
        }
        if (isset($conditions['operate_params']) && !empty($conditions['operate_params'])) {
            $where['log.operate_params'] = array('EQ', $conditions['operate_params']);
        }
        if (isset($conditions['operate_url']) && !empty($conditions['operate_url'])) {
            $where['log.operate_url'] = array('EQ', $conditions['operate_url']);
        }
        if (isset($conditions['ip']) && !empty($conditions['ip'])) {
            $where['log.ip'] = array('EQ', $conditions['ip']);
        }
        if (isset($conditions['target']) && !empty($conditions['target'])) {
            $where['log.target'] = array('EQ', $conditions['target']);
        }
        if (isset($conditions['operate']) && !empty($conditions['operate'])) {
            $where['log.operate'] = array('EQ', $conditions['operate']);
        }
        if (isset($conditions['gmt_operate']) && !empty($conditions['gmt_operate'])) {
            $where['log.gmt_operate'] = array('EQ', $conditions['gmt_operate']);
        }
        if (isset($conditions['status']) && !empty($conditions['status'])) {
            $where['log.status'] = array('EQ', $conditions['status']);
        }
        if (isset($conditions['note']) && !empty($conditions['note'])) {
            $where['log.note'] = array('EQ', $conditions['note']);
        }
        return $where;
    }

    /**
     * 单条记录查找
     * @param $id
     * @return mixed
     */
    public function getById($id){
        return $this->table('__LOG__ AS log')
            ->field('log.*,manager_account.username as ma_name,user.username as u_name')
            ->join('__MANAGER_ACCOUNT__ AS manager_account ON manager_account.id = log.account_id','LEFT')
            ->join('__USER__ AS user ON user.id = log.account_id','LEFT')
            ->where('log.id=%d',$id)
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

        $data = $this->table('__LOG__ AS log')
            ->field('log.*,manager_account.username as ma_name,user.username as u_name')
            ->join('__MANAGER_ACCOUNT__ AS manager_account ON manager_account.id = log.account_id','LEFT')
            ->join('__USER__ AS user ON user.id = log.account_id','LEFT')
            ->where($where)
            ->order('id desc')
            ->page($pagePara->pageIndex, $pagePara->pageSize)
            ->selectPage();

        foreach($data['items'] as &$detail){
            $detail['operate_detail'] = D('Permission')
                ->where('code = "%s"',strtolower($detail['operate_name']).'_'.str_replace('do_','',$detail['operate']))
                ->getField('name');
        }


        return $data;
    }
}