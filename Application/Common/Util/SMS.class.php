<?php

namespace Common\Util;

use Org\Net\HttpClient;

class SMS {

    protected $base_url = 'http://smsapi.c123.cn/OpenPlatform/OpenApi?action=sendOnce&ac=1001@500814540001&authkey=DE2942F9130906C5805B07E418146FD9&cgid=718';

    /**
     * 发送短信
     * @param $mobile
     * @param $content
     * @return bool
     */
    public function sendMessage($mobile,$content){
        $http_client = new HttpClient();

        $url = $this->base_url . '&c=' . $content . '&m=' . $mobile;

        $response = $http_client->get($url);

        // 解析发送短信的响应信息
        $xml = simplexml_load_string($response);

        $result = intval($xml->attributes()->result);

        if($result == 1){
            return true;
        }else{
            return false;
        }
    }
}
  
