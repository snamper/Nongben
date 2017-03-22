<?php

namespace Admin\Enum;

use Org\Util\Enum;

class ActivityRangeEnum extends Enum{
    const ALL = 1;
    const PART = 2;

    static $desc = array(
        'ALL'=>'全部',
        'PART'=>'部分',
    );
}