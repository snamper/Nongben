<?php

namespace Admin\Enum;

use Org\Util\Enum;

class FocusStatusEnum extends Enum{
    const ACTIVE = 1;
    const EXPIRED = 2;
    const DISABLED = 0;

    static $desc = array(
        'ACTIVE'=>'启用',
        'EXPIRED'=>'过期',
        'DISABLED'=>'禁用',
    );
}