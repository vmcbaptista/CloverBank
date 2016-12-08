/*Overrides the functions from getSavings*/

/**
 * Create a row to be added to the table woth data that cames formt he server
 * @param data
 */
function createAccountTable(data){
    //console.log(data);
    $.each(JSON.parse(data),function (i, item) {
        //console.log(i);
        var itemId = item.id;
        if(i == 0) {
            $('#tableRow').html(
                '<tr>' +
                '<td>' + itemId + '</td>' +
                '<td>' + item.amount + '</td>' +
                '<td>' + item.dataLimite.date.substring(0, 10) + '</td>' +
                '<td>' + item.juro + '</td>' +
                '<td>' + item.savedMoney + '</td>' +
                '<td> <button onclick="clickedButton(\''+ itemId +'\')"> Liquidar </button>  </td>' +
                '</tr>'
            );
        }else{
            $('#tableRow').append(
                '<tr>' +
                '<td>' + itemId  + '</td>' +
                '<td>' + item.amount + '</td>' +
                '<td>' + item.dataLimite.date.substring(0, 10) + '</td>' +
                '<td>' + item.juro + '</td>' +
                '<td>' + item.savedMoney + '</td>' +
                '<td> <button onclick="clickedButton(\''+ itemId +'\')"> Liquidar </button> </td>' +
                '</tr>'
            );
        }
    })
}

/**
 * Creates a row when there is an error
 * @param message
 */
function addTableRow(message){
    $('#tableRow').html(
        '<tr>'+
        '<td colspan="6">'+message+' </td>'+
        '</tr>'
    )
}
/*Finishes the override*/


function clickedButton(savingId){
    $( function() {
        $( "#dialog-confirm" ).dialog({
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: {
                "Quero Liquidar!": function() {
                    ajaxRequest('/product/delete/saving/',savingId);
                    $( this ).dialog( "close" );
                },
                "Cancelar": function() {
                    $( this ).dialog( "close" );
                }
            }
        });
    } );

}