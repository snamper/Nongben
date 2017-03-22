<?php

namespace Admin\Enum;

use Org\Util\Enum;

class ReserveSmsStatusEnum extends Enum{
    const WAIT = 1;
    const SUCCESS = 2;
    const FAIL = 3;
    const DELETE = 99;

    static $desc = array(
        'WAIT'=>'待发送',
        'SUCCESS'=>'发送成功',
        'FAIL'=>'接收失败',
        'DELETE'=>'已删除',
    );
}