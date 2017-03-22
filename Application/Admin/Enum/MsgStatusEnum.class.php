<?php
namespace Admin\Enum;
use Org\Util\Enum;

class MsgStatusEnum extends Enum{
    const READ = 2;
    const UNREAD = 1;
    const DELETE = 99;

    static $desc = array(
        READ => '已回复',
        UNREAD => '未回复',
        DELETE =>'删除',
    );
}