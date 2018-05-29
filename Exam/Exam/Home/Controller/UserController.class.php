<?php
/**
 * Created by PhpStorm.
 * Author: zhanghuan
 * Date: 2018/4/20
 * Time: 15:35
 * Developer: 张桓
 * QQ: 248404941
 * Email: yz30.com@aliyun.com
 * 　　　　　　　　　　　　　　　 _ooOoo_
 * 　　　　　　　　　　　　　　　o8888888o
 * 　　　　　　　　　　　　　　　88" . "88
 * 　　　　　　　　　　　　　　　(| -_- |)
 * 　　　　　　　　　　　　　　　 O\ = /O
 * 　　　　　　　　　　　　　 ____/`---'\____
 * 　　　　　　　　　　　　 .   ' \\| |// `.
 * 　　　　　　　　　　　　 / \\||| : |||// \
 * 　　　　　　　　　　　　/ _||||| -:- |||||- \
 * 　　　　　　　　　　　     | | \\\ - /// | |
 * 　　　　　　　　　　　　　| \_| ''\---/'' | |
 * 　　　　　　　　　　　　 \ .-\__ `-` ___/-. /
 * 　　　　　　　　　　 ___`. .' /--.--\ `. . __
 * 　　　　　　　　 ."" '< `.___\_<|>_/___.' >'"".
 * 　　　　　　　　| | : `- \`.;`\ _ /`;.`/ - ` : | |
 * 　　　　　　　　   \ \ `-. \_ __\ /__ _/ .-` / /
 * 　　　　　======`-.____`-.___\_____/___.-`____.-'======
 * 　　　　　　　　　　　　　　　 `=---='
 * 　　　　　 .............................................
 * 　　　　　　　　　　佛祖保佑             永无BUG
 * 　　　　　佛曰:
 * 　　　　　　　　　　写字楼里写字间，写字间里程序员；
 * 　　　　　　　　　　程序人员写程序，又拿程序换酒钱。
 * 　　　　　　　　　　酒醒只在网上坐，酒醉还来网下眠；
 * 　　　　　　　　　　酒醉酒醒日复日，网上网下年复年。
 * 　　　　　　　　　　但愿老死电脑间，不愿鞠躬老板前；
 * 　　　　　　　　　　奔驰宝马贵者趣，公交自行程序员。
 * 　　　　　　　　　　别人笑我忒疯癫，我笑自己命太贱；
 * 　　　　　　　　　　不见满街漂亮妹，哪个归得程序员？
 */

namespace Home\Controller;


use Think\Controller;

class UserController extends Controller
{

    /**
     * 用户控制器的首页还是跳转到首页控制器的index方法
     */
    public function index(){
        $this->display('index/index');
    }


    /**
     * 收藏夹--入口
     */
    public function collection(){
        $user = session("user");
        $uid = $user["uid"];
        $modelCollectionJ = M("usercollectionquestionjudgment");
        $modelCollectionS = M("usercollectionquestionselection");
        $jCount = $modelCollectionJ->where("uid = {$uid}")->count();
        $sCount = $modelCollectionS->where("uid = {$uid}")->count();

        $assign["nickname"] = $user["nickname"];
        $assign["jCount"] = $jCount;
        $assign["sCount"] = $sCount;
        $this->assign("data", $assign);

        $this->display();
    }

    /**
     * 错题本入口
     */
    public function errorBook(){
        $user = session("user");
        $uid = $user["uid"];
        $modeUser = M("user");
        $modelCollectionJ = M("usererrorquestionjudgment");
        $modelCollectionS = M("usererrorquestionselection");
        $jCount = $modelCollectionJ->where("uid = {$uid}")->count();
        $sCount = $modelCollectionS->where("uid = {$uid}")->count();

        $assign["nickname"] = $user["nickname"];
        $assign["jCount"] = $jCount;
        $assign["sCount"] = $sCount;
        $this->assign("data", $assign);

        $this->display();
    }

    /**
     * 收藏夹--判断题
     */
    public function cjudgement(){
        $modelJudgment = M("usercollectionquestionjudgment");
        $uid = session("user")["uid"];
        $data = $modelJudgment->where("uid = {$uid}")->select();
//        dump($data);
        $this->display();
    }

    /**
     * 收藏夹--选择题
     */
    public function cselection(){
        $modelJudgment = M("usercollectionquestionselection");
        $uid = session("user")["uid"];
        $data = $modelJudgment->where("uid = {$uid}")->select();
//        dump($data);
        $this->display();
    }


    /**
     * 错题本--判断题
     */
    public function ejudgement(){
       echo "错题本--判断题";
    }


    /**
     * 错题本--选择题
     */
    public function eselection(){
        echo "错题本--选择题";
    }



}