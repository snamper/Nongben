<?php
namespace Vendor\Payment\Icbcb2c;

use SimpleXMLElement;
use Vendor\Payment\Request;
use Vendor\Payment\CommonUtil;

class Icbcb2cRequest extends Request
{
    protected $unifiedOrderUrl = 'https://mybank3.dccnet.com.cn/servlet/ICBCINBSEBusinessServlet';
    protected $unifieldWapOrderUrl = "https://mywap2.dccnet.com.cn:447/ICBCWAPBank/servlet/ICBCWAPEBizServlet";

    public function form()
    {
        $params = array();
        $form['action'] = $this->getFormUrl();
        $form['method'] = 'post';
        $form['params'] = $this->convertParams($this->params);
        return $form;
    }

    /**
     * 对参数进行签名处理
     * @param $params  配置信息 tranData
     * @return array 签名后的数据
     */

    public function sign($tranData)
    {
        $crtPublic = __DIR__ . '/cert/1225.crt'; //公钥
        $certKey = __DIR__ . '/cert/1225.key'; //私钥
        $certKeyPass = '12345678'; //私钥密码

        //加载扩展
        if (!extension_loaded('infosec')) {
            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                dl('php_infosec.dll');
            } else {
                dl('infosec.so');
            }
        }

        $fp = fopen($certKey, "rb");
        if ($fp == NULL) {
            throw new \RuntimeException('私钥读取失败');
        }
        fseek($fp, 0, SEEK_END);
        $filelen = ftell($fp);
        fseek($fp, 0, SEEK_SET);
        $contents = fread($fp, $filelen);
        fclose($fp);
        $key = substr($contents, 2);

        //检查密钥口令
        if (strlen($certKeyPass) <= 0) {
            throw new \RuntimeException('密钥口令为空');
        }

        //获取订单提交数据
        if (strlen($tranData) <= 0) {
            throw new \RuntimeException('交易数据为空');
        }

        //读取商户公钥文件
        $fp2 = fopen($crtPublic, "rb");
        if ($fp2 == NULL) {
            throw new \RuntimeException('公钥读取失败');
        }
        fseek($fp2, 0, SEEK_END);
        $filelen2 = ftell($fp2);
        fseek($fp2, 0, SEEK_SET);
        $cert = fread($fp2, $filelen2);
        fclose($fp2);

        /*签名*/
        $signature = sign($tranData, $key, $certKeyPass);//签名
        $code = current($signature);//获取签名数据
        $len = next($signature);//获取签名数据长度
        $signcode = base64enc($code);//对签名数据BASE64编码
        $merSignMsg = current($signcode); // 订单签名数据
        $tranDataBase64 = current(base64enc($tranData));//对表单数据BASE64编码
        $merCertBase64 = current(base64enc($cert));//对证书BASE64编码

        $sign = array();
        $sign = compact('tranDataBase64', 'merSignMsg', 'merCertBase64');
        return $sign;
    }

    /**
     * @param $array
     * @param bool $xml
     * @return mixed
     */
    private function toXml($params)
    {
        if(isset($params['type']) && $params['type'] == 'wap'){
            $tranData = '<?xml version="1.0" encoding="gbk" standalone="no"?><B2CReq><interfaceName>'. $params['interfacename'].'</interfaceName><interfaceVersion>'.$params['interfaveversion'].'</interfaceVersion><orderInfo><orderDate>'.$params['orderdate'].'</orderDate><orderid>'.$params['orderid'].'</orderid><amount>'.$params['amount'].'</amount><installmentTimes>1</installmentTimes><curType>001</curType><merID>'.$params['merid'].'</merID><merAcct>'.$params['meracct'].'</merAcct></orderInfo><custom><Language>zh_CN</Language></custom><message><goodsID>'.$params['goodsid'].'</goodsID><goodsName>'.$params['goodsname'].'</goodsName><goodsNum>'.$params['goodsnum'].'</goodsNum><carriageAmt>'.$params['amount'].'</carriageAmt><merHint>'.(isset($params['hint']) ? $params['hint'] : '' ) .'</merHint><remark1></remark1><remark2></remark2><merURL>'.$params['notify_url'].'</merURL><merVAR>'.(isset($params['mervar']) ? $params['mervar'] : '' ) .'</merVAR></message></B2CReq>';
        } else {
            $tranData = '<?xml version="1.0" encoding="GBK" standalone="no"?><B2CReq><interfaceName>'. $params['interfacename'].'</interfaceName><interfaceVersion>'.$params['interfaveversion'].'</interfaceVersion><orderInfo><orderDate>'.$params['orderdate'].'</orderDate><curType>001</curType><merID>'. $params['merid'] .'</merID><subOrderInfoList><subOrderInfo><orderid>'.$params['orderid'].'</orderid><amount>'. $params['amount'] .'</amount><installmentTimes>1</installmentTimes><merAcct>'.$params['meracct'].'</merAcct><goodsID>'.$params['goodsid'].'</goodsID><goodsName>'.$params['goodsname'].'</goodsName><goodsNum>'.$params['goodsNum'].'</goodsNum><carriageAmt>'.$params['amount'].'</carriageAmt></subOrderInfo></subOrderInfoList></orderInfo><custom><verifyJoinFlag>0</verifyJoinFlag><Language>ZH_CN</Language></custom><message><creditType>2</creditType><notifyType>HS</notifyType><resultType>0</resultType><merReference></merReference><merCustomIp>'. $params['mercustomip'] .'</merCustomIp><goodsType>1</goodsType><merCustomID>'.$params['username'] .'</merCustomID><merCustomPhone>'.$params['mobile'] .'</merCustomPhone><goodsAddress>'. $params['address'] .'</goodsAddress><merOrderRemark>'.(isset($params['note']) ? $params['note'] : '' ) .'</merOrderRemark><merHint>'.(isset($params['hint']) ? $params['hint'] : '' ) .'</merHint><remark1>'.(isset($params['remark1']) ? $params['remark1'] : '' ) .'</remark1><remark2>'.(isset($params['remark2']) ? $params['remark2'] : '' ) .'</remark2><merURL>'.$params['notify_url'] .'</merURL><merVAR>'.(isset($params['mervar']) ? $params['mervar'] : '' ) .'</merVAR></message></B2CReq>';
        }
        return $tranData;
    }

/*    public function toWapXml($params){
        $xml = '<?xml version="1.0" encoding="gbk" standalone="no"?><B2CReq><interfaceName>'. $params['interfacename'].'</interfaceName><interfaceVersion>'.$params['interfaveversion'].'</interfaceVersion><orderInfo><orderDate>'.$params['orderdate'].'</orderDate><orderid>'.$params['orderid'].'</orderid><amount>'.$params['amount'].'</amount><installmentTimes>1</installmentTimes><curType>001</curType><merID>'.$params['merid'].'</merID><merAcct>'.$params['meracct'].'</merAcct></orderInfo><custom><Language>zh_CN</Language></custom><message><goodsID>'.$params['goodsid'].'</goodsID><goodsName>'.$params['goodsname'].'</goodsName><goodsNum>'.$params['goodsnum'].'</goodsNum><carriageAmt>'.$params['amount'].'</carriageAmt><merHint>'.(isset($params['hint']) ? $params['hint'] : '' ) .'</merHint><remark1></remark1><remark2></remark2><merURL>'.$params['notify_url'].'</merURL><merVAR>'.(isset($params['mervar']) ? $params['mervar'] : '' ) .'</merVAR></message></B2CReq>';
        return $xml;
    }
*/

    protected function convertParams($params)
    {
//        print_r($params);
        $converted = array();

        if(isset($params['type']) && $params['type'] == 'wap'){
            $params['interfacename'] = 'ICBC_WAPB_B2C';
            $params['interfaveversion'] = '1.0.0.3';
        } else {
            $params['interfacename'] = 'ICBC_PERBANK_B2C';
            $params['interfaveversion'] = '1.0.0.11';

//            $converted['interfaceName'] = $params['interfacename'];
//            $converted['interfaceVersion'] = $params['interfaveversion'];
//            $params['amount'] = intval($params['amount']* 100);
//            $tranData = $this->toXml($params);
//
//            $signs = $this->sign($tranData);
//            $converted['tranData'] = $signs['tranDataBase64'];
//            $converted['merSignMsg'] = $signs['merSignMsg'];
//            $converted['merCert'] = $signs['merCertBase64'];

//        print_r($converted);
        }
        $converted['interfaceName'] = $params['interfacename'];
        $converted['interfaceVersion'] = $params['interfaveversion'];
        $params['amount'] = intval($params['amount']* 100);
        $tranData = $this->toXml($params);

        $signs = $this->sign($tranData);
        $converted['tranData'] = $signs['tranDataBase64'];
        $converted['merSignMsg'] = $signs['merSignMsg'];
        $converted['merCert'] = $signs['merCertBase64'];

        return $converted;
    }


    function buildRequestForm($params) {
        $sHtml = "<form name='icbcsubmit' action='". $params['action']."' method='".$params['method']."'>";
        foreach($params['params'] as $key => $val){
            $sHtml.= "<input type='text' name='".$key."' value='".$val."'/>";
        }

        //submit按钮控件请不要含有name属性
        $sHtml = $sHtml."<input type='submit' value='submit'></form>";

//        $sHtml = $sHtml."<script>document.forms['icbcsubmit'].submit();</script>";

        return $sHtml;
    }


    public function getFormUrl(){

        if(isset($this->params['type']) && $this->params['type'] == 'wap'){
            return $this->unifieldWapOrderUrl;
        } else {
            return $this->unifiedOrderUrl;
        }
    }

    private function getNonceStr($length = 32)
    {
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

    private function getClientIp()
    {
        if ($_SERVER['REMOTE_ADDR']) {
            $cip = $_SERVER['REMOTE_ADDR'];
        } elseif (getenv("REMOTE_ADDR")) {
            $cip = getenv("REMOTE_ADDR");
        } elseif (getenv("HTTP_CLIENT_IP")) {
            $cip = getenv("HTTP_CLIENT_IP");
        } else {
            $cip = "unknown";
        }
        return $cip;
    }

    protected function filterText($text)
    {
        return str_replace(array('#', '%', '&', '+'), array('＃', '％', '＆', '＋'), $text);
    }
}
