<?php

namespace Admin\Enum;

use Org\Util\Enum;

class CouponRangeEnum extends Enum{
    const ALL = 1;
    const PART = 2;

    static $desc = array(
        'ALL'=>'全部商品',
        'PART'=>'部分商品',
    );
}