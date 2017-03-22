<?php
namespace Vendor\Payment\Icbcb2c;

class Icbcb2cConfig
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
