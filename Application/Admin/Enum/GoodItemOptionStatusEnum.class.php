<?php

namespace Admin\Enum;

use Org\Util\Enum;

class GoodItemOption2StatusEnum extends Enum{
    const ACTIVE = 1;
    const DELETE = 99;

    static $desc = array(
        'ACTIVE'=>'正常',
        'DELETE'=>'删除',
    );
}