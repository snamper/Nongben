<?php
/**
 * Created by IntelliJ IDEA.
 * User: wangchao
 * Date: 9/7/15
 * Time: 4:49 PM
 */

namespace Vendor\Payment\Alipay;

class AlipayConfig
{
    protected static $settings;

    public static function getSettings()
    {
        return self::$settings;
    }

    public static function setSettings($settings)
    {
        self::$settings = $settings;
    }
}
