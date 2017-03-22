<?php

namespace Admin\Enum;

use Org\Util\Enum;

class VideoStatusEnum extends Enum{
    const ACTIVE = 1;
    const DISABLED = 2;

    static $desc = array(
        'ACTIVE'=>'启用',
        'DISABLED'=>'禁用',
    );
}