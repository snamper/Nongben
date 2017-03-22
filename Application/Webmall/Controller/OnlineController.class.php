<?php
namespace Webmall\Controller;

use Think\Controller;

class OnlineController extends Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function online(){
        $this->display();
    }
}