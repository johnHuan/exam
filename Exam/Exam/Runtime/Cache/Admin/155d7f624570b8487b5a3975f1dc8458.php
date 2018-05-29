<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="Bookmark" href="/favicon.ico" >
    <link rel="Shortcut Icon" href="/favicon.ico" />

    <title>党政建设在线答题系统</title>

    <script src="/Exam/Public/js/jquery.min.js"></script>
    <script src="/Exam/Public/bootstrap/js/bootstrap.js"></script>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="/Exam/Public/lib/html5shiv.js"></script>
    <script type="text/javascript" src="/Exam/Public/lib/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="/Exam/Public/static/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="/Exam/Public/static/h-ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="/Exam/Public/lib/Hui-iconfont/1.0.8/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="/Exam/Public/static/h-ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="/Exam/Public/static/h-ui.admin/css/style.css" />
    <link rel="stylesheet" type="text/css" href="/Exam/Public/bootstrap/css/style.css" />
    <link rel="stylesheet" type="text/css" href="/Exam/Public/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="/Exam/Public/bootstrap/css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="/Exam/Public/bootstrap/css/bootstrap-override.css" />

    <!--[if IE 6]>
    <script type="text/javascript" src="/Exam/Public/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
<header class="navbar-wrapper">
    <div class="navbar navbar-fixed-top">
        <div class="container-fluid cl">
            <span class="logo navbar-logo f-l mr-10 hidden-xs">党政建设</span>
            <a class="logo navbar-logo-m f-l mr-10 visible-xs" href="/aboutHui.shtml"></a>
            <span class="logo navbar-slogan f-l mr-10 hidden-xs">在线答题系统  后台管理</span> <a aria-hidden="false" class="nav-toggle Hui-iconfont visible-xs" href="javascript:;">&#xe667;</a>
            <nav class="nav navbar-nav">
                <ul class="cl">
                    <li class="dropDown dropDown_hover"><a href="javascript:;" class="dropDown_A"><i class="Hui-iconfont">&#xe600;</i> 新增 <i class="Hui-iconfont">&#xe6d5;</i></a>
                        <ul class="dropDown-menu menu radius box-shadow">
                            <li><a href="javascript:;" onclick="article_add('添加资讯','article-add.html')"><i class="Hui-iconfont">&#xe616;</i> 资讯</a></li>
                            <li><a href="javascript:;" onclick="picture_add('添加资讯','picture-add.html')"><i class="Hui-iconfont">&#xe613;</i> 图片</a></li>
                            <li><a href="javascript:;" onclick="product_add('添加资讯','product-add.html')"><i class="Hui-iconfont">&#xe620;</i> 产品</a></li>
                            <li><a href="javascript:;" onclick="member_add('添加用户','member-add.html','','510')"><i class="Hui-iconfont">&#xe60d;</i> 用户</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
                <ul class="cl">
                    <li>超级管理员</li>
                    <li class="dropDown dropDown_hover"> <a href="#" class="dropDown_A">admin <i class="Hui-iconfont">&#xe6d5;</i></a>
                        <ul class="dropDown-menu menu radius box-shadow">
                            <li><a href="#">个人信息</a></li>
                            <li><a href="#">切换账户</a></li>
                            <li><a href="#">退出</a></li>
                        </ul>
                    </li>
                    <li id="Hui-msg"> <a href="#" title="消息"><span class="badge badge-danger">1</span><i class="Hui-iconfont" style="font-size:18px">&#xe68a;</i></a> </li>
                    <li id="Hui-skin" class="dropDown right dropDown_hover"> <a href="javascript:;" class="dropDown_A" title="换肤"><i class="Hui-iconfont" style="font-size:18px">&#xe62a;</i></a>
                        <ul class="dropDown-menu menu radius box-shadow">
                            <li><a href="javascript:;" data-val="default" title="默认（黑色）">默认（黑色）</a></li>
                            <li><a href="javascript:;" data-val="blue" title="蓝色">蓝色</a></li>
                            <li><a href="javascript:;" data-val="green" title="绿色">绿色</a></li>
                            <li><a href="javascript:;" data-val="red" title="红色">红色</a></li>
                            <li><a href="javascript:;" data-val="yellow" title="黄色">黄色</a></li>
                            <li><a href="javascript:;" data-val="orange" title="橙色">橙色</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>

<aside class="Hui-aside">
    <div class="menu_dropdown bk_2">
        <dl id="menu-article">
            <dt><i class="Hui-iconfont">&#xe616;</i> 考题管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a data-href="#" data-title="上传考题" href="<?php echo U('Exam/upload');?>">上传考题</a></li>
                    <li><a data-href="#" data-title="考题列表" href="<?php echo U('Exam/lists');?>">考题列表</a></li>
                </ul>
            </dd>
        </dl>
        <!--
         <dl id="menu-picture">
             <dt><i class="Hui-iconfont">&#xe613;</i> 图片管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
             <dd>
                 <ul>
                     <li><a data-href="picture-list.html" data-title="图片管理" href="javascript:void(0)">图片管理</a></li>
                 </ul>
             </dd>
         </dl>

        <dl id="menu-product">
             <dt><i class="Hui-iconfont">&#xe620;</i> 产品管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
             <dd>
                 <ul>
                     <li><a data-href="product-brand.html" data-title="品牌管理" href="javascript:void(0)">品牌管理</a></li>
                     <li><a data-href="product-category.html" data-title="分类管理" href="javascript:void(0)">分类管理</a></li>
                     <li><a data-href="product-list.html" data-title="产品管理" href="javascript:void(0)">产品管理</a></li>
                 </ul>
             </dd>
         </dl>
         <dl id="menu-comments">
             <dt><i class="Hui-iconfont">&#xe622;</i> 评论管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
             <dd>
                 <ul>
                     <li><a data-href="http://h-ui.duoshuo.com/admin/" data-title="评论列表" href="javascript:;">评论列表</a></li>
                     <li><a data-href="feedback-list.html" data-title="意见反馈" href="javascript:void(0)">意见反馈</a></li>
                 </ul>
             </dd>
         </dl>
         -->
        <dl id="menu-member">
            <dt><i class="Hui-iconfont">&#xe60d;</i> 考生管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a data-href="member-list.html" data-title="会员列表" href="<?php echo U('User/index');?>">会员列表</a></li>
                    <li><a data-href="member-del.html" data-title="删除的会员" href="javascript:;">删除的会员</a></li>
                    <li><a data-href="member-level.html" data-title="等级管理" href="javascript:;">等级管理</a></li>
                    <li><a data-href="member-scoreoperation.html" data-title="积分管理" href="javascript:;">积分管理</a></li>
                    <li><a data-href="member-record-browse.html" data-title="浏览记录" href="javascript:void(0)">浏览记录</a></li>
                    <li><a data-href="member-record-download.html" data-title="下载记录" href="javascript:void(0)">下载记录</a></li>
                    <li><a data-href="member-record-share.html" data-title="分享记录" href="javascript:void(0)">分享记录</a></li>
                </ul>
            </dd>
        </dl>
        <dl id="menu-admin">
            <dt><i class="Hui-iconfont">&#xe62d;</i> 管理员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a data-href="admin-list.html" data-title="管理员列表" href="<?php echo U('Admin/index');?>">管理员列表</a></li>
                    <li><a data-href="admin-role.html" data-title="角色管理" href="javascript:void(0)">角色管理</a></li>
                    <li><a data-href="admin-permission.html" data-title="权限管理" href="javascript:void(0)">权限管理</a></li>
                </ul>
            </dd>
        </dl>
        <dl id="menu-tongji">
            <dt><i class="Hui-iconfont">&#xe61a;</i> 系统统计<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a data-href="charts-1.html" data-title="折线图" href="javascript:void(0)">折线图</a></li>
                    <li><a data-href="charts-2.html" data-title="时间轴折线图" href="javascript:void(0)">时间轴折线图</a></li>
                    <li><a data-href="charts-3.html" data-title="区域图" href="javascript:void(0)">区域图</a></li>
                    <li><a data-href="charts-4.html" data-title="柱状图" href="javascript:void(0)">柱状图</a></li>
                    <li><a data-href="charts-5.html" data-title="饼状图" href="javascript:void(0)">饼状图</a></li>
                    <li><a data-href="charts-6.html" data-title="3D柱状图" href="javascript:void(0)">3D柱状图</a></li>
                    <li><a data-href="charts-7.html" data-title="3D饼状图" href="javascript:void(0)">3D饼状图</a></li>
                </ul>
            </dd>
        </dl>
        <dl id="menu-system">
            <dt><i class="Hui-iconfont">&#xe62e;</i> 系统管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a data-href="system-base.html" data-title="系统设置" href="<?php echo U('System/index');?>">系统设置</a></li>
                    <li><a data-href="system-category.html" data-title="栏目管理" href="javascript:void(0)">栏目管理</a></li>
                    <li><a data-href="system-data.html" data-title="数据字典" href="javascript:void(0)">数据字典</a></li>
                    <li><a data-href="system-shielding.html" data-title="屏蔽词" href="javascript:void(0)">屏蔽词</a></li>
                    <li><a data-href="system-log.html" data-title="系统日志" href="javascript:void(0)">系统日志</a></li>
                </ul>
            </dd>
        </dl>
    </div>
</aside>
<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
<section class="Hui-article-box">
    <ol class="breadcrumb" style="margin-bottom: 5px;">
        <li>Home</li>
        <li class="active">后台首页</li>
    </ol>
    <div id="iframe_box" class="Hui-article">
        <div class="page-container">
            <p class="f-20 text-success">后台首页</p>
            <p>登录次数：18 </p>
            <p>上次登录IP：<?php echo ($ip); ?>  上次登录时间：<?php echo ($time); ?></p>
            <table class="table table-border table-bordered table-bg">
                <thead>
                <tr>
                    <th colspan="7" scope="col">信息统计</th>
                </tr>
                <tr class="text-c">
                    <th>统计</th>
                    <th>资讯库</th>
                    <th>图片库</th>
                    <th>产品库</th>
                    <th>用户</th>
                    <th>管理员</th>
                </tr>
                </thead>
                <tbody>
                <tr class="text-c">
                    <td>总数</td>
                    <td>92</td>
                    <td>9</td>
                    <td>0</td>
                    <td>8</td>
                    <td>20</td>
                </tr>
                <tr class="text-c">
                    <td>今日</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                </tr>
                <tr class="text-c">
                    <td>昨日</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                </tr>
                <tr class="text-c">
                    <td>本周</td>
                    <td>2</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                </tr>
                <tr class="text-c">
                    <td>本月</td>
                    <td>2</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                </tr>
                </tbody>
            </table>
            <table class="table table-border table-bordered table-bg mt-20">
                <thead>
                <tr>
                    <th colspan="2" scope="col">服务器信息</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th width="30%">服务器计算机名</th>
                    <td><span id="lbServerName">http://127.0.0.1/</span></td>
                </tr>
                <tr>
                    <td>服务器IP地址</td>
                    <td>192.168.1.1</td>
                </tr>
                <tr>
                    <td>服务器域名</td>
                    <td>www.h-ui.net</td>
                </tr>
                <tr>
                    <td>服务器端口 </td>
                    <td>80</td>
                </tr>
                <tr>
                    <td>服务器IIS版本 </td>
                    <td>Microsoft-IIS/6.0</td>
                </tr>
                <tr>
                    <td>本文件所在文件夹 </td>
                    <td>D:\WebSite\HanXiPuTai.com\XinYiCMS.Web\</td>
                </tr>
                <tr>
                    <td>服务器操作系统 </td>
                    <td>Microsoft Windows NT 5.2.3790 Service Pack 2</td>
                </tr>
                <tr>
                    <td>系统所在文件夹 </td>
                    <td>C:\WINDOWS\system32</td>
                </tr>
                <tr>
                    <td>服务器脚本超时时间 </td>
                    <td>30000秒</td>
                </tr>
                <tr>
                    <td>服务器的语言种类 </td>
                    <td>Chinese (People's Republic of China)</td>
                </tr>
                <tr>
                    <td>服务器当前时间 </td>
                    <td>2014-6-14 12:06:23</td>
                </tr>
                <tr>
                    <td>服务器IE版本 </td>
                    <td>6.0000</td>
                </tr>
                <tr>
                    <td>服务器上次启动到现在已运行 </td>
                    <td>7210分钟</td>
                </tr>
                <tr>
                    <td>逻辑驱动器 </td>
                    <td>C:\D:\</td>
                </tr>
                <tr>
                    <td>CPU 总数 </td>
                    <td>4</td>
                </tr>
                <tr>
                    <td>CPU 类型 </td>
                    <td>x86 Family 6 Model 42 Stepping 1, GenuineIntel</td>
                </tr>
                <tr>
                    <td>虚拟内存 </td>
                    <td>52480M</td>
                </tr>
                <tr>
                    <td>当前程序占用内存 </td>
                    <td>3.29M</td>
                </tr>
                <tr>
                    <td>当前Session数量 </td>
                    <td>8</td>
                </tr>
                <tr>
                    <td>当前SessionID </td>
                    <td>gznhpwmp34004345jz2q3l45</td>
                </tr>
                <tr>
                    <td>当前系统用户名 </td>
                    <td>NETWORK SERVICE</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>
<script type="text/javascript" src="/Exam/Public/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/Exam/Public/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/Exam/Public/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/Exam/Public/static/h-ui.admin/js/H-ui.admin.js"></script>