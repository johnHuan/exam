/*
 * Author：张桓
 * ============================================================================
 * * 版权所有 2015-2025 John_3网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.John_3.com；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * {supporter: yun};
 * Created by john;
 * {admin : john }
 * DATE ：2016/1/5；
 * TIME ：10:25;
 */

;(function ($) {
    $.fn.extend({
        'nav': function (color) {
            //在插件里的this，经过了一些封装处理，this就是表示jQuery对象
            //而不需要再次使用$()包装
            //alert(this);   //返回的是jQuery对象  返回值为  object objec
            this.find('.nav').css({
                'list-style':'none',
                'margin':0,
                'padding':0,
                'display':'none',
                'color':color
            });

            $(this).find('.nav').parent().hover(function () {
                //alert(this);   //返回的是object htmlelement
                $(this).find('.nav').slideDown('normal');
            }, function () {
                $(this).find('.nav').stop().slideUp('normal');
            });
            return this;
        }
    });
})(jQuery);