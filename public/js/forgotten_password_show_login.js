$('#loginBt').bind('click',handleClick);


function handleLoginForgottenPass() {
    var loginForm = $('#form_to_login');
    $('#loginBt').unbind('click');
    if (loginForm.is(':visible')) {

        loginForm.slideUp(1000).delay(800).fadeOut(400, function () {
            $('#loginBt').bind('click', handleClick);
        });

    }
    else {
        loginForm.slideDown(1000).delay(800).fadeIn(400, function () {
            $('#loginBt').bind('click', handleClick)
        });
        loginForm.css("display", "flex");
    }
}