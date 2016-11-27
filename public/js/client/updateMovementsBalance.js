/**
 * Created by fcl on 27-11-2016.
 */
function updateBalance() {
    $.get('/account/balance/'+$("#account").val(), function(data) {
        $("#balance").text(data+' €');
    });
}

function updateMovements() {
    $.get('/movements/'+$("#account").val(), function(data) {
        console.log(data);

        if(data.length == 0){
            $("#movements").append(
                '<tr>' +
                '<td colspan="4"> Nao existem movimentos. </td>' +
                '</tr>'
            )
        }

        $.each(data,function (i,val) {
            $("#movements").append(
                '<tr>' +
                '<td>'+val["created_at"]+'</td>' +
                '<td>'+val["description"]+'</td>' +
                '<td>'+val["amount"]+'</td>' +
                '<td>'+val["balance_after"]+'</td>' +
                '</tr>'
            )
        })



    });
}

$().ready(function () {
    updateBalance();
    updateMovements();
    $("#account").change(function () {
        updateBalance();
        $("#movements").empty();
        updateMovements();
    });
});