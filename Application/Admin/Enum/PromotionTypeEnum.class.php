<?php

namespace Admin\Enum;

use Org\Util\Enum;

class PromotionTypeEnum extends Enum{
    const GROUP = 1;
    const SEC = 2;

    static $desc = array(
        'GROUP'=>'团购',
        'SEC'=>'秒杀',
    );
}