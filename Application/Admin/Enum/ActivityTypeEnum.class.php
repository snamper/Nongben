<?php

namespace Admin\Enum;

use Org\Util\Enum;

class ActivityTypeEnum extends Enum{
    const REDUCE = 1;
    const DISCOUNT = 2;
    const EACHREDUCE = 3;
    const EACHDISCOUNT = 4;
    //const DELETE = 99;
//优惠方式 1:减价促销, 2:打折优惠  3满减优惠  4满额打折
    static $desc = array(
        'REDUCE'=>'减价促销',
        'DISCOUNT'=>'打折优惠',
        'EACHREDUCE'=>'满减优惠',
        'EACHDISCOUNT'=>'满额打折',
    );
}