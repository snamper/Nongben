<?php
namespace Vendor\Payment\Alipay;

use Vendor\Payment\CommonUtil;
use Vendor\Payment\Request;

class AlipayRequest extends Request
{

    protected $url = 'https://mapi.alipay.com/gateway.do';

    public function form()
    {
        $form = array();
        $form['action'] = $this->url;
        $form['method'] = 'post';
        $form['params'] = $this->convertParams($this->params);
        return $form;
    }


    protected function convertParams($params)
    {
        $converted = array();

        // 基本参数
        if ($this->getPaymentType() == 'dualfun') {
            $converted['service'] = 'trade_create_by_buyer';
        } elseif ($this->getPaymentType() == 'escow') {
            $converted['service'] = 'create_partner_trade_by_buyer';
        } elseif($this->getPaymentType() == 'wap'){
            $converted['service'] = 'alipay.wap.create.direct.pay.by.user';
        }else {
            $converted['service'] = 'create_direct_pay_by_user';
        }

        $converted['partner'] = $this->options['partner'];
        $converted['_input_charset'] = 'utf-8';
        $converted['sign_type'] = 'MD5';

        // 业务参数
        $converted['out_trade_no'] = $params['orderSn'];
        if( $this->getPaymentType() == 'wap'){
            $converted['subject'] = mb_substr($this->filterText($params['title']), 0, 20, 'utf-8');
        } else {
            $converted['subject'] = mb_substr($this->filterText($params['title']), 0, 64, 'utf-8');

        }
        $converted['payment_type'] = 1;

        if (in_array($this->getPaymentType(), array('dualfun', 'escow'))) {
            $converted['price'] = $params['amount'];
            $converted['quantity'] = 1;
            $converted['logistics_type'] = 'POST';
            $converted['logistics_fee'] = '0.00';
            $converted['logistics_payment'] = 'BUYER_PAY';
        } else {
            $converted['total_fee'] = $params['amount'];
        }

        $converted['seller_id'] = $this->options['partner'];

        if (!empty($this->options['notify_url'])) {
            $converted['notify_url'] = $this->options['notify_url'];
        }

        if (!empty($this->options['return_url'])) {
            $converted['return_url'] = $this->options['return_url'];
        }

        if (!empty($this->options['show_url'])) {
            $converted['show_url'] = $this->options['show_url'];
        }

        if (!empty($params['summary'])) {
//            $converted['body'] = $this->filterText($params['summary']);
            $converted['body'] = mb_substr($this->filterText($params['summary']), 0, 64, 'utf-8');
        }

        $converted['sign'] = CommonUtil::signParams($converted, $this->options['key']);

        return $converted;
    }

    protected function filterText($text)
    {
        return str_replace(array('#', '%', '&', '+'), array('＃', '％', '＆', '＋'), $text);
    }

    private function getPaymentType()
    {
        return empty($this->options['type']) ? 'direct' : $this->options['type'];
    }
}
