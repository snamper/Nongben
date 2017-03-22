<?php
/**
 * Created by PhpStorm.
 * User: ibm
 * Date: 2016/7/21
 * Time: 16:38
 */

namespace Common\Util;

use Think\Log;


/**
 * 逗哈钱包支付类
 * Class dhPay
 * @package Webmall\Common\Tool
 *
 * @return  array
 *  接口调用失败 status = 0, error=-2
 *  操作失败 status = 0
 *  操作成功 status=1
 */
class DoohanPay
{

    static $base_url = 'http://10.18.11.34:8031/dealer/interface/';
//    static $base_url = 'http://10.18.11.87:8031/dealer/interface/';
//    static $base_url = 'http://connect.doohan.cn/dealer/interface/';
    static $key = '6LbkL5NK10o22aO8d0p48648729H1044';
    //操作类型 1 冻结 2解冻 3扣除 4申请退款  5退款  6 取消退款 99查询
    const OPTFREEZE = 1;
    const OPTUNFREEZE = 2;
    const OPTDEDUCT = 3;
    const OPTAPPLYREFUND = 4 ;
    const OPTFINISHFUND = 5;
    const OPTCANCELREFUND = 6;
    const OPTQUERY = 99;


    /**
     * 查询可用余额
     * @param $pid 用户id
     */
    public static function query($storeId)
    {
        $queryUrl = self::$base_url . 'store/postStoreAmount';

        $params = array(
            'storeId' => $storeId
        );
        $sign = self::signParams($params, self::$key);
        $params['sign'] = $sign;
        $postStr = json_encode($params);
        $request = self::send_post($queryUrl, $postStr);
//        var_dump($request);
        //日志
        $logs = array(
            'store_id' => $storeId,
            'type' => self::OPTQUERY,
            'gmt_create' => get_date(),
            'call_state' => 1,
            'state' => 1,
            'note' => $request,
            'params' => json_encode($params),
            'owner' => ''
        );
		//var_dump($request);
        if (false === $request) {//接口调用失败
			//echo 'false';
            $return = array('status' => 0, 'error' => '-2');
            $logs['call_state'] = 2;
            $logs['state'] = 2;
        } else {
            if($request != strip_tags($request)){
                $logs['call_state'] = 2;
                $logs['state'] = 2;
                $logs['note'] = $request;
                $return = array('status' => 0, 'error' => '-2');
            }else if (0 === strpos($request, 'CWM')) {//查询失败
                if ($request == 'CWM3002') { //帐户不存在
                    $return = array('status' => 0, 'error' => -1);
                } else {
                    $return = array('status' => 0, 'error' => '余额查询失败');
                }
				$logs['call_state'] = 2;
                $logs['state'] = 2;
                $logs['note'] = $request;
            } else{
                $return = array('status' => 1, 'data' => $request);
            }
        }

        self::log($logs);
        return $return;
    }

    /**
     * 冻结资金
     * @param $params [
     * storeId(用户id)、businessNo(订单号)、businessType(订单类型:2 商城购物；3 商城退款；传code值)]
     * businessAmount(消费金额)、flowType(流水类型：0 收入；1 支出；传code值) ]
     */
    public static function freeze($params)
    {

        $url = self::$base_url . 'flow/addFlowToMall';
        $owner = isset($params['owner']) ? $params['owner'] : '';
        unset($params['owner']);
        //接口2 冻结金额
//        $params = array(
//            'storeId'   =>  '32339',
//            'businessNo'    =>  'DH2016070809025543461',
//            'businessType'  =>  '2',
//            'businessAmount'    =>  '1000',
//            'flowType'  =>  '1',
//        );
        $sign = self::signParams($params, self::$key);
        $params['sign'] = $sign;
        $postStr = json_encode($params);
        $request = self::send_post($url, $postStr);

        //日志
        $logs = array(
            'store_id' => $params['storeId'],
            'amount' => $params['businessAmount'],
            'type' => self::OPTFREEZE,
            'gmt_create' => get_date(),
            'order_no' => $params['businessNo'],
            'state' => 1,
            'call_state' => 1,
            'note' => $request,
            'params' => json_encode($params),
            'owner' => $owner
        );

        $return = array();
        if (false === $request) {//接口调用失败
            $return = array('status' => 0, 'error' => '-2');
            $logs['call_state'] = 2;
            $logs['state'] = 2;
        } else {
            if ($request == 'CWM3000') {
                $return = array('status' => 1);
            } else {
                //失败
                $logs['state'] = 2;
                $message = self::getFlowToMallError($request);
                $return = array('status' => 0, 'error' => $message);
            }
        }

        self::log($logs);
        return $return;
    }

    /**
     * 解冻资金
     * @param $params [storeId(用户id)、businessNo(订单号)、flowType(流水类型：0 收入；1 支出；2 支出取消；3 收入取消；传code值)]
     */
    public static function unfreeze($params)
    {

        $url = self::$base_url . 'flow/finishFlowToMall';
        $owner = isset($params['owner']) ? $params['owner'] : '';
        unset($params['owner']);

        $params['businessType'] = 2;
        //接口3 解冻资金
//        $params = array(
//            'storeId'   =>  '32339',
//            'businessNo'    =>  'DH2016070809025543461',
//            'flowType'  =>  '2',
//        );
        $sign = self::signParams($params, self::$key);
        $params['sign'] = $sign;
        $postStr = json_encode($params);

        $request = self::send_post($url, $postStr);

        $logs = array(
            'store_id' => $params['storeId'],
            'type' => self::OPTUNFREEZE,
            'gmt_create' => get_date(),
            'order_no' => $params['businessNo'],
            'state' => 1,
            'call_state' => 1,
            'note' => $request,
            'params' => json_encode($params),
            'owner' => $owner
        );
        if (false === $request) {//接口调用失败
            $return = array('status' => 0, 'error' => '-2');
            $logs['call_state'] = 2;
            $logs['state'] = 2;
        }
        if ($request == 'CWM3000') {
            $return = array('status' => 1);
        } else {
            $logs['state'] = 2;
            $logs['note'] = $request;
        }
        self::log($logs);
        return $return;
    }

    /**
     * 扣除资金
     */
    public static function deduct($params)
    {
        $url = self::$base_url . 'flow/finishFlowToMall';
        $owner = isset($params['owner']) ? $params['owner'] : '';
        unset($params['owner']);
        $params['businessType'] = 2;
//        print_r($params);
        //接口3 扣除金额
//        $params = array(
//            'storeId'   =>  '32339',
//            'businessNo'    =>  'DH2016070809025543461',
//            'flowType'  =>  '1',
//        );
        $sign = self::signParams($params, self::$key);
        $params['sign'] = $sign;
        $postStr = json_encode($params);

        $request = self::send_post($url, $postStr);

        $logs = array(
            'store_id' => $params['storeId'],
            'type' => self::OPTDEDUCT,
            'gmt_create' => get_date(),
            'order_no' => $params['businessNo'],
            'call_state' => 1,
            'state' => 1,
            'note' => $request,
            'params' => json_encode($params),
            'owner' => $owner
        );

        if (false === $request) {//接口调用失败
            $return = array('status' => 0, 'error' => '-2');
            $logs['call_state'] = 2;
            $logs['state'] = 2;
        }
        if ($request == 'CWM3000') {
            $return = array('status' => 1);
        } else {
            //失败
            $logs['state'] = 2;
            $logs['note'] = $request;
            $message = self::getFlowToMallError($request);
            $return = array('status' => 0, 'error' => $message);
        }
        self::log($logs);
        return $return;
    }

    /**
     * 申请退款
     * @param $params
     */
    public static function applyRefund($params)
    {
        $url = self::$base_url . 'flow/addFlowToMall';
        $owner = isset($params['owner']) ? $params['owner'] : '';
        unset($params['owner']);
        //接口2 退款申请
//        $params = array(
//            'storeId'   =>  '420',
//            'businessNo'    =>  'DH2016072614141714894',
//            'businessType'  =>  '3',
//            'businessAmount'    =>  '5',
//            'flowType'  =>  '0',
//        );
        $sign = self::signParams($params, self::$key);
        $params['sign'] = $sign;
        $postStr = json_encode($params);
        $request = self::send_post($url, $postStr);

        //日志
        $logs = array(
            'store_id' => $params['storeId'],
            'amount' => $params['businessAmount'],
            'type' => self::OPTAPPLYREFUND,
            'gmt_create' => get_date(),
            'order_no' => $params['businessNo'],
            'state' => 1,
            'call_state' => 1,
            'note' => $request,
            'params' => json_encode($params),
            'owner' => $owner
        );

        $return = array();
        if (false === $request) {//接口调用失败
            $return = array('status' => 0, 'error' => '-2');
            $logs['call_state'] = 2;
            $logs['state'] = 2;
        }
        if ($request == 'CWM3000') {
            $return = array('status' => 1);
        } else {
            //失败
            $logs['state'] = 2;
            $logs['note'] = $request;
            $message = self::getFlowToMallError($request);
            $return = array('status' => 0, 'error' => $message);
        }
        self::log($logs);
        return $return;
    }


    /**
     * 完成退款
     * @param $params
     */
    public static function finishRefund($params)
    {
        $url = self::$base_url . 'flow/finishFlowToMall';
        $owner = isset($params['owner']) ? $params['owner'] : '';
        unset($params['owner']);
        $params['businessType'] = 3;
        //接口3 完成退款
//        $params = array(
//            'storeId'   =>  '32339',
//            'businessNo'    =>  'DH2016070809025543461',
//            'flowType'  =>  '0',
//            'businessAmount'  =>  '300',
//        );
        $sign = self::signParams($params, self::$key);
        $params['sign'] = $sign;
        $postStr = json_encode($params);

        $request = self::send_post($url, $postStr);


        $logs = array(
            'store_id' => $params['storeId'],
            'type' => self::OPTFINISHFUND,
            'gmt_create' => get_date(),
            'order_no' => $params['businessNo'],
            'amount'=>  $params['businessAmount'],
            'state' => 1,
            'call_state' => 1,
            'note' => $request,
            'params' => json_encode($params),
            'owner' => $owner
    );

        $return = array();
        if (false === $request) {//接口调用失败
            $return = array('status' => 0, 'error' => '-2');
            $logs['call_state'] = 2;
            $logs['state'] = 2;
        }
        if ($request == 'CWM3000') {
            $return = array('status' => 1);
        } else {
            //失败
            $logs['state'] = 2;
            $logs['note'] = $request;
            $message = self::getFlowToMallError($request);
            $return = array('status' => 0, 'error' => $message);
        }
        self::log($logs);
        return $return;
    }

    /**
     * 取消退款
     * @param $params
     */
    public static function cancelRefund($params)
    {
        $url = self::$base_url . 'flow/finishFlowToMall';
        $owner = isset($params['owner']) ? $params['owner'] : '';
        unset($params['owner']);
        //接口3 取消退款
//        $params = array(
//            'storeId'   =>  '420',
//            'businessNo'    =>  'DH2016072615085210134',
//            'flowType'  =>  '3',
//            'businessType'  =>  '3',
//        );
        $sign = self::signParams($params, self::$key);
        $params['sign'] = $sign;
        $postStr = json_encode($params);
        $request = self::send_post($url, $postStr);

        $logs = array(
            'store_id' => $params['storeId'],
            'type' => self::OPTCANCELREFUND,
            'gmt_create' => get_date(),
            'order_no' => $params['businessNo'],
            'state' => 1,
            'call_state' => 1,
            'note' => $request,
            'params' => json_encode($params),
            'owner' => $owner
        );

        $return = array();
        if (false === $request) {//接口调用失败
            $return = array('status' => 0, 'error' => '-2');
            $logs['call_state'] = 2;
            $logs['state'] = 2;
        }
        if ($request == 'CWM3000') {
            $return = array('status' => 1);
        } else {
            //失败
            $logs['state'] = 2;
            $logs['note'] = $request;
            $message = self::getFlowToMallError($request);
            $return = array('status' => 0, 'error' => $message);
        }
        self::log($logs);
        return $return;

    }


    /**
     * 记录日志
     */
    static function log($params)
    {
        $dhpay = D('OrderDhpay');
        if ($dhpay->create($params)) {
            $logId = $dhpay->add($params);
            if (false === $logId) {
                Log::write('逗哈钱包支付流水记录保存失败' . json_encode($params), 'ERROR');
            }
        } else {
            Log::write('逗哈钱包支付流水记录保存失败' . json_encode($params), 'ERROR');
        }
    }

    private static function getFlowToMallError($errorcode)
    {
        $message = '';
        switch ($errorcode) {
            case 'CWM3001':
                $message = '签名已过期';
                break;
            case 'CWM3002':
                $message = '用户不存在';
                break;
            case 'CWM3003':
                $message = '余额不足';
                break;
            case 'CWM3004':
                $message = '余额更新失败';
                break;
            case 'CWM3005':
                $message = '不存在此业务类型的流水';
                break;
            case 'CWM3006':
                $message = '订单已提交，请勿重复提交';
                break;
            default:
                $message = '服务器异常，请稍候重试';
                break;
        }
        return $message;
    }


    public static function getOperType($type){

        $types = array(
            1   =>  '冻结',
            2   =>  '解冻',
            3   =>  '扣除',
            4   =>  '申请退款',
            5   =>  '完成退款',
            6   =>  '取消退款',
            99   =>  '查询',
        );
        return isset($types[$type]) ? $types[$type] : '未知操作';
    }

    /**
     * 生成签名
     * @param $params
     * @param $secret
     * @return mixed
     */
    protected static function signParams($params, $secret)
    {
        unset($params['sign_type']);
        unset($params['sign']);

        ksort($params);
        $sign = '';
        foreach ($params as $key => $value) {

            $sign .= $key . '=' . $value . '&';
        }

        $sign = substr($sign, 0, -1);

        $sign .= $secret;

        return md5($sign);
    }

    /**
     * 发送post请求
     * @param $url
     * @param $postData
     * @return string
     */
    protected static function send_post($url, $postData)
    {
        set_time_limit (30);
        ini_set("max_execution_time", 30);
        $options = array(
            'http' => array(
                'method' => 'POST',
//                'header' => 'Content-type:application/x-www-form-urlencoded',
                'header' => 'Content-Type: application/json; charset=utf-8',
                'content' => $postData,
                'timeout' => 20 // 超时时间（单位:s）
            )
        );
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        return $result;
    }


}