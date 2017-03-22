<?php

namespace Admin\Enum;

use Org\Util\Enum;

class UserPlaceEnum extends Enum{

    const HOME = 1;
    const ADMIN = 2;
    const GROUP = 3;

    static $desc = array(
        'HOME'=>'网页前台',
        'ADMIN'=>'网页后台',
        'GROUP'=>'手机前台'
    );
}