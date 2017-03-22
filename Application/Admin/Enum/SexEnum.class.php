<?php

namespace Admin\Enum;

use Org\Util\Enum;

class SexEnum extends Enum{
    const MALE = 1;
    const FEMALE = 2;

    static $desc = array(
        'MALE'=>'男',
        'FEMALE'=>'女',
    );
}