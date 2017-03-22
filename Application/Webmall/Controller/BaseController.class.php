<?php
namespace Webmall\Controller;

use Think\Controller;
use Think\Log;

class BaseController extends Controller
{
    protected $user;
    protected $url;

    public function __construct()
    {
        parent::__construct();
        $this->check_login();
    }

    /**
     * 成功返回
     * @param null $data
     * @param string $msg
     * @param string $referer
     * @param int $code
     */
    public function ajaxSuccess($data = null, $msg = '',$referer = '', $code = 200 )
    {
        $ajaxData = array();
        if (!$msg) $msg = "ok";

        $ajaxData['state'] = 'success';
        $ajaxData['message'] = $msg;
        $ajaxData['data'] = $data;
        $ajaxData['code'] = $code;
        $ajaxData['referer'] = $referer;

        $this->ajaxReturn($ajaxData);
    }

    /**
     * 失败返回
     * @param string $msg
     * @param string $referer
     * @param int $code
     */
    public function ajaxError($msg = '', $referer = '', $code = 300)
    {
        $ajaxData = array();
        if (!$msg) $msg = "fail";

        $ajaxData['state'] = 'fail';
        $ajaxData['message'] = $msg;
        $ajaxData['code'] = $code;
        $ajaxData['referer'] = $referer;

        $this->ajaxReturn($ajaxData);
    }

    /**
     * 自动定向成功失败
     * @param $flag
     * @param string $msg
     * @param string $referer
     */
    public function ajaxAuto($flag,$msg = '操作',$referer = ''){
        if($flag !== false){
            $this->ajaxSuccess($flag,$msg.'成功',$referer);
        }else{
            $this->ajaxError($msg.'失败',$referer);
        }
    }


    function log_write($path, $doc, $level = 'WARN')
    {
        $logpath = $path . date('y_m_d') . '.log';
        Log::write($doc, $level, '', $logpath);
    }

    /**
     * 获取有效数据
     */
    public function getAvailableData()
    {
        $data = array();

        $request = array_merge(I('get.'),I('post.'));
        unset($request['page_index']);
        unset($request['page_size']);

        foreach ($request as $key => $value) {
//            if ($value != '' || $value === 0) {
//                $data[$key] = $value;
//            }

            $data[$key] = $value;
        }
        return $data;
    }

    public function _empty()
    {
        $this->display();
    }

    /**
     * 检查用户是否登陆
     */
    protected function check_login(){
        if($mid = user_is_login()){
            $userLogic = D('User','Logic');
            $this->user = $userLogic->getById($mid);
        }/*else {
            $error = '请先登录！';
            $this->error($error,U('Public/index'));
        }*/

        C('TMPL_PARSE_STRING.__USER__', $this->user['id']);
    }
}