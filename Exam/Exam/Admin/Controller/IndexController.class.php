<?php
namespace Admin\Controller;
use Admin\Model\AdminModel;
use Think\Controller;
use Think\Verify;

class IndexController extends Controller {
    /**
     * 屏蔽空操作方法
     */
    public function _empty(){
        $this->display('404');
    }

    /**
     * 首页用户登录
     */
    public function index(){
        if (IS_POST){
            $verify = new Verify();
            if ($verify->check($_POST['captcha'])){
                $admin = new AdminModel();
                $info = $admin->getData(trim($_POST['account']), trim($_POST['password']));
                if($info == 0){
                    $this->error("账号不存在");
                } else if($info == -1){
                    $this->error("密码错误");
                } else {
                    //登录成功session持久化用户信息
                    session('admin', $info);
                    $this->redirect("Home/index");
                }
            } else {
                $this->error("验证码错误");
            }
        } else {
            $this->display();
        }
    }


    /**
     * 验证码
     */
    public function verifyImg(){

        $cfg = array(
            'imageH' => 45,
            'imageW' => 200,
            'length' => 5,
            'useCurve'  =>  false,
            'useNoise'  =>  true,
            'bg'        =>  array(253, 251, 254),
            'fontSize' => 20,
            'useCurve'  =>  true,
            'fontttf'   =>  '4.ttf',

        ) ;
        $vry = new Verify($cfg);
        $vry->entry();
    }
}