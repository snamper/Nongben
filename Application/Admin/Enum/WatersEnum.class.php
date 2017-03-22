<?php

namespace Admin\Enum;
use Org\Util\Enum;

class WatersEnum extends Enum{
    const ACTIVE = 1;
    const DISABLED = 2;

    static $desc = array(
        'ACTIVE'=>'淡水',
        'DISABLED'=>'海水',
    );
}