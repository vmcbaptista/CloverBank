/**
 * Uses AJAX to check if there is any client with the NIF introduced,
 * if so presents a table with the iformation of that client
 */
function handleSearchForm() {
    $("#body").on('submit', '#searchCliForm', (function (event) {
        alert("entrei");
        $.ajax({
            method: 'POST',
            data: $("#searchCliForm").serialize(),
            headers: {
                'X-CSRF-Token': $('meta[name="_token"]').attr('content')
            },
            url: '/client/search',
            success: function (data) {
                createResultTable(data);
            },
            error: function (err) {
                alert('Não existe nenhum cliente com o número de contribuinte introduzido.');
            }
        });
        event.preventDefault();
    }))
}

/**
 * When a client is selected this method is invoked
 * It adds the data od the client into a SessionStorage that is used afterwards when
 * associating the account that is being created with this user.
 * After that it presents the final form that allows the manager to fill information
 * about the product that the client will subscribe.
 */
function handleSearchResults() {
    $("#body").on('click', '#selCli', function () {
        var clientData = JSON.parse(sessionStorage.getItem('clientData'));
        clientData.push({
            "new": false,
            "id": $("#cliId").val(),
            "name": $('#clientName').text(),
            "address": $("#cliAddress").text(),
            "email": $("#cliMail").val(),
            "phone": $("#cliPhone").text(),
            "nif":$("#cliNif").text()
        });
        sessionStorage.setItem('clientData', JSON.stringify(clientData));
        console.log(sessionStorage.getItem('clientData'));
        // The saving and loans require an already created current account
        // If we are creating one of this types of accounts we do an AJAX request to check
        // the currents accounts that are associated to the client, present them and allow the
        // manager to select one of them
        if (sessionStorage.getItem('accountType') == 'current') {
            $("#body").html(html.more_users).off('click','#selcCli');
            history.pushState({html: $("#body").html()},'','?moreClients');
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
        .on('click', '.selAccount', function () {
            if (sessionStorage.getItem('accountType') == 'loan') {
                sessionStorage.setItem('account', $(this).val());
                $("#body").html(html.account_form).off('click','.selAccount');
                $("#amountLabel").text("Montante Pretendido");
                $("#addAccount").attr('action','/account/loan/add');
                history.pushState({html: $("#body").html()},'','?createLoan');
                getProducts('loan');
                validateAccountForm();
            }
            else if(sessionStorage.getItem('accountType') == 'saving') {
                sessionStorage.setItem('account', $(this).val());
                $("#body").html(html.account_form).off('click','.selAccount');
                $("#addAccount").attr('action','/account/saving/add');
                history.pushState({html: $("#body").html()},'','?createSaving');
                getProducts('saving');
                validateAccountForm();
            }
            else
            {
                location.href="/deposits/NIF/check?NIF="+$(this).val();
            }
        });

}

/**
 * This method creates a table that show the information about the client searched
 * @param data is the data of the client received with the AJAX request
 */
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
        '<td id="cliAddress">'+data.address+'</td>'+
        '<td id="cliPhone">'+data.phone+'</td>'+
        '<td id="cliNif">'+data.nif+'</td>' +
        '<td><button id="selCli">Selecionar Cliente</button></td>'+
        '<input id="cliId" type="hidden" value="'+data.id+'">'+
        '<input id="cliMail" type="hidden" value="'+data.email+'">'+
        '</tr>'+
        '</tbody>'+
        '</table>' +
        '<div class="buttons">' +
        '<button id="back">Voltar atrás</button>' +
        '</div>'
    );
    history.pushState({html: $("#body").html()},'','?searchResults');
}

/**
 * Creates a table with all the accounts that are associated with the client and
 * presents some information about them
 * @param data is the data of the accounts received with the AJAX request
 */
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
        '<tr>' +
        '<th>IBAN</th>'+
        '<th>1º Titular</th>'+
        '<th>2º Titular</th>' +
        '<th>Outros titulares</th>'+
        '<th>Conta</th>'+
        '<th>Ação</th>'+
        '</tr>'+
        '</thead>' +
        '<tbody>';
    // The client could have more than one account, the data comes with all the accounts
    // so we need to iterate over them
    $.each(data,function (i, val) {
        table += '' +
            '<tr>' +
            '<td>'+val.id+'</td>' +
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
    history.pushState({html: $("#body").html()},'','?selectAccount');
}