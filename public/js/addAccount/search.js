function handleSearchForm() {
    $("#body").on('submit', '#searchCliForm', (function (event) {
        $.ajax({
            method: 'POST',
            data: $("#searchCliForm").serialize(),
            headers: {
                'X-CSRF-Token': $('meta[name="_token"]').attr('content')
            },
            url: '/client/search',
            success: function (data) {
                createResultTable(data);
                $("#body").off('submit','#searchCliForm');
            },
            error: function (err) {
                alert('Não existe nenhum cliente com o número de contribuinte introduzido.');
            }
        });
        event.preventDefault();
    }))
}

function handleSearchResults() {
    $("#body").on('click', '#selCli', function () {
        var clientData = JSON.parse(sessionStorage.getItem('clientData'));
        clientData.push({
            "new": false,
            "id": $("#cliId").val(),
            "name": $('#clientName').text()
        });
        sessionStorage.setItem('clientData', JSON.stringify(clientData));
        console.log(sessionStorage.getItem('clientData'));
        $("#body").html(html.more_users)
            .off('click','#selCli');
    })
        .on('click', '#back', function () {
            $("#body").html(html.search_form)
                .off('click','#back');
        });

}

function createResultTable(data) {
    $("#body").html('' +
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