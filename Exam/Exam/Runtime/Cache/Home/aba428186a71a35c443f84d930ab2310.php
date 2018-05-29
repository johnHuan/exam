<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>在线考试系统</title>
    <link rel="stylesheet"  media="screen" type="text/css" href="/exam/Public/bootstrap/css/bootstrap.min.css">
</head>
<body class="container">

<nav class="container navbar navbar-default navbar-fixed-top">
    <div class="navbar-header">
        <a class="navbar-brand logo" href="#">在线考试系统</a>
        <button class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    <div class="collapse navbar-collapse" id="navbar-collapse">
        <ul class="nav navbar-nav">
            <li>
                <a href="#" data-toggle="dropdown">
                    <span class="glyphicon glyphicon-cloud-upload"></span> 线上学习
                    <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="/exam/Home/Exercise">在线练习</a></li>
                    <li><a href="/exam/Home/Exam">在线考试</a></li>
                </ul>
            </li>
            <li>
                <a href="#" data-toggle="dropdown">
                    <span class="glyphicon glyphicon-retweet"></span> 在线互动
                    <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="/exam/Home/OnLine/comment">我有话说</a></li>
                    <li><a href="/exam/Home/OnLine/index">通知通告</a></li>
                </ul>
            </li>
            <li>
                <a href="#" data-toggle="dropdown">
                    <span class="glyphicon glyphicon-user"></span> 个人中心
                    <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="/exam/Home/User/collection">收藏夹</a></li>
                    <li><a href="/exam/Home/User/errorBook">错题本</a></li>
                    <li><a href="/exam/Home/Index">个人资料</a></li>
                </ul>
            </li>

        </ul>
    </div>
</nav>

<br><br><br>
<h3>个人中心</h3>
<div class="panel panel-default">
    <div class="panel-heading">
        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
        绑定个人信息
    </div>
    <form action="/exam/" method="post" class="panel-body">
        <div class="form-group">
            <textarea required class="form-control" name="comment" id="" placeholder="在这里写下您的建议、意见、举报、投诉或者想对纪委说的话" rows="10"></textarea>
        </div>
        <div class="col-sm-3">
            <input id="submit" class="btn btn-primary form-control" name="submit" value="提交" type="submit">
        </div>
    </form>
</div>
<!--footer-->
<footer class="footer footer-fixed-bottom">
    <div class="well">
        <!--<h4>说明：</h4>-->
        <!--<p>2013级本科生课程评估工作现启动，采用网上评估的方式进行。凡本学院所有13级本科生，应于2016年12月27日前，登陆教学管理系统，完成评教，在登陆后的界面里可直接显示待评教的课程。</p>-->
        <h5>说明：</h5>
        <p>实名制留言</p>
    </div>
    <div class="footer">
        &copy;2018-纪委  <br />
    </div>
</footer>
<script type="text/javascript" src="/exam/Public/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/exam/Public/bootstrap/js/bootstrap.js"></script>
</body>
</html>