<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/28
 * Time: 14:20
 */

namespace Common\Util;

use Vendor\Payment\Payment;

vendor('Payment.Payment');

class PayUtil {

    protected $payRequest;
    protected $payResponse;


    /**
     * 获取支付请求
     * @param $type
     * @param $params
     * @return string
     * @throws \Exception
     */
    public function getPayRequest($type,$params){

        switch(strtolower($type)){
            case 'alipay':
            case 'alipaywap':
                $this->payRequest = Payment::createRequest('alipay',array_change_key_case(C(strtoupper($type)),CASE_LOWER),$params);

                $payArr = $this->payRequest->form();

                if(is_array($payArr['params'])){
                    return $payArr['action'] . '?' . http_build_query($payArr['params']);
                }else{
                    return false;
                }
                break;
            case 'wxpay':
                $this->payRequest = Payment::createRequest($type,array_change_key_case(C(strtoupper($type)),CASE_LOWER),$params);
                $returnXml = $this->payRequest->unifiedOrder();
                $payArr = $this->payRequest->fromXml($returnXml);

                if($payArr['return_code'] == 'SUCCESS'){
                    return $payArr['code_url'];
                }else{
                    return false;
                }
                break;
            case 'wxpayapp':
                $this->payRequest = Payment::createRequest('wxpay',array_change_key_case(C(strtoupper($type)),CASE_LOWER),$params);
                $returnXml = $this->payRequest->unifiedOrder();

                $payArr = $this->payRequest->fromXml($returnXml);
                return $payArr;
                break;

            case 'unionpay':
            case 'unionwappay':
                $this->payRequest = Payment::createRequest('icbcb2c',array_change_key_case(C(strtoupper($type)),CASE_LOWER),$params);
                $data = $this->payRequest->form();
                $postForm = $this->payRequest->buildRequestForm($data);
                return $postForm;
                break;
            default:
                return false;
                break;
        }

    }

    /**
     * 获取支付响应
     * @param $type
     * @param $post
     * @return string
     * @throws \Exception
     */
    public function getPayResponse($type,$post){
        switch(strtolower($type)) {
            case 'alipay':
            case 'alipaywap':
                $this->payResponse = Payment::createResponse('alipay', array_change_key_case(C(strtoupper($type)), CASE_LOWER), $post);
                break;

            case 'wxpay':
            case 'wxpayapp':
                $this->payResponse = Payment::createResponse('wxpay', array_change_key_case(C(strtoupper($type)), CASE_LOWER), $this->fromXml($post));
                break;

            case 'unionpay':
                $this->payResponse = Payment::createResponse('icbcb2c', array_change_key_case(C(strtoupper($type)), CASE_LOWER), $post);
                break;

            default:
                die('错误的支付类型');
                break;
        }
        return $this->payResponse->getPayData();
    }

    /**
     * xml转换
     * @param $xml
     * @return mixed
     */
    public function fromXml($xml)
    {
        $array = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);

        return $array;
    }


    /**
     * 查询微信支付状态
     */
    public function orderQuery($type, $params){
        $this->payRequest = Payment::createRequest('wxpay',array_change_key_case(C(strtoupper($type)),CASE_LOWER),$params);

        $returnXml = $this->payRequest->orderQuery();
        $payArr = $this->payRequest->fromXml($returnXml);
        return $payArr;
    }


    /**
     * 微信app支付二次签名
     * @param $params
     * @return mixed
     * @throws \Exception
     */
    public function wxprepaySign($params){
        $this->payRequest = Payment::createRequest('wxpay',array_change_key_case(C(strtoupper('wxpayapp')),CASE_LOWER),$params);
        $data = $this->payRequest->prepaySign($params);
        return $data;
    }


    /**
     * 输出xml字符
     **/
    public function ToXml($params)
    {

        if(!is_array($params)
            || count($params) <= 0)
        {
            throw new \Exception("数组数据异常！");
        }

        $xml = "<xml>";
        foreach ($params as $key=>$val)
        {
            if (is_numeric($val)){
                $xml.="<".$key.">".$val."</".$key.">";
            }else{
                $xml.="<".$key."><![CDATA[".$val."]]></".$key.">";
            }
        }
        $xml.="</xml>";
        return $xml;
    }


}