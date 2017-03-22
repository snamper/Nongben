<?php

namespace Admin\Data;

class UserCourseData extends BaseData{

    //定义表前缀
    protected $tablePrefix = 'st_academy_';

    /**
     * 获取查询条件
     * @param $conditions
     * @return array
     */
    public function getCondition($conditions){
        $where = array();

        if (isset($conditions['order_no']) && !empty($conditions['order_no'])) {
            $where['order_info.order_no'] = array('LIKE', '%'.$conditions['order_no'].'%');
        }
        if (isset($conditions['nickname']) && !empty($conditions['nickname'])) {
            $where['user.nickname'] = array('EQ', $conditions['nickname']);
        }
        if (isset($conditions['status']) && !empty($conditions['status'])) {
            $where['order_info.status'] = array('EQ', $conditions['status']);
        }
        if (isset($conditions['return_mode']) && !empty($conditions['return_mode'])) {
            $where['order_refund.return_mode'] = array('EQ', $conditions['return_mode']);
        }
        if (isset($conditions['need_report']) && !empty($conditions['need_report'])) {
            $where['order_bill.need_report'] = array('EQ', $conditions['need_report']);
        }
        if (isset($conditions['report_id']) && !empty($conditions['report_id'])) {
            $where['order_refund.report_id'] = array('LT', $conditions['report_id']);
        }
        if ((isset($conditions['gmt_start']) && !empty($conditions['gmt_start']))||(isset($conditions['gmt_end']) && !empty($conditions['gmt_end']))) {
            if(!empty($conditions['gmt_start']) && empty($conditions['gmt_end'])){
                $where['order_refund.gmt_return_delivery'] = array('EGT', $conditions['gmt_start']);
            }elseif(empty($conditions['gmt_start']) && !empty($conditions['gmt_end'])){
                $where['order_refund.gmt_return_delivery'] = array('ELT', $conditions['gmt_end'].' 23:59:59');
            }else{
                $where['order_refund.gmt_return_delivery'] = array('BETWEEN', [$conditions['gmt_start'],$conditions['gmt_end'].' 23:59:59']);
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
        $data = $this->table('__USER_COURSE__ AS user_course')
            ->field('user_course.*')
            ->where('id=%d',$id)
            ->find();
        return $data;
    }

    public function getRelByCourseId($id){
        $data = $this->table('__USER_COURSE__ AS user_course')
            ->field('user_course.relationship')
            ->where('course_id=%d',$id)
            ->find();

        return $data['relationship'];
    }

    /**
     * 按user_id查找
     * @param $id
     * @return mixed
     */
    public function getByUserId($id){

        $data = $this->table('__USER_COURSE__ AS user_course')
            ->field('user_course.*')
            ->where('user_id=%d',$id)
            ->select();

        return $data;
    }
    /**
     * 多条记录查找
     * @param $conditions
     * @param $pagePara
     * @return mixed
     */
    public function getList($conditions,$pagePara){

        $where = $this->getCondition($conditions);

        $data = $this->table('__ORDER_REFUND__ AS order_refund')
            ->field('order_refund.*,user.nickname,order_info.order_no,order_info.status,order_bill.need_report')
            ->join('__ORDER__ AS order_info ON order_info.order_id = order_refund.order_id','LEFT')
            ->join(C('DB_PREFIX_COMMON') . 'user AS user ON user.id = order_info.user_id','LEFT')
            ->join('__ORDER_BILL__ AS order_bill ON order_bill.order_id = order_refund.order_id','LEFT')
            ->where($where)
            ->page($pagePara->pageIndex, $pagePara->pageSize)
            ->order('order_refund.id desc')
            ->selectPage();

        return $data;
    }
}