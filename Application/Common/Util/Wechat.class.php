<?php

namespace Common\Util;
use Org\Net\HttpClient;

/**
 * Class Page
 * @package Common\Util
 */
class Wechat
{
    protected  $appId;
    protected  $appSecret;
    protected  $http_client;
    protected  $accessToken;

    public function __construct(){
        $config = C('WECHAT');
        $this->appId = $config['APPID'];
        $this->appSecret = $config['APPSECRET'];

        $this->http_client = new HttpClient();

        // 获取access_token
        $this->accessToken = $this->get_access_token();
    }

    /**
     * 获取微信的access_token
     * @return mixed
     */
    public function get_access_token(){
        $Config = D('Admin/Config','Logic');

        $system_config = array();

        // 读取数据库中的配置数组
        $config_arr = $Config->get_wechat_config(array('access_token','access_token_regtime'));

        foreach ($config_arr as $key => $val)
        {
            $system_config[$val['name']] = trim($val['value']);
        }

        // 计算当前的过期时间
        $cur_exp_time = $system_config['access_token_regtime'] + 7200;

        if ($cur_exp_time >= time()) {
            // 当前时间小于过期时间
            $accessToken = $system_config['access_token'];
        }else{
            // 当前时间大于过期时间
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . $this->appId . "&secret=" . $this->appSecret;

            // 获取access_token
            $data        = $this->http_client->get($url);
            $resultArr   = json_decode($data, true);
            $accessToken = $resultArr["access_token"];

            // 更新数据库中的token值
            $Config->update_wechat_config('access_token',$accessToken);
            $Config->update_wechat_config('access_token_regtime',time());
        }
        return $accessToken;
    }

    /**
     * Autho2.0授权获取微信openid
     * @param $code
     * @return bool
     */
    public function get_user_openId($code){
        // 通过code换取网页授权access_token(此处access_token与上面的不同)
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=" . $this->appId . "&secret=" . $this->appSecret . "&code=" . $code . "&grant_type=authorization_code";

        $response = json_decode($this->http_client->get($url),true);
        if(!isset($response['errcode'])){
            return $response['openid'];
        }else{
            return false;
        }
    }

    /**
     * 获取微信用户基本信息
     * @param $openId
     * @return mixed
     */
    public function get_user_info($openId){
        $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=". $this->accessToken ."&openid=". $openId ."&lang=zh_CN";

        $data      = $this->http_client->get($url);

        $response = json_decode($data, true);

        if(!isset($response['errcode'])){
            return $response;
        }else{
            return false;
        }
    }

    /**
     * 获取使用js-sdk的tikcet
     */
    public function get_js_api_ticket(){
        $Config = D('Admin/Config','Logic');

        $system_config = array();

        // 读取数据库中的配置数组
        $config_arr = $Config->get_wechat_config(array('jsapi_ticket','jsapi_ticket_regtime'));

        foreach ($config_arr as $key => $val)
        {
            $system_config[$val['name']] = trim($val['value']);
        }

        // 计算当前的过期时间
        $cur_exp_time = $system_config['jsapi_ticket_regtime'] + 7200;

        if ($cur_exp_time >= time()) {
            // 当前时间小于过期时间
            $jsapiTicket = $system_config['jsapi_ticket'];
        }else{
            // 当前时间大于过期时间
            $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=" . $this->accessToken;

            // 获取access_token
            $data        = $this->http_client->get($url);
            $resultArr   = json_decode($data, true);
            $jsapiTicket = $resultArr["ticket"];

            // 更新数据库中的token值
            $Config->update_wechat_config('jsapi_ticket',$jsapiTicket);
            $Config->update_wechat_config('jsapi_ticket_regtime',time());
        }

        return $jsapiTicket;
    }

    /**
     * 生成签名包
     */
    public function get_sign_package(){
        $jsapiTicket = $this->get_js_api_ticket();

        // 注意 URL 一定要动态获取，不能 hardcode.
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $timestamp = time();
        $nonceStr = $this->createNonceStr();

        // 这里参数的顺序要按照 key 值 ASCII 码升序排序
        $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";

        $signature = sha1($string);

        $signPackage = array(
            "appId"     => $this->appId,
            "nonceStr"  => $nonceStr,
            "timestamp" => $timestamp,
            "url"       => $url,
            "signature" => $signature,
            "rawString" => $string
        );
        return $signPackage;
    }

    /**
     * 生成js的参数签名
     */
    public function get_sign_parameters($prepay_id){

        $timestamp = time();
        $nonceStr = $this->createNonceStr();

        $signParameters = array(
            "appId"     => $this->appId,
            "nonceStr"  => $nonceStr,
            "timestamp" => $timestamp,
            "signType"  => "MD5",
            "package"   => "prepay_id=$prepay_id",
        );

        $signParameters['paySign'] = $this->getSign($signParameters);
        return json_encode($signParameters);
    }

    /**
     * 生成随机字符串
     * @param int $length
     * @return string
     */
    public function createNonceStr($length = 16) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

    /**
     * 	作用：生成签名
     */
    public function getSign($data)
    {
        $config = C('PAY');
        foreach ($data as $k => $v)
        {
            $Parameters[$k] = $v;
        }
        //签名步骤一：按字典序排序参数
        ksort($Parameters);
        $String = $this->formatBizQueryParaMap($Parameters, false);

        //签名步骤二：在string后加入KEY
        $String = $String."&key=" . $config['MCH_SECRET'];

        //签名步骤三：MD5加密
        $String = md5($String);

        //签名步骤四：所有字符转为大写
        $result_ = strtoupper($String);

        return $result_;
    }

    /**
     *    作用：格式化参数，签名过程需要使用
     * @param $paraMap
     * @param $urlencode
     * @return string
     */
    public function formatBizQueryParaMap($paraMap, $urlencode)
    {
        $buff = "";
        ksort($paraMap);
        foreach ($paraMap as $k => $v)
        {
            if($urlencode)
            {
                $v = urlencode($v);
            }
            $buff .= $k . "=" . $v . "&";
        }
        $reqPar = '';
        if (strlen($buff) > 0)
        {
            $reqPar = substr($buff, 0, strlen($buff)-1);
        }
        return $reqPar;
    }

    /**
     * 将数组转化成XML
     * @param $array
     * @return string
     */
    public function toXml($array){
        $xml = '<xml>';
        forEach($array as $k=>$v){
            $xml.='<'.$k.'><![CDATA['.$v.']]></'.$k.'>';
        }
        $xml.='</xml>';
        return $xml;
    }

    /**
     * 解析XML字符串
     * @param $xmlSrc
     * @return array|bool
     */
    public function parseXML($xmlSrc){
        if(empty($xmlSrc)){
            return false;
        }
        $array = array();
        $xml = simplexml_load_string($xmlSrc);
        $encode = $this->getXmlEncode($xmlSrc);

        if($xml && $xml->children()) {
            foreach ($xml->children() as $node){
                //有子节点
                if($node->children()) {
                    $k = $node->getName();
                    $nodeXml = $node->asXML();
                    $v = substr($nodeXml, strlen($k)+2, strlen($nodeXml)-2*strlen($k)-5);

                } else {
                    $k = $node->getName();
                    $v = (string)$node;
                }

                if($encode!="" && $encode != "UTF-8") {
                    $k = iconv("UTF-8", $encode, $k);
                    $v = iconv("UTF-8", $encode, $v);
                }
                $array[$k] = $v;
            }
        }
        return $array;
    }

    /**
     * 获取XML字符串的编码
     * @param $xml
     * @return string
     */
    public function getXmlEncode($xml) {
        $ret = preg_match ("/<?xml[^>]* encoding=\"(.*)\"[^>]* ?>/i", $xml, $arr);
        if($ret) {
            return strtoupper ( $arr[1] );
        } else {
            return "";
        }
    }

    /**
     * 获取微信支付的token_id(和威富通公众账号支付接口对接)
     * @param $query
     * @return bool
     */
    public function getTokenId($query){
        $config = C('PAY');
        $http_client = new HttpClient();

        $data['service'] = 'pay.weixin.jspay';
        $data['mch_id'] = $config['MCH_ID'];
        $data['version'] = '1.0';

        $data['out_trade_no'] = $query['orderNo'];
        $data['body'] = $query['subject'];
        $data['sub_openid'] = $query['openId'];
        $data['total_fee'] = $query['money'];
        $data['mch_create_ip'] = get_client_ip();
        $data['notify_url'] = $query['notify_url'];
        $data['callback_url'] = $query['callback_url'];
        $data['nonce_str'] = $this->createNonceStr();

        $data['sign'] = $this->getSign($data);

        $response = $this->parseXML($http_client->post($config['W_HOST'],$this->toXml($data)));

        if($response['status'] == 0 && $response['result_code'] == 0){
            return $response['token_id'];
        }else{
            return false;
        }
    }

    /**
     * 退款接口
     * @param $query
     * @return bool
     */
    public function getRefund($query){
        $config = C('PAY');
        $http_client = new HttpClient();

        $data['service'] = 'unified.trade.refund';
        $data['mch_id'] = $config['MCH_ID'];
        $data['version'] = '1.0';

        $data['out_trade_no'] = $query['orderNo'];
        $data['out_refund_no'] = $query['refundNo'];
        $data['total_fee'] = $query['money'];
        $data['refund_fee'] = $query['refundMoney'];
        $data['op_user_id'] = $config['MCH_ID'];
        $data['nonce_str'] = $this->createNonceStr();

        $data['sign'] = $this->getSign($data);

        $response = $this->parseXML($http_client->post($config['W_HOST'],$this->toXml($data)));

        if($response['status'] == 0 && $response['result_code'] == 0){
            return $response['refund_id'];
        }else{
            return false;
        }
    }
}
