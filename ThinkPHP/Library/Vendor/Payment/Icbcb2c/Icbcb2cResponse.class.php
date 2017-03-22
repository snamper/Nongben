<?php
namespace Vendor\Payment\Icbcb2c;

use Vendor\Payment\Response;

class Icbcb2cResponse extends Response
{
    public static function xmlToArrayElement($xmlobject) {
        $data = array();
        foreach ((array) $xmlobject as $key => $value) {
            $data[$key] = !is_string($value) ? self::xmlToArrayElement($value) : $value;
        }
        return $data;
    }



    public function getPayData()
    {
        $params = $this->params;


        if (!$data = $this->isRightSign($params)) {
            throw new \RuntimeException('支付签名校验失败。');
        }
        $xml =  base64_decode($data);
        $xmlObj = simplexml_load_string($xml);

        if(!$xmlObj){
            throw new \RuntimeException('通知结果解析失败');
        }

        $xmlArr =  self::xmlToArrayElement(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA));

        $notify = array();
        $notify['sign'] = $params['merVAR'];
        $notify['merid'] = $xmlArr['orderInfo']['merID'];
        $notify['orderid'] = $xmlArr['orderInfo']['subOrderInfoList']['subOrderInfo']['orderid'];
        $notify['amount'] = $xmlArr['orderInfo']['subOrderInfoList']['subOrderInfo']['amount'];
        $notify['meracct'] = $xmlArr['orderInfo']['subOrderInfoList']['subOrderInfo']['merAcct'];
        $notify['tranno'] = $xmlArr['orderInfo']['subOrderInfoList']['subOrderInfo']['tranSerialNo'];
        $notify['bank_notifydate'] = $xmlArr['bank']['notifyDate'];
        $notify['bank_transtat'] = $xmlArr['bank']['tranStat'];
        $notify['bank_comment'] = $xmlArr['bank']['comment'];
        $notify['raw'] = $xmlArr;


//        print_r($notify);

        return $notify;
    }

    /**
     * 对返回数据验签
     * @param $params
     */
    private function isRightSign($params)
    {
        $sign = $this->sign($params['notifyData']);
//        print_r($sign);
        //加载扩展
        if (!extension_loaded('infosec')) {
            throw new \RuntimeException('签名扩展加载失败');
        }

        //获取通知明文
        $notifyData = $sign["notifyData"];
        if (strlen($notifyData) <= 0) {
            throw new \RuntimeException('通知结果为空');
            exit();
        }

        //获取密文
        $signMsg = $sign["signMsg"];
        if (strlen($signMsg) <= 0) {
            throw new \RuntimeException('通知签名为空');
        }

        //获取工行证书
        $bankCertFile = __DIR__ . '/cert/1225.crt';
        $fp = fopen($bankCertFile, "rb");
        if ($fp == NULL) {
            throw new \RuntimeException('公钥读取失败');
            exit();
        }
        fseek($fp, 0, SEEK_END);
        $filelen = ftell($fp);
        fseek($fp, 0, SEEK_SET);
        $bankCert = fread($fp, $filelen);
        fclose($fp);

        //解码签名数据
        $sign = base64dec($signMsg);
        //解码原文
        $plaint = base64dec($notifyData);
        //验签名
        $rv = verifySign(current($plaint), $bankCert, current($sign));
        if ($rv) {
            return false;
//            $ret = "verify error!";
        } else {
            return current($plaint);
        }
    }

    public function sign($notifyData)
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
        if (strlen($notifyData) <= 0) {
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
        $signature = sign($notifyData, $key, $certKeyPass);//签名
        $code = current($signature);//获取签名数据
        $len = next($signature);//获取签名数据长度
        $signcode = base64enc($code);//对签名数据BASE64编码
        $bankSignMsg = current($signcode);
        $notifyDataBase64 = current(base64enc($notifyData));//对通知数据BASE64编码


        $sign = array();
        $sign['signMsg'] = $bankSignMsg;
        $sign['notifyData'] = $notifyDataBase64;
        return $sign;
    }
}
