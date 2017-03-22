<?php
namespace Common\Controller;
use Think\Controller;
use Website\Enum\CategoryTypeEnum;

class BasicController extends Controller {
    /**
     * @var \Website\Logic\HelpLogic
     */
    protected $helpLogic;
    /**
     * @var \Website\Logic\CategoryLogic
     */
    protected $categoryLogic;

    public function __construct(){
        parent::__construct();

        //是手机重定向到手机端
        if (isMobile()) {
            if(strtolower(MODULE_NAME) == 'Website'){
                $this->redirect(U('m/Index/index',array(),false));
            }
//
//            if(strtolower(MODULE_NAME) == 'webmall'){
//                $this->redirect(U('mall/Index/index',array(),false));
//            }
        }

        $this->helpLogic = D('Help','Logic');
        $this->categoryLogic = D('Category','Logic');

        // 获取头部信息
        $this->get_header();

        // 获取页面底部信息
        $this->get_footer();

        $this->check_login();

        $this->assign('callback',get_page_url());
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
            if ($value != '' || $value === 0) {
                $data[$key] = $value;
            }
        }
        return $data;
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
            $this->ajaxSuccess(null,$msg.'成功',$referer);
        }else{
            $this->ajaxError($msg.'失败',$referer);
        }
    }

    /**
     * 检查用户是否登录
     */
    protected function check_login(){
        if($this->is_login()){
            $this->assign('is_login',true);
            return true;
        }else{
            $this->assign('is_login',false);
            return false;
        }
    }

    /**
     * 获取页面头部信息
     */
    public function get_header(){
        $module = strtolower(CONTROLLER_NAME);
        $action = strtolower(ACTION_NAME);
        $group =  strtolower(MODULE_NAME);

        $keywords_str1 = '逗哈，逗哈科技，iTank，doohan，Doohan，杜汉，智能机车，新能源，智能，电动车，电动机车，双前轮，三轮车，倒三轮，摩托车，高品质，中国创造，创造，个性化，出行';

        $description_str1 = '逗哈科技由资深机车制造企业和知名投资机构联合打造的一家新能源出行设备的公司。专注于打造高品质、个性化、智能化的新能源电动机车；引领和创造一种“酷驾乘、玩不同”的全新出行方式。';
        $description_str2 = 'iTank概述主要介绍双前轮、设计、颜色、三电、性能、智能App、服务介绍等。';
        $description_str3 = 'iTank双前轮主要介绍双前轮的特性，有趣、安全、稳定，航空级锻铝材质，可侧倾偏摆的独立式悬挂系统，黄金三角稳定结构';
        $description_str4 = 'iTank性能，三电合一，18650，pack技术，德国博世电机，BMS智能电池管理系统，EABS电子刹车系统，';
        $description_str5 = 'iTank工艺设计，航空锻造铝合金，高性能国际轮胎，顶级Argon arc welding焊接工艺，整车防水，跑车级外壳拼接，';
        $description_str6 = 'iTank智能系统，防盗检测，陀螺仪，电量、里程显示。';
        $description_str7 = '快易维保，全时段，全过程，全方位。';

        $title_arr = array(
            'index' => array('index'=>'doohan首页'),
            'itank' => array('index'=>'iTank概述','smart'=>'iTank智能系统','wheel'=>'iTank双前轮','performance'=>'iTank性能','craftdesign'=>'iTank工艺设计','specs'=>'iTank参数',
                'image'=>'iTank图集'),
            'service' => array('index'=>'doohan服务','apply'=>'服务商加盟申请','process'=>'审核进度查询','result'=>'服务商审核结果'),
            'help' => array('index'=>'帮助中心','protocol'=>'用户协议'),
            'news' => array('index'=>'新闻动态'),
        );

        $keywords_arr = array(
            'index' => array('index'=>$keywords_str1),
            'itank' => array('index'=>$keywords_str1,'smart'=>$keywords_str1,'wheel'=>$keywords_str1,'performance'=>$keywords_str1,'craftdesign'=>$keywords_str1,'specs'=>$keywords_str1,
                'image'=>$keywords_str1),
            'service' => array('index'=>$keywords_str1),
            'help' => array('index'=>$keywords_str1,'protocol'=>$keywords_str1),
            'news' => array('index'=>$keywords_str1),
        );

        $description_arr = array(
            'index' => array('index'=>$description_str1),
            'itank' => array('index'=>$description_str2,'smart'=>$description_str6,'wheel'=>$description_str3,$description_str4,'craftdesign'=>$description_str5,'specs'=>'iTank参数',
                'image'=>'iTank图集'),
            'service' => array('index'=>$description_str7),
            'help' => array('index'=>$description_str1,'protocol'=>$description_str1),
            'news' => array('index'=>$description_str1),
        );

        $title = isset($title_arr[$module][$action]) ? $title_arr[$module][$action] : 'douhan首页';
        $keywords = isset($keywords_arr[$module][$action]) ? $keywords_arr[$module][$action] : $keywords_str1;
        $description = isset($description_arr[$module][$action]) ? $description_arr[$module][$action] : $description_str1;

        $this->assign('group',$group);
        $this->assign('module',$module);
        $this->assign('action',$action);
        $this->assign('title',$title);
        $this->assign('keywords',$keywords);
        $this->assign('description',$description);
    }

    /**
     * 获取页面底部信息
     */
    public function get_footer(){
        $category_conditions = $help_conditions =  array();
        $category_conditions['type'] = CategoryTypeEnum::WEBSITE_HELP;
        $helpCategoryList = $this->categoryLogic->getList($category_conditions);

        foreach($helpCategoryList as $key => $val){
            $help_conditions['category_id'] = $val['id'];
            $helpCategoryList[$key]['helpList'] = $this->helpLogic->getList($help_conditions);

            if(empty($helpCategoryList[$key]['helpList'])){
                unset($helpCategoryList[$key]);
            }
        }

        $this->assign('helpCategoryList',$helpCategoryList);

    }

    /**
     * 判断是否登陆
     * @return bool
     */
    public function is_login(){
//        var_dump($_SESSION['user_info']);
        if($_SESSION['user_info']){
            return true;
        }else{
            return false;
        }
    }
    
    
    
}