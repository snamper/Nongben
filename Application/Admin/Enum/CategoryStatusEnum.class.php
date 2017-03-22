<?php

namespace Admin\Enum;

use Org\Util\Enum;

class CategoryStatusEnum extends Enum{

    //1:正常 2:禁用 99:删除
    const ACTIVE = 1;
    const DISABLED = 2;
    const DELETE = 99;

    static $desc = array(
        'ACTIVE'=>'正常',
        'DISABLED'=>'禁用',
        'DELETE'=>'删除',
    );
}