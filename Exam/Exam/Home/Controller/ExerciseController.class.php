<?php
/**
 * Created by PhpStorm.
 * Author: zhanghuan
 * Date: 2018/4/20
 * Time: 19:22
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


use Home\Common\Functions;
use Think\Controller;

class ExerciseController extends Controller
{

    /**
     * 练习， 首页认证控制器
     */
    public function index(){
        $user = Functions::auth();
        $modelUser = M("User");
        $user1 = $modelUser->where("uid = {$user['uid']}")->find();
        $this->assign("user", $user1);
        $this->display();
    }

    /**
     * 判断题作答
     * @param int $id
     */
    public function judgement($id = null){
        $uid = session("user")["uid"];
        $modelJudgment = M("Judgment");
        $modelUser = M("user");
        $total = $modelJudgment->count();
        $dat = $modelUser->where("uid = {$uid}")->find();
        if ($id == "" || $id == null){
            $id = $dat["p_jid"];
        }
        /**
         * 作答之前的渲染页面
         */
        if (!IS_POST) {
            $question = $modelJudgment->where("jid = {$id}")->find();
            $this->assign("question", $question);
            $this->assign("id", $id);
            $this->assign("total", $total);
            $this->display();
        } else {
            $data = $_POST;
            $jid = $data["jid"];
            $question = $modelJudgment->where("jid = {$jid}")->find();

            $user = $modelUser->where("uid = {$uid}")->find();
            if ($user["p_jid"] < $jid){
                // 做的是最新的题目，此时就需要更新练习题的编号
                $d['p_jid'] = $jid;
                $modelUser->where("uid = {$uid}")->save($d);
            } else {
                // 否则，做的不是最新的题， 可能是点击了上一题在复习， 什么都不操作

            }
            if ($jid == $total){
                $dd["end"] = true;
                $djs["p_j_state"] = 1;
                $modelUser->where("uid = {$uid}")->save($djs);
            } else {
                $dd["end"] = false;
            }
            if ($data["answer"] == $question["answer"]) {
                // 回答正确
                $dd["isRight"] = true;
                $this->ajaxReturn($dd);
            } else {
                // 回答错误
                $modelErrorJ = M("usererrorquestionjudgment");
                $jdata["uid"] = $uid;
                $jdata["jid"] = $question["jid"];
                $modelErrorJ->add($jdata);

                $dd["isRight"] = false;
                $this->ajaxReturn($dd);
            }
        }
    }


    /**
     * 选择题作答
     * @param int $id
     */
    public function selection($id = null){
        $uid = session("user")["uid"];
        $modelSelection = M("Selection");
        $modelSelectionAnswer = M("selectionanswer");
        $modelUser = M("user");
        $total = $modelSelection->count();
        $dat = $modelUser->where("uid = {$uid}")->find();
        if ($id == "" || $id == null){
            $id = $dat["p_sid"];
        }
        /**
         * 作答之前的渲染页面
         */
        if (!IS_POST) {
            $question = $modelSelection->where("sid = {$id}")->find();
            $sid = $question["sid"];
            $answer = $modelSelectionAnswer->where("sid = {$sid}")->select();
            $this->assign("question", $question);
            $this->assign("id", $id);
            $this->assign("total", $total);
            $this->assign("answer", $answer);
            $this->display();
        } else {
            $data = $_POST;
            $sid = $data["sid"];
            $question = $modelSelection->where("sid = {$sid}")->find();
            $user = $modelUser->where("uid = {$uid}")->find();
            if ($user["p_sid"] < $sid){
                // 做的是最新的题目，此时就需要更新练习题的编号
                $d['p_sid'] = $sid;
                $modelUser->where("uid = {$uid}")->save($d);
            } else {
                // 否则，做的不是最新的题， 可能是点击了上一题在复习， 什么都不操作

            }

            if ($sid == $total){
                $dd["end"] = true;
                $djs["p_s_state"] = 1;
                $modelUser->where("uid = {$uid}")->save($djs);
            } else {
                $dd["end"] = false;
            }

            if ($data["answer"] == $question["answer"]) {
                // 回答正确
                $dd["isRight"] = true;
                $this->ajaxReturn($dd);
            } else {
                // 回答错误
                $modelErrorS = M("usererrorquestionselection");
                $sdata["uid"] = $uid;
                $sdata["sid"] = $question["sid"];
                $modelErrorS->add($sdata);

                $dd["isRight"] = false;
                $this->ajaxReturn($dd);
            }
        }
    }



    /**
     * 判断题专项练习的收藏夹
     */
    public function addFav(){
        if (IS_POST){
            $jid = $_POST["jid"];
            $id = $_POST["id"];
            $uid = session("user")["uid"];
            $modelcollectionJ = M("usercollectionquestionjudgment");
            $res = $modelcollectionJ->where("uid = {$uid} and jid = {$jid}")->count();
            if ($res > 0) {
                $this->ajaxReturn(0);
            } else {
                $data["uid"] = $uid;
                $data["jid"] = $jid;
                $res = $modelcollectionJ->add($data);
                $this->ajaxReturn($res);
            }
        }
    }

    /**
     * 选择题专项练习的收藏夹
     */
    public function addFavS(){
        if (IS_POST){
            $sid = $_POST["sid"];
            $id = $_POST["id"];
            $uid = session("user")["uid"];
            $modelcollectionS = M("usercollectionquestionselection");
            $res = $modelcollectionS->where("uid = {$uid} and sid = {$sid}")->count();
            if ($res > 0) {
                $this->ajaxReturn(0);
            } else {
                $data["uid"] = $uid;
                $data["sid"] = $sid;
                $res = $modelcollectionS->add($data);
                $this->ajaxReturn($res);
            }
        }
    }




}