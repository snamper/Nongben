<?php
namespace Webmall\Controller;

use Think\Controller;


class EmptyController extends Controller
{

    public function index(){
        //空控制器
        exit('<h3>403 forbidden</h3>');
    }

}