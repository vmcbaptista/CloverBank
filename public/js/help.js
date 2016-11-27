/**
 * Created by fcl on 27-11-2016.
 */
 var button = $('.container-faq h3');

 for(var i = 0; i <button.length; i++){
     button[i].click = function(){
         console.log("Ola")
         this.classList.toggle("active");
         this.classList.nextElementSinbling.toggle("show")
     }
 }

    //$('.container-faq > p');
    /* var loginForm = $('.container-faq h3 > p');
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

    }*/