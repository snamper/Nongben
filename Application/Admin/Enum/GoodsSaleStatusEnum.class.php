<?php

namespace Admin\Enum;

use Org\Util\Enum;

class GoodsSaleStatusEnum extends Enum{
    const ONSALE = 2;   // 上架
//    const SALING = 3;   // 销售中
//    const SOLDOUT = 4;   // 已售馨
    const OFFSALE = 5;   // 下架
//    const DELETE = 99;

    static $desc = array(
        'ONSALE'=>'上架',
//        'SALING'=>'销售中',
//        'SOLDOUT'=>'已售馨',
        'OFFSALE'=>'下架',
    );
}