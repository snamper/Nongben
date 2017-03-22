<?php

namespace Admin\Enum;

use Org\Util\Enum;

class GoodsAttrShowTypeEnum extends Enum{
    const ENUM = 1;
    const STRING = 2;
    const TEXT = 3;
    const COLOR = 4;

    static $desc = array(
        'ENUM'=>'枚举',
        'STRING'=>'字串',
        'TEXT'=>'文本',
        'COLOR'=>'颜色',
    );
}