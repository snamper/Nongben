<?php

namespace Admin\Enum;

use Org\Util\Enum;

class PromotionStatusEnum extends Enum{
    const ACTIVE = 1;
    const DISABLED = 99;


    static $desc = array(
        'ACTIVE'=>'正常',
        'DISABLED'=>'禁用',
    );
}