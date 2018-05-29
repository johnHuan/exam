<?php
/**
 * Created by PhpStorm.
 * Author: zhanghuan
 * Date: 2018/4/14
 * Time: 21:20
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
use Home\Common\Functions;

/**
 * Class ExamController
 * @package Home\Controller
 * 在线考试控制器
 * 1、随机练习
 * 2、顺序练习
 * 3、错题专项
 * 4、收藏夹专项
 * 5、在线考试
 */
class ExamController extends Controller
{
    /**
     * 首页认证控制器
     */
    public function index()
    {
        $user = Functions::auth();
        $modelUser = M("User");
        $user1 = $modelUser->where("uid = {$user['uid']}")->find();
        if ($user1["p_j_state"] == 1 && $user1["p_s_state"] == 1) {
            $exam = true;
        } else {
            $exam = false;
        }
        $this->assign("canExam", $exam);
        $this->assign("user", $user1);
        $this->display();
    }

    /**
     * 请求本次考试题目
     */
    public function examAuth()
    {
        $user = session("user");
        $model = M("User");
        $unique = I("unique");
        $data = array('exam_num' => $unique + 1);
        $res = $model->where("uid = {$user['uid']}")->setField($data);
        if ($res) {
            $modelJudgment = M("judgment");
            $modelSelection = M("selection");
            $modelExams = M("Exams");
            $maxSelection = $modelSelection->count();
            $maxJudgment = $modelJudgment->count();
            $idsJudgment = Functions::unique_rand(1, $maxJudgment, 5);
            $idsSelection = Functions::unique_rand(1, $maxSelection, 15);
            $idsJudgmentStr = implode(",", $idsJudgment);
            $idsSelectionStr = implode(",", $idsSelection);
            $data1["uid"] = $user["uid"];
            $data1["jids"] = $idsJudgmentStr;
            $data1["sids"] = $idsSelectionStr;
            $res1 = $modelExams->add($data1);
            if ($res1) {
                $this->redirect("exam");
            } else {
                $this->error("系统异常，请重试");
            }
        } else {
            $this->error("题目请求失败, 请重试");
        }
    }

    /**
     * 在线考试
     * @param null $id
     */
    public function exam($id = null)
    {

        $modelExams = M("Exams");
        $uid = session("user")["uid"];
        $examsData = $modelExams->where("uid = {$uid}")->order("eid desc")->limit(1)->find();
        $idsJudgmentStr = $examsData["jids"];
        $idsSelectionStr = $examsData["sids"];

        $order = array_merge(explode(',', $idsJudgmentStr), explode(",", $idsSelectionStr));
        $modelJudgment = M("Judgment");
        $modelSelection = M("Selection");
        $modelSelectionAnswer = M("Selectionanswer");
        $this->assign("terminate", $examsData["chance"]);
        $this->assign("disable", $examsData["flag"]);
        /**
         * 作答之前的渲染页面
         */
        if (!IS_POST) {
            if (empty($id)) {
                // 不传值的时候默认第一题
                $question = $modelJudgment->where("jid = {$order[0]}")->find();
                $this->assign("id", 1);
                $this->assign("question", $question);
                $id = 0;
            } else if ($id < 5) {
                // 前五道题是判断题
                $question = $modelJudgment->where("jid = {$order[$id]}")->find();
                $this->assign("question", $question);
                $this->assign("id", $id);
            } else if ($id >= 5) {
                // 后十五道题是选择题
                $question = $modelSelection->where("sid = {$order[$id]}")->find();
                $answer = $modelSelectionAnswer->where("sid = {$question['sid']}")->select();

                $this->assign("question", $question);
                $this->assign("answer", $answer);
            }
            $this->assign("id", $id);
        } else {
            // 作答了之后的处理
            $data = $_POST;
            $currentEid = $modelExams->field("MAX(eid) e")->where("uid = {$uid}")->find()["e"];
            if ($data['id'] < 5) {
                // 判断题
                $question = $modelJudgment->where("jid = {$order[$data['id']]}")->find();
                if ($data["answer"] == $question["answer"]) {
                    // 回答正确
                    $res["flag"] = true;
                    $res["count"] = $examsData['chance'];
                    $this->ajaxReturn($res);
                } else {
                    // 回答错误
                    $modelErrorJ = M("usererrorquestionjudgment");
                    $jdata["uid"] = $uid;
                    $jdata["jid"] = $question["jid"];
                    $modelErrorJ->add($jdata);
                    $d['chance'] = $examsData['chance'] - 1;
                    $r = $modelExams->where("eid = {$currentEid}")->data($d)->save();
                    $res["flag"] = false;

                    if ($d['chance'] == 0) {
                        $res["count"] = 0;
                    } else {
                        $res["count"] = $d["chance"];
                    }
                    $this->ajaxReturn($res);
                }
            } else {
                // 选择题
                $question = $modelSelection->where("sid = {$order[$data['id']]}")->find();
                if ($data["answer"] != $question["answer"]) {
                    // 回答错误
                    $modelErrorS = M("usererrorquestionselection");
                    $jdata["uid"] = $uid;
                    $jdata["sid"] = $question["sid"];
                    $modelErrorS->add($jdata);
                    $d['chance'] = $examsData['chance'] - 1;

                    $r = $modelExams->where("eid = {$currentEid}")->data($d)->save();
                    $res["flag"] = false;
                    if ($data["id"] < 19){
                        // 还没到最后一题
                        if ($d['chance'] == 0) {
                            $res["count"] = 0;
                        } else {
                            $res["count"] = $d["chance"];
                        }
                    } else {
                        // 到最后一题了需要自动提交
                        if ($d['chance'] >= 0){
                            // 最后一题答错了，但是用了复活机会，通过了考试
                            $modelUser = M("user");
                            $user = $modelUser->where("uid = {$uid}")->find();
                            $da["state"] = $user["state"] + 1;
                            $res1 = $modelUser->where("uid = {$uid}")->data($da)->save();
                            $d1['flag'] = 1;
                            $res2 = $modelExams->where("eid = {$currentEid}")->data($d1)->save();
                            $res["flag"] = false;
                            $res["count"] = $d['chance'];
                            $res["success"] = true;
                            $this->ajaxReturn($res);
                        } else {
                            // 最后一题答错了，恰好没有复活机会了， 则依然视为不合格
                            $res["count"] = $d['chance'];
                            $res["flag"] = false;
                            $this->ajaxReturn($res);
                        }
                    }
                    $this->ajaxReturn($res);
                } else {
                    if ($data['id'] < 19){
                        // 6~19题都回答正确
                        $res["flag"] = true;
                        $res["count"] = $examsData['chance'];
                        $this->ajaxReturn($res);
                    } else {
                        // 最后一题回答正确，自动交卷
                        $modelUser = M("user");
                        $user = $modelUser->where("uid = {$uid}")->find();
                        $da["state"] = $user["state"] + 1;
                        $res1 = $modelUser->where("uid = {$uid}")->data($da)->save();
                        $d1['flag'] = 1;
                        $res2 = $modelExams->where("eid = {$currentEid}")->data($d1)->save();
                        $res["flag"] = true;
                        $res["count"] = $examsData['chance'];
                        $res["success"] = true;
                        $this->ajaxReturn($res);
                    }
                }
            }
        }

        $this->display();
    }

    /**
     * 加入收藏夹
     */
    public function addFav()
    {
        if (IS_POST) {

            $jid = $_POST["jid"];
            $id = $_POST["id"];
            $uid = session("user")["uid"];
            $modelcollectionJ = M("usercollectionquestionjudgment");
            $modelcollectionS = M("usercollectionquestionselection");
            if ($id < 5) {
                // 判断题
                $res = $modelcollectionJ->where("uid = {$uid} and jid = {$jid}")->count();
                if ($res > 0) {
                    $this->ajaxReturn(0);
                } else {
                    $data["uid"] = $uid;
                    $data["jid"] = $jid;
                    $res = $modelcollectionJ->add($data);
                    $this->ajaxReturn($res);
                }
            } else {
                // 选择题
                $res = $modelcollectionS->where("uid = {$uid} and sid = {$jid}")->count();
                if ($res > 0) {
                    $this->ajaxReturn(0);
                } else {
                    $data["sid"] = $jid;
                    $data["uid"] = $uid;
                    $res = $modelcollectionS->add($data);
                    $this->ajaxReturn($res);
                }
            }
        }
    }


}