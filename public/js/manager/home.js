/**
 * Created by fcl on 08/12/16.
 */
$().ready(function () {
    ajaxRequest('/manager/bank/data');
});

/**
 * Ajax Request to a specific Link
 * @param requestUrl
 */
function ajaxRequest(requestUrl) {
    $.ajax({
        method: 'GET',
        url: requestUrl,
        success: function (returnedJson) {
            console.log(returnedJson);
            var parsedJson = $.parseJSON(returnedJson);
            //Add Numbers to the fields
            $('#accsav').html(parsedJson.accSavings);
            $('#accnum').html(parsedJson.accCurrent);
            $('#accloan').html(parsedJson.accLoan);
            $('#numwaiting').html(parsedJson.inactiveAcc);
            $('#numcli').html(parsedJson.numCli);
            $('#allmoney').html(parsedJson.allBalance);

            numberLoad('#accsav');
            numberLoad('#accnum');
            numberLoad('#accloan');
            numberLoad('#numwaiting');
            numberLoad('#allmoney');
            numberLoad('#numcli');
        },
        error: function (err) {
            console.log(err);
        }
    });
}

/*This function is from
*http://www.i-visionblog.com/2014/11/jquery-animated-number-counter-from-zero-to-value-jquery-animation.html
* made small change
* */
function numberLoad(id){
    $(id).each(function () {
        $(this).prop('Counter',0).animate({
            Counter: $(this).text()
        }, {
            duration: 4000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });
}