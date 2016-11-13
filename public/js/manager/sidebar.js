/**
 * Created by fcl on 10-11-2016.
 */

var previousClickedItem = null;
$('.side-bar > a').bind('click', function(){
    //Verifies if the item that was clicked before id the same that has been clicked now.
    if(previousClickedItem === this)
    {
        if($(this).next('.dropdown-content').is(':visible'))
        {

            $(this).next('.dropdown-content').css('display', 'none');

        }
        else
        {
            $(this).next('.dropdown-content').css('display', 'flex');
        }
    }
    else{
        var dropdowns = $('.side-bar > .dropdown-content');
        //hides every item
        for(i = 0; i < dropdowns.length; i++){
            dropdowns[i].style.display = 'none';
        }
        //show the div after the a that was clicked
        $(this).next('.dropdown-content').css('display', 'flex');
    }
    previousClickedItem = this;
})
