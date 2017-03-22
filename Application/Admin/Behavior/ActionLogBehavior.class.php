<?php

namespace Admin\Behavior;
use Admin\Enum\LogStatusEnum;
use Admin\Enum\UserPlaceEnum;
use Org\Util\Enum;
use Think\Behavior;

class ActionLogBehavior extends Behavior {

    public function run(&$content){
        if(IS_LOG){
            session(C('SESSION_OPTIONS'));
            $manager = session('manager_auth');

            if(IS_POST){
                $request = array_merge(I('post.'),I('get.'));
                unset($request['page_index']);
                unset($request['page_size']);
                unset($request['password']);

                if($request){
                    $data=array(
                        'account_type' => UserPlaceEnum::ADMIN,
                        'account_id' => $manager['id'],
                        'operate_name' => CONTROLLER_NAME ,
                        'operate_params' => empty($request) ? '' : json_encode($request,JSON_UNESCAPED_UNICODE ),
                        'operate_url' => __ACTION__ ,
                        'target' => '',
                        'operate' => ACTION_NAME ,
                    );
                    $Log = D('Log');

                    $Log->create($data);
                    $Log->add();
                }
            }
        }
    }
}