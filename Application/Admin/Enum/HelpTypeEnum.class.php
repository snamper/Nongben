<?php

namespace Admin\Enum;

use Org\Util\Enum;

class HelpTypeEnum extends Enum{
    const ARTICLE = 1;
    const LINK = 2;

    static $desc = array(
        'ARTICLE'=>'文章',
        'LINK'=>'链接',
    );
}