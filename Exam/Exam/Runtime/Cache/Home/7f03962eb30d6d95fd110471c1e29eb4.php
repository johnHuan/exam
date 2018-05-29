<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>在线考试系统</title>
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
        <h2 class="">在线考试</h2>
    </div>
    <!--中间题目区域 start-->
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo ($id+1); ?>. <?php echo ($question["question"]); ?>--<?php echo ($question["answer"]); ?>--
                <?php if(empty($question['sid'])): ?><span class="tid"><?php echo ($question["jid"]); ?></span>
                <?php else: ?>
                    <span class="tid"><?php echo ($question["sid"]); ?></span><?php endif; ?>
            </h3>
        </div>
        <div class="panel-body">
            <?php if(empty($answer)): ?><!--answer为空， 说明是判断题-->
                <?php if($terminate < 0): ?><button class="disabled btn btn-xs btn-info" name="answer" value="1">正确</button>
                    <button class="disabled btn btn-xs btn-info" name="answer" value="0">错误</button>
                    <?php else: ?>
                    <button class="btn btn-xs btn-info" name="answer" value="1">正确</button>
                    <button class="btn btn-xs btn-info" name="answer" value="0">错误</button><?php endif; ?>
            <?php else: ?>
                <!--answer不为空， 说明是选择题-->
                <?php if(($terminate < 0) OR ($disable == 1)): if(is_array($answer)): foreach($answer as $key=>$vo): ?><p>
                            <button class="disabled btn btn-xs btn-info" name="answer" value="<?php echo ($vo['optionid']); ?>"><?php echo ($vo["optionid"]); ?>. <?php echo ($vo["optionTxt"]); ?></button>
                        </p><?php endforeach; endif; ?>
                <?php else: ?>
                    <?php if(is_array($answer)): foreach($answer as $key=>$vo): ?><p>
                            <button class="btn btn-xs btn-info" name="answer" value="<?php echo ($vo['optionid']); ?>"><?php echo ($vo["optionid"]); ?>. <?php echo ($vo["optionTxt"]); ?></button>
                        </p><?php endforeach; endif; endif; endif; ?>
            <button class="btn btn-xs btn-primary-outline pull-right" name="fav">加入收藏</button>
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-xs-12 info response"></div>
                <!--<div class="col-xs-3 btn btn-sm btn-success">结束考试</div>-->
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
    // 点击作答
    $("button[name='answer']").on('click', function (e) {
        var answer = this.value;
        $.ajax({
            type: 'post',
            data: {
                id: <?php echo ($id); ?>,
                answer: answer
            },
            url: '/Exam/Home/Exam/exam',
            beforeSend: function (e) {
                // alert("答案提交中。。。");
            },
            error: function (e) {
                alert("ajax出错。。。");
            },
            success: function (res) {
                if (res['flag'] == true){
                    if (!res["success"]){
                        // 回答正确, 但是还没到最后一题
                        $(".response").html("<span class='text-success'><span class='glyphicon glyphicon-ok'></span>恭喜您！回答正确！！:)</span>");
                        setTimeout(function () {
                            window.location.href = "/Exam/Home/Exam/exam?id=<?php echo ($id+1); ?>";
                        }, 500);

                    } else {
                        // 考试完成， 并且通过了考试
                        $(".response").html("<span class='text-success'><span class='glyphicon glyphicon-ok'></span>恭喜您！回答正确！！:) 考试完成，您顺利通过了本次考试 <span class='glyphicon glyphicon-flag'></span></span>");
                        $("button[name='answer']").addClass("disabled");
                    }
                } else {
                    // 回答错误, 但是通过复活卡通过了考试
                    if (res["success"] == true){
                        // 考试完成， 并且通过了考试
                        $(".response").html("<span class='text-success'><span class='glyphicon glyphicon-ok'></span>恭喜您！考试完成，此题回答错误，但是利用复活机会通过了本次考试<span class='glyphicon glyphicon-flag'></span></span>");
                        $("button[name='answer']").addClass("disabled");
                    } else {
                        if (res['count'] < 0){
                            // 提示答题已经结束
                            $(".response").html("<span class='text-error'><span class='glyphicon glyphicon-remove'></span>回答错误:(很遗憾,本次考试结束！！您未通过考试</span>");
                            // 禁用答题按钮， 让其自动退出
                            $("button[name='answer']").addClass("disabled");
                        } else {
                            // 还有机会， 提示谨慎
                            $(".response").html("<span class='text-error'><span class='glyphicon glyphicon-remove'></span>回答错误:(很遗憾，此题已经自动帮您加入错题本，您还有"+res['count']+"次机会;</span>");
                            setTimeout(function () {
                                window.location.href = "/Exam/Home/Exam/exam?id=<?php echo ($id+1); ?>";
                            }, 500);
                        }
                    }
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
            url: '/Exam/Home/Exam/addFav',
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


</script>