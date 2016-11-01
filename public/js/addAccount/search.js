/**
 * Created by vmcb on 01-11-2016.
 */
var form = ''+
    '<form method="POST" id="searchCliForm">'+
    '<label>Número de Contribuinte</label><br>'+
    '<input type="text" name="nif"><br>'+
    '<input id="submit" type="submit" value="Procurar cliente">'+
    '</form>';

$().ready(function () {
    $("#searchModal .modal-content").append(form);

    $("#searchModal").on('submit','#searchCliForm',(function (event) {
        $.ajax({
            method:'POST',
            data: $("#searchCliForm").serialize(),
            headers: {
                'X-CSRF-Token': $('meta[name="_token"]').attr('content')
            },
            url:'/client/search',
            success: function (data) {
                createTableCli(data);
            },
            error: function (err) {
                alert('Não existe nenhum cliente com o número de contribuinte introduzido.');
            }
        });
        event.preventDefault();
    }))
        .on('click','#selCli',function () {
            $("#client").val($('#clientName').text());
            $("#clientId").val($("#cliId").val());
            resetModal();
            $("#searchModal").css('display','none');
        })
        .on('click','#back',function () {
            resetModal();
        });

    function createTableCli(data) {
        $("#searchCliForm").remove();
        $("#searchModal .modal-content").append('' +
            '<table id="result">'+
            '<thead>'+
            '<tr>'+
            '<th>Nome do Cliente</th>'+
            '<th>Morada</th>'+
            '<th>Telefone</th>'+
            '<th>Número de Contribuinte</th>'+
            '</tr>'+
            '</thead>' +
            '<tbody>'+
            '<tr>'+
            '<td id="clientName">'+data.name+'</a></td>'+
            '<td>'+data.address+'</td>'+
            '<td>'+data.phone+'</td>'+
            '<td>'+data.nif+'</td>'+
            '<input id="cliId" type="hidden" value="'+data.id+'">'+
            '</tr>'+
            '</tbody>'+
            '</table>' +
            '<button id="back">Voltar atrás</button>' +
            '<button id="selCli">Selecionar Cliente</button>'
        )
    }

    function resetModal() {
        $("#result").remove();
        $("#back").remove();
        $("#selCli").remove();
        $("#searchModal .modal-content").append(form);
    }
});