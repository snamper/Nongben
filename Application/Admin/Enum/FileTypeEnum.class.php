<?php

namespace Admin\Enum;

use Org\Util\Enum;

class FileTypeEnum extends Enum{
    const WEBSITE = 1;
    const SHOP = 2;

    static $desc = array(
        'WEBSITE'=>'官网',
        'SHOP'=>'商城',
    );
}