<?php

namespace Admin\Enum;

use Org\Util\Enum;

class CategoryTypeEnum extends Enum{

    // 1:官网帮助 2：官网视频 3：商城帮助 4:商品分类
    const WEBSITE_HELP = 1;
    const WEBSITE_VIDEO = 2;
    const SHOP_HELP = 3;
    const SHOP_CATEGORY = 4;

    static $desc = array(
        'WEBSITE_HELP'=>'官网帮助',
        'WEBSITE_VIDEO'=>'官网视频',
        'SHOP_HELP'=>'商城帮助',
        'SHOP_CATEGORY'=>'诊断类别',
    );
}