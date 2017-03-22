<?php

namespace Admin\Enum;

use Org\Util\Enum;

class ActivityParticipantEnum extends Enum{
    const All = 1;
    const USER = 2;
    const AGENT = 3;

    static $desc = array(
        'All'=>'全体',
        'USER'=>'普通用户',
        'AGENT'=>'服务商',
    );
}