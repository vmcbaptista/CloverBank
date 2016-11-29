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
        if (sessionStorage.getItem('accountType') == 'current') {
            $("#body").html(html.more_users)
                .off('click','#selCli');
        } else {
            $.ajax({
                method: 'POST',
                headers: {
                    'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                },
                url: '/account/current/search/'+$("#cliId").val(),
                success: function (data) {
                    createAccountTable(data);
                },
                error: function (err) {
                    alert('Não encontrámos nenhuma conta associada ao cliente selecionado.');
                }
            });
        }
    })
        .on('click', '#back', function () {
            $("#body").html(html.search_form)
                .off('click','#back');
        })
        .on('click', '.selAccount', function () {
            if (sessionStorage.getItem('accountType') == 'loan') {
                sessionStorage.setItem('account', $(this).val());
                $("#body").html(html.account_form).off('click','.selAccount');
                $("#amountLabel").text("Montante Pretendido");
                $("#addAccount").attr('action','/account/loan/add');
                getProducts('loan');
            }
            else {
                sessionStorage.setItem('account', $(this).val());
                $("#body").html(html.account_form).off('click','.selAccount');
                $("#addAccount").attr('action','/account/saving/add');
                getProducts('saving');
            }
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
        '<th>Ação</th>'+
        '</tr>'+
        '</thead>' +
        '<tbody>'+
        '<tr>'+
        '<td id="clientName">'+data.name+'</a></td>'+
        '<td>'+data.address+'</td>'+
        '<td>'+data.phone+'</td>'+
        '<td>'+data.nif+'</td>' +
        '<td><button id="selCli">Selecionar Cliente</button></td>'+
        '<input id="cliId" type="hidden" value="'+data.id+'">'+
        '</tr>'+
        '</tbody>'+
        '</table>' +
        '<div class="buttons">' +
        '<button id="back">Voltar atrás</button>' +
        '</div>'
    )
}
function createAccountTable(data) {
    var p = '';
    if (sessionStorage.getItem('accountType') == 'loan') {
        p = '<p> Por favor selecione a conta à qual deseja associar o Empréstimo'
    }
    else {
        p = '<p> Por favor selecione a conta à qual deseja associar a Conta Poupança'
    }
    var table = '' +
        '<table id="accounts">'+
        '<thead>'+
        '<tr>'+
        '<th>1º Titular</th>'+
        '<th>2º Titular</th>' +
        '<th>Outros titulares</th>'+
        '<th>Conta</th>'+
        '<th>Ação</th>'+
        '</tr>'+
        '</thead>' +
        '<tbody>';

    $.each(data,function (i, val) {
        table += '' +
            '<tr>' +
            '<td>'+val.clients.first+'</a></td>';
        if (typeof val.clients.second === 'undefined' ) {
            table += '<td>-</td>';
        }
        else {
            table += '<td>'+val.clients.second+'</td>';
        }
        if (typeof val.clients.others === 'undefined' ) {
            table += '<td>-</td>';
        }
        else {
            var names = '';
            $.each(val.clients.others, function (i, val) {
                names += val+'<br>';
            });
            table += '<td>'+names+'</td>';
        }
        table += '' +
            '<td>'+val.account+'</td>'+
            '<td><button class="selAccount" value="'+val.id+'">Selecionar Conta</button></td>'+
            '</tr>';
    });

    table += '' +
        '</tbody>'+
        '</table>' +
        '<div>' +
        '<button id="back">Voltar atrás</button>' +
        '</div>';

    $("#body").html(p+table);
}