/**
 * Created by Administrator on 2016/11/14.
 */


$(function(){
    $('#captcha').on('click', function () {
        $('#captchaTip').removeClass('text-danger').text('');
    });

    $('#submit').on('click', function(event){
        event.preventDefault();
        var captcha = $('#captcha').val();
        var info = $('#info').val();
        if(captcha.length != 5){
            $('#captchaTip').addClass('text-danger').text('验证码必须是5位');
            $('#captcha').focus();
        }
        $.ajax({
            type: 'POST',
            url: 'http://localhost/NeuPostGra/demo0.4/index.php/Admin/Index/uploadcourses',
            data: {
                captcha: captcha,
                info: info,
            },
            beforeSend: function(){
                $('#submit').addClass('disabled').val('数据交互中请稍后');
                $('div.loading').css('display', 'block');
                $('#submit').css('cursor', 'not-allowed');
            },
            success: function(res){
                if(res == 1){
                    $('#captchaTip').addClass('text-danger').text('验证码错误！');
                    $('#captcha').focus();
                } else if(res == 2){
                    $('div.error1').css('display', 'block');
                    $('li.errorTip').text('写入数据库之前请先在上方上传要写入数据库的文件！');
                } else{
                    $('div.ok').css('display', 'block');
                    $('span.ok').text('恭喜您！成功写入了'+res+'条数据');
                }
            },
            complete: function(){
                $('#submit').removeClass('disabled').val('写入数据库');
                $('#submit').css('cursor', 'pointer');
                $('div.loading').css('display', 'none');
            }
        });
    });
});


$('span.close').on('click', function(){
    $('div.file-error-message').css('display', 'none');
});