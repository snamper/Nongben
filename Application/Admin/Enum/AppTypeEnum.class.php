<?php

namespace Admin\Enum;

use Org\Util\Enum;

class AppTypeEnum extends Enum{

    // 1:官网 2：商城
    const WEBSITE = 1;
    const SHOP = 2;

    static $desc = array(
        'WEBSITE'=>'官网',
        'SHOP'=>'商城',
    );
}