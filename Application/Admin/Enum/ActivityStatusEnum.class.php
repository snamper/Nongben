<?php

namespace Admin\Enum;

use Org\Util\Enum;

class ActivityStatusEnum extends Enum{
    const ACTIVE = 1;
    const DISABLED = 2;
    //const DELETE = 99;

    static $desc = array(
        'ACTIVE'=>'启用',
        'DISABLED'=>'禁用',
        //'DELETE'=>'删除',
    );
}