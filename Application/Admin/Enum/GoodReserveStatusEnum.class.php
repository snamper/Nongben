<?php

namespace Admin\Enum;

use Org\Util\Enum;

class GoodReserveStatusEnum extends Enum{
    const INFORMED = 1;
    const UNNOTICE = 2;

    static $desc = array(
        'INFORMED'=>'已通知',
        'UNNOTICE'=>'未通知',
    );
}