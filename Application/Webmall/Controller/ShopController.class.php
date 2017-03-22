<?php
namespace Webmall\Controller;
use Think\Controller;

class ShopController extends Controller {

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 商城
     */
    public function shop(){
        $this->display();
    }


}