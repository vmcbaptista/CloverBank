/**
 * Created by fcl on 28-11-2016.
 */
$().ready(function () {
    $("#account").change(function () {
        $.get('/account/balance/'+$("#account").val(), function(data) {
            $("#balance").text(data+' €');
        });
    });
});