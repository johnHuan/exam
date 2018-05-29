<?php
/**
 * Created by PhpStorm.
 * Author: zhanghuan
 * Date: 2018/4/8
 * Time: 10:04
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

namespace Admin\Controller;


use Admin\Common\FilterController;

class UserController extends FilterController
{

    public $tablename = "user";
    public $fatherno = "";
    public $lang = "用户";
    public function index(){
        $this->lists();
    }

    public function lists()
    {
        $mod = D($this->tablename);
        $this->fatherno = $GLOBALS["g_content"]["classno"];

        $where["uid"] = array('gt', 0);
        $nickname = I("nickname");
        $state = I("state");

        if ($nickname != "") {
            $where["username"] = array('like', "%" . $nickname . "%");
        }
        if ($state != "") {
            $where["state"] = array('eq', $state);
        }
        $wh['_string'] = " fatherno='".$this->fatherno."' ";

        $count = $mod->where($where)->count();

        $item["rowcountz"]=$count;

        $pagesize=20; //分页分几条
        $page = new \Think\Page($count,$pagesize,'','page');//thinkphp 3.2

        $show = $page->show();
        $list = $mod->where($where)->order('uid desc')->limit($page->firstRow . "," . $page->listRows)->select();
        foreach ($list as $key => $val) {
            switch ($val["state"]){
                case '1':
                    $list[$key]["state"] = "已通过";
                    break;
                case '0':
                    $list[$key]["state"] = "未通过";
                    break;
            }
        }
        $item["num"] = count($list);

        $this->assign('rootlist', json_decode(C("root"), true));
        $this->assign('statelist', json_decode(C("state"), true));
        $this->assign('list', $list);
        $this->assign('webtitle', $this->lang . "列表");
        $this->assign('mytitle', "<i class='i-n'>用户</i>列表");
        $this->assign('list', $list);

        $this->assign('item', $item);
        $this->assign('show', $show);

        $this->display("lists");
    }

    public function getcaption($str, $value)
    {

        $caption = "";

        $list = json_decode($str, true);
        foreach ($list as $row) {
            if (trim($row["value"]) == trim($value)) {
                $caption = $row["name"];
            }
        }

        return $caption;
    }
}