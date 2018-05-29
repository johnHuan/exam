<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>我的收藏夹</title>
    <link rel="stylesheet" media="screen" type="text/css" href="/Exam/Public/bootstrap/css/bootstrap.min.css">
    <style>
        h1, h2, h3, h4 {
            margin: 0;
            padding: 0;
        }

        .choices {
            text-indent: 20px;
        }

        .well {
            padding-top: 0 !important;
        }

        .myheader {
            text-align: center;
            height: 45px;
            line-height: 45px;

            font-size: 15px;
            overflow: hidden;
            z-index: 10;
            background-color: #1BBC9B;
            width: 100%;
            position: relative;
            color: #fff;
        }

        .myheader h3 {
            padding-top: 10px;
        }
    </style>
</head>
<body class="container">
<br>
<div class="myheader">
    <h3>我的收藏夹</h3>
</div>
<div class="jumbotron">
    <h4>Hello, <?php echo ($data["nickname"]); ?>！</h4>
    <p>目前为止您的收藏夹情况如下： </p>
    <p><span>判断题： 共<?php echo ($data["jCount"]); ?>题</span></p>
    <p><span>选择题： 共<?php echo ($data["sCount"]); ?>题</span></p>
    <p>
        <a class="btn btn-info btn-sm" href="/Exam/Home/User/cjudgement" role="button">查看判断题</a>
        <a class="btn btn-info btn-sm" href="/Exam/Home/User/cselection" role="button">查看选择题</a>
    </p>
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
<script type="text/javascript" src="/Exam/Public/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/Exam/Public/bootstrap/js/bootstrap.js"></script>
</body>
</html>