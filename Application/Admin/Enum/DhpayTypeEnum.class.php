<?php

namespace Admin\Enum;

use Org\Util\Enum;

class DhpayTypeEnum extends Enum{
    const OPTFREEZE = 1;
    const OPTUNFREEZE = 2;
    const OPTDEDUCT = 3;
    const OPTAPPLYREFUND = 4 ;
    const OPTFINISHFUND = 5;
    const OPTCANCELREFUND = 6;
    const OPTQUERY = 99;
//    const DELETE = 99;

    static $desc = array(
        'OPTFREEZE'=>'冻结',
        'OPTUNFREEZE'=>'解冻',
        'OPTDEDUCT'=>'结算',
        'OPTAPPLYREFUND'=>'申请退款',
        'OPTFINISHFUND'=>'完成退款',
        'OPTCANCELREFUND'=>'取消退款',
        'OPTQUERY'=>'查询',
//        'DELETE'=>'删除',
    );
}