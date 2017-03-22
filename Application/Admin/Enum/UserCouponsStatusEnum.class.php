<?php

namespace Admin\Enum;

use Org\Util\Enum;

class UserCouponsStatusEnum extends Enum{
    const USED = 1;
    const UNUSED = 0;

    static $desc = array(
        'USED'=>'已使用',
        'UNUSED'=>'未使用',
    );
}