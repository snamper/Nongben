<?php

namespace Admin\Enum;

use Org\Util\Enum;

class SkuTypeEnum extends Enum{
    const LABEL = '1';
    const IMG = '2';

    static $desc = array(
        'LABEL'=>'文字',
        'IMG'=>'图片',
    );
}