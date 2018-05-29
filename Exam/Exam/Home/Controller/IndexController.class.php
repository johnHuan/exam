<?php
namespace Home\Controller;
use Home\Common\Functions;
use Think\Controller;

/**
 * Class IndexController
 * @package Home\Controller
 * 个人中心控制器， 包括：
 * 1、留言板
 * 2、个人信息录入
 * 3、个人信息中心
 * 4、个人信息修改
 */
class IndexController extends Controller {

    /**
     * 屏蔽空操作方法
     */
    public function _empty(){
        $this->display('error');
    }

    public function index(){
        $user = Functions::auth();


        $this->display();
    }


}