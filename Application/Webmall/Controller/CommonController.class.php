<?php
namespace Webmall\Controller;
use Think\Controller;
class CommonController extends Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function dialog(){
        $data = I('post.');
        $res = "<div class='d-tips-2'><em class='pa d-t-icon-2 d-t-wrong icon30'></em><p class='fsize14 c-666'>". $data['dialog_conent'] .
            "</p><div class='tac mt30'><a id='tisbutt' href='javascript:void(0)' title='' class='dClose order-submit'>确定</a></div></div>";

        $this->ajaxReturn($res,'TEXT');
    }
}