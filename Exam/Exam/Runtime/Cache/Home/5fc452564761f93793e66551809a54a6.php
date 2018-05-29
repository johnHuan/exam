<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>顺序练习判断题</title>
    <link rel="stylesheet" media="screen" type="text/css" href="/Exam/Public/bootstrap/css/bootstrap.min.css">
    <style>
        h1, h2, h3, h4 div{
            margin: 0;
            padding: 0;
        }

        .choices {
            text-indent: 20px;
        }

        .well {
            padding-top: 0 !important;
        }

        .header h2 {
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
        .panel-footer {
            /*text-align: center;*/
            display: inline-block;
            width: 100%;
            margin-bottom: 0;
        }
        .panel-footer .row{
            text-align: center;
            margin: 5px 0;
            height: 30px;
            line-height: 30px;
        }
        .response{
            text-align: left;
        }
    </style>
</head>
<body class="container">
<br>
<div class="box">
    <div class="header">
        <h2 class="">顺序练习判断题</h2>
    </div>
    <!--中间题目区域 start-->
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo ($id); ?>/<?php echo ($total); ?>. <?php echo ($question["question"]); ?>--<?php echo ($question["answer"]); ?>--
                <span class="tid"><?php echo ($question["jid"]); ?></span>
            </h3>
        </div>
        <div class="panel-body">
                <button class="btn btn-xs btn-info" name="answer" value="1">正确</button>
                <button class="btn btn-xs btn-info" name="answer" value="0">错误</button>
            <button class="btn btn-xs btn-primary-outline pull-right" name="fav">加入收藏</button>
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-xs-9 info response"></div>
                <div class="col-xs-2 info">
                    <?php if($id == 1): ?><button class="disabled btn btn-xs btn-info" name="prev" value="1">上一题</button>
                    <?php else: ?>
                        <button class="btn btn-xs btn-info" name="prev" value="1">上一题</button><?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
    <!--中间题目区域 end-->
<!--footer-->
<footer class="footer footer-fixed-bottom">
    <div class="well">
        <!--<h4>说明：</h4>-->
        <!--<p>2013级本科生课程评估工作现启动，采用网上评估的方式进行。凡本学院所有13级本科生，应于2016年12月27日前，登陆教学管理系统，完成评教，在登陆后的界面里可直接显示待评教的课程。</p>-->
        <h5>说明：</h5>
        <p>1.本次考试共20道题目</p>
        <p>2.考试过程中仅有两次复活机会</p>
        <p>3.当两次机会都用完后，没有成功通过考试的，本次考试无效，如果通过考试，则记为合格</p>
    </div>
    <div class="footer">
        &copy;2018-纪委  <br />
    </div>
</footer>
<script type="text/javascript" src="/Exam/Public/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/Exam/Public/bootstrap/js/bootstrap.js"></script>
</body>
</html>
<script>
    /**
     * 点击作答
     */
    $("button[name='answer']").on('click', function (e) {
        var answer = this.value;
        $.ajax({
            type: 'post',
            data: {
                jid: <?php echo ($id); ?>,
                answer: answer
            },
            url: '/Exam/Home/User/cjudgement',
            beforeSend: function (e) {
                // alert("答案提交中。。。");
            },
            error: function (e) {
                alert("ajax出错。。。");
            },
            success: function (res) {
                if (res['isRight'] == true && res["end"] == false){
                    // 回答正确, 但是还没到最后一题
                    $(".response").html("<span class='text-success'><span class='glyphicon glyphicon-ok'></span>恭喜您！回答正确！！:)</span>");
                    setTimeout(function () {
                        window.location.href = "/Exam/Home/User/cjudgement?id=<?php echo ($id+1); ?>";
                    }, 500);
                } else if (res['isRight'] == false && res["end"] == false){
                    $(".response").html("<span class='text-success'><span class='glyphicon glyphicon-remove'></span>回答错误！！:)</span>");
                    setTimeout(function () {
                        window.location.href = "/Exam/Home/User/cjudgement?id=<?php echo ($id+1); ?>";
                    }, 500);
                } else if(res["end"] == true){
                    // 已经到了最后一题了
                    $(".response").html("<span class='text-success'><span class='glyphicon glyphicon-ok'></span>您已经完成了所有判断题的练习<span class='glyphicon glyphicon-flag'></span></span>");
                } else {
                    $(".response").html("<span class='text-success'><span class='glyphicon glyphicon-ok'></span>系统异常，请重试<span class='glyphicon glyphicon-flag'></span></span>");
                }
            },
            complete: function (e) {
                // alert("ajax请求完成...");
            }
        });
    });

    /**
     * 加入收藏夹
     */
    $("button[name='fav']").on('click', function (e) {
        tid = $(".tid").html();
        $.ajax({
            type: 'post',
            data: {
                id: <?php echo ($id); ?>,
                jid: tid
            },
            url: '/Exam/Home/User/addFav',
            error: function (e) {

            },
            success: function (res) {
                if (res == 0){
                    $(".response").html("<span class='text-success'>该题已经加入您的收藏夹了</span>");
                } else {
                    $(".response").html("<span class='text-success'>添加成功</span>");
                }
            },
        });
    });

    /**
     * 上一题
     */
    $("button[name='prev']").on('click', function (e) {
        window.location.href = "/Exam/Home/User/cjudgement?id=<?php echo ($id-1); ?>";
    });

</script>