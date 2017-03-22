<?php

namespace Admin\Enum;

use Org\Util\Enum;

class GoodsAttrTypeEnum extends Enum{
    const COMMON_ATTR = 1;
    const SKU_ATTR = 2;

    static $desc = array(
        'SKU_ATTR'=>'销售规格',
        'COMMON_ATTR'=>'普通属性',
    );
}