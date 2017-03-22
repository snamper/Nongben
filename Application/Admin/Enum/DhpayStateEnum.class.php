<?php

namespace Admin\Enum;

use Org\Util\Enum;

class DhpayStateEnum extends Enum{
    const SUCCESS = 1;
    const FAIL = 2;

    static $desc = array(
        'SUCCESS'=>'成功',
        'FAIL'=>'失败',
    );
}