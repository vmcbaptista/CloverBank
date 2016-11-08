/**
 * Created by fcl on 06-11-2016.
 */

/**
 * This function will make the login form fadein and out
 * */
    $('.li_access').bind('click',handleClick);

    function handleClick(){
        var loginForm = $('#form_to_login');
        $('.li_access').unbind('click');
        if(loginForm.is(':visible'))
        {

            loginForm.slideUp( 1000 ).delay( 800 ).fadeOut( 400, function(){
                $('.li_access').bind('click',handleClick);
            });

        }
        else
        {
            loginForm.slideDown( 1000 ).delay( 800 ).fadeIn( 400, function () {
                $('.li_access').bind('click', handleClick)
            });
            loginForm.css("display", "flex");

        }
    }