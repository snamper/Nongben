<?php

namespace Admin\Enum;

use Org\Util\Enum;

class ShippingStatusEnum extends Enum{
    const ACTIVE = 1;
    const DISABLED = 0;

    static $desc = array(
        'ACTIVE'=>'启用',
        'DISABLED'=>'禁用',
    );
}