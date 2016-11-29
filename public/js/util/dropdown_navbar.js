/**
 * Created by fcl on 10-11-2016.
 */

/*Part to contol the dropdown*/


/*Will hide or show the dropdown that appear in the navbar */
var showDropUser = function(){
    if($(this).find('.user-options').is(':visible'))
    {
        $(this).find('.user-options').css('display', 'none');
    }
    else
    {
        $(this).find('.user-options').css('display', 'block');
    }
}

$('.li_access').hover(showDropUser);
