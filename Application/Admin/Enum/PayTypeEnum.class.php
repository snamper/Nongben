<?php

namespace Admin\Enum;

use Org\Util\Enum;

class PayTypeEnum extends Enum{

    const ALIPAY = 0;
    const WXPAY = 1;
    const ALIPAYWAP = 2;
    const WXPAYAPP = 3;
    const DHPAY = 4;


    static $desc = array(
        'ALIPAY'=>'支付宝即时到账',
        'WXPAY'=>'微信扫码支付',
        'ALIPAYWAP' =>  '支付宝WAP支付',
        'WXPAYAPP' =>  '微信APP支付',
        'DHPAY' =>  '逗哈钱包支付'
    );
}