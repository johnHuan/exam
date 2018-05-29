/**
 * Created by 桓 on 2016/10/2.
 */

$(function() {
    $('#login_btn').click(function () {
        var name_state = $('#admin_user').val();
        var psd_state = $('#admin_pwd').val();
        var code = $('#code').val();
        if (name_state == '') {
            name_state.parent().next().next().css("display", "block");
            return false;
        } else if (psd_state == '') {
            name_state.parent().next().next().css("display", "none");
            psd_state.parent().next().next().css("display", "block");
            return false;
        } else {
            name_state.parent().next().next().css("display", "none");
            psd_state.parent().next().next().css("display", "none");
            $('.login').submit();
        }
    });
});