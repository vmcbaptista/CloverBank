/**
 * Created by fcl on 06-11-2016.
 */

/**
 * This function will make the login form fadein and out
 * */
$('.li_access').on('click',function(){
    var loginForm = $('#form_to_login');
    if(loginForm.is(':visible'))
    {

        loginForm.slideUp( 1000 ).delay( 800 ).fadeOut( 400 );

    }
    else
    {
        loginForm.slideDown( 1000 ).delay( 800 ).fadeIn( 400 );
        loginForm.css("display", "flex");
    }
});