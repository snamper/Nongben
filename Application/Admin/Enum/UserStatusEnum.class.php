<?php

namespace Admin\Enum;

use Org\Util\Enum;

class UserStatusEnum extends Enum{
    const ACTIVE = 1;
    const DISABLE = 2;
    const DELETE = 99;

    static $desc = array(
        'ACTIVE'=>'正常',
        'DISABLE'=>'禁用',
        'DELETE'=>'删除',
    );
}