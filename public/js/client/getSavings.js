/**
 * When page is ready check if we asked to see a saving accout which is associtated to the current account we selectd.
 */
$().ready(function () {
    var select = $("#currentAccount");
    select.change(function () {
        if($(this).val() == ""){
            addTableRow('Não foi encontrada nenhuma conta poupança associada à conta à ordem selecionada');
        }else{
            ajaxRequest($(this).val());
        }
    });

    if(select.val() == ""){
        addTableRow('Por favor selecione uma conta à ordem.');
    }
});

/**
 * Generates the ajax requests
 * @param accountSelected
 */
function ajaxRequest(accountSelected) {
    $.ajax({
        method: 'GET',
        url: '/product/check/saving/'+ accountSelected,
        success: function (returnedJson) {
            createAccountTable(returnedJson);
        },
        error: function (err) {
            console.log(err);
            addTableRow('Não foi encontrada nenhuma conta poupança associada à conta à ordem selecionada');
        }
    });
}

/**
 * Create a row to be added to the table woth data that cames formt he server
 * @param data
 */
function createAccountTable(data){
    $.each(JSON.parse(data),function (i, item) {
        $('#tableRow').html(
        '<tr>'+
            '<td>'+ item.id +'</td>'+
            '<td>'+ item.amount +'</td>'+
            '<td>'+ item.dataLimite.date.substring(0,10)+'</td>'+
            '<td>'+ item.juro+'</td>'+
            '<td>'+ item.savedMoney +'</td>'+
        '</tr>'
        );
    })
}

/**
 * Creates a row when there is an error
 * @param message
 */
function addTableRow(message){
    $('#tableRow').html(
        '<tr>'+
        '<td colspan="5">'+message+' </td>'+
        '</tr>'
    )
}