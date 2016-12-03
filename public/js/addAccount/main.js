// A JSON with some HTML used to create the process of adding users and accounts
var html = {
    add_client:'' +
    '<form id="addCliForm" method="POST">' +
    '<label>Insira os dados do novo cliente</label>' +
    '<div class="form-wrapper">' +
    '<label>Nome</label>' +
    '<input id="name" type="text" name="name">' +
    '<label>Morada</label>' +
    '<input id="address" type="text" name="address">' +
    '<label>E-mail</label>' +
    '<input id="email" type="email" name="email">' +
    '<label>Telefone</label>' +
    '<input id="phone" type="tel" name="phone">' +
    '<label>Número de Contribuinte</label>' +
    '<input id="nif" type="number" name="nif">' +
    '</div>' +
    '<button type="submit">Novo Cliente</button>' +
    '<button type="button" id="back">Voltar atrás</button>' +
    '</form>',
    search_form:''+
    '<form method="POST" id="searchCliForm">'+
    '<label>Insira o Número de Contribuinte do Cliente que deseja procurar</label><br>'+
    '<input type="text" name="nif"><br>'+
    '<input id="submit" type="submit" class="searchButton" value="Procurar cliente">'+
    '<button type="button" id="back"">Voltar atrás</button>' +
    '</form>',
    product_type:'' +
    '<p>Selecione o tipo de conta que pretende criar:</p>' +
    '<div class="buttons">' +
    '<button id="current">Conta à Ordem</button>' +
    '<button id="saving">Conta Poupança</button>' +
    '<button id="loan">Empréstimo</button>' +
    '</div>',
    account_form:'' +
    '<form method="post" id="addAccount">' +
    '<label>Insira os dados da nova conta</label>'+
    '<div class="form-wrapper">' +
    '<label>Produto</label>'+
    '<select id="product" name="product">'+
    '<option></option>'+
    '</select>'+
    '<label id="amountLabel">Depósito Inicial</label>'+
    '<input id="amount" type="text" name="amount">'+
    '</div>' +
    '<button type="submit" class="addAccountButton">Criar nova conta</button>' +
    '<button type="button" id="back">Voltar atrás</button>' +
    '</form>',
    first_user:'' +
    '<p>Selecione uma das seguintes opções para o 1º Titular da Conta</p>' +
    '<div class="buttons">' +
    '<button id="new">Novo cliente</button>' +
    '<button id="existing">Cliente já existente</button>' +
    '<button type="button" id="back">Voltar atrás</button>' +
    '</div>',
    more_users:'' +
    '<p>Deseja juntar mais algum titular a esta conta?' +
    '<div class="buttons">' +
    '<button id="new">Novo cliente</button>' +
    '<button id="existing">Cliente já existente</button>' +
    '<button id="next">Não desejo adicionar mais nenhum titular</button>' +
    '<button type="button" id="back">Voltar atrás</button>' +
    '</div>'
};

/**
 * Gets all the products of a specific type that the bank has
 * @param type
 */
function getProducts(type) {
    // Gets all the products of a specific type
    $.getJSON('/product/'+type,'',function (data) {
        // For each product of the given type gets specific informations about it
        for (i = 0; i < data.length; i++) {
            $.ajax({
                // The name of the product is on the table product that's why we need to
                // do another AJAX request this time to receive data from this table
                url:'/product/'+data[i].product_id,
                // The id that we need to store is the id associated to the type of the account
                // and this was retrieved in the previous AJAX request (getJSON).
                specProd: data[i],
                success: function (data2) {
                    $("#product").append('<option value="' + this.specProd.id + '">' + data2.name + '</option>');
                },
                error: function (err) {
                    console.log(err);
                }
            });
        }
    });
}

$().ready(function () {
    // Creates some SessionStorages to store information that we need to store
    // during all the process

    // Stores data about the clients that will be associated to the new account
    sessionStorage.SessionName = "clientData";
    sessionStorage.setItem("clientData", JSON.stringify([]));

    // Stores info about the type of account we are creating
    sessionStorage.SessionName = "accountType";
    sessionStorage.setItem("accountType", '');

    // Stores information about existing account if we create a Loan or a Saving
    sessionStorage.SessionName = "account";
    sessionStorage.setItem("account", '');

    // Stores info about the new account we'll create
    sessionStorage.SessionName = "newAccount";
    sessionStorage.setItem("newAccount", '');

    // Presents the options after selecting that we'll create a new current account
    $("#body").on("click","#current",function () {
        sessionStorage.SessionName = "createAccount";
        sessionStorage.setItem("createAccount", 'true');
        $("#body").html(html.first_user);
        history.pushState({html: $("#body").html()},'','?current');
        sessionStorage.setItem("accountType", 'current');
    })
        // Presents the final form of creating a current acocunt if there is no more
        // clients to associato to that account
        .on("click","#next",function () {
            $("#body").html(html.account_form).off('click','#next');
            getProducts('current');
            validateAccountForm();
        })
        // Presents the options after selecting that we'll create a new savings account
        .on("click","#saving",function () {
            sessionStorage.SessionName = "createAccount";
            sessionStorage.setItem("createAccount", 'true');
            sessionStorage.setItem("accountType", 'saving');
            $("#body").html(html.search_form).off('click','#saving');
            history.pushState({html: $("#body").html()},'','?saving');
            handleSearchForm();
            handleSearchResults();
        })
        // Presents the options after selecting that we'll create a new loan account
        .on("click","#loan",function () {
            sessionStorage.SessionName = "createAccount";
            sessionStorage.setItem("createAccount", 'true');
            sessionStorage.setItem("accountType", 'loan');
            $("#body").html(html.search_form).off('click','#loan');
            history.pushState({html: $("#body").html()},'','?loan');
            handleSearchForm();
            handleSearchResults();
        })
        // Presents a form to search for an existing client
        .on("click","#existing",function () {
            $("#body").html(html.search_form);
            history.pushState({html: $("#body").html()},'','?existing');
            handleSearchForm();
            handleSearchResults();
        })
        // Presents a form to add a new client
        .on("click","#new",function () {
            $("#body").html(html.add_client);
            validateAddClientForm();
            history.pushState({html: $("#body").html()},'','?newClient');
            handleAddClientForm();
        }).on("click","#back",function () {
        window.history.back();
    })
        // Treats the data introduced to create a new client and presents a view
        // to confirm that information
        .on("submit","#addAccount",function (e) {
            history.pushState({html: $("#body").html()},'','?createCurrent');
            e.preventDefault();
            handleAddAccountForm($(this));
            $("#body").html(validateUsers()+validateAccount()+prepareDataToSend()).off('click','#addAccount');
            addFormAction();
            history.pushState({html: $("#body").html()},'','?validate');
        })
        // Clears the SessionStorage and submits all the information to create the
        // accounts and users
        .on("submit","#addValidAccount",function (e) {
            sessionStorage.clear();
            return true;
        });

    // All the history.pushState are done in order to allow the user to goback
    // through all the process
    history.pushState({html: $("#body").html()},'','?initial');
    // Reconfigures the views when the user goes back
    window.onpopstate = function(event) {
        console.log(document.location.search);
        if (!sessionStorage.getItem("createAccount")) {
            location.reload();
        }
        else if(document.location.search == '?newClient') {
            removeLastClient();
        }
        else if (document.location.search == '?searchResults') {
            removeLastClient();
        }
        else if (document.location.search == '?validate') {
            $("#body").html(event.state.html);
        }
        console.log(sessionStorage.getItem("clientData"));
        $("#body").html(event.state.html);
    };
});

/**
 * Cleans SessionStorage when the user goes back to prevent repetition of information
 */
function removeLastClient() {
    clientData = JSON.parse(sessionStorage.getItem("clientData"));
    clientData.pop();
    sessionStorage.setItem("clientData",JSON.stringify(clientData));
}

/**
 * Creates a new view to allow the manager to confirm all the data related with the
 * clients introduced before submission
 * @returns {string}
 */
function validateUsers() {
    var userData =
        '<p>Por favor verifique se os dados introduzidos encontram-se corretos:</p>' +
        '<label>Dados do(s) Cliente(s)</label>';
    console.log(sessionStorage.getItem('clientData'));
    $.each(JSON.parse(sessionStorage.getItem('clientData')),function (i,val) {
        console.log(val);
        userData += '' +
            '<table>' +
            '<thead>' +
            '<tr>' +
            '<th colspan="2">'+parseInt(i+1)+'º Titular</th>' +
            '</tr>' +
            '</thead>' +
            '<tr>' +
            '<td>Nome</td>' +
            '<td>'+val.name+'</td>' +
            '</tr>' +
            '<tr>' +
            '<td>Morada</td>' +
            '<td>'+val.address+'</td>' +
            '</tr>' +
            '<tr>' +
            '<td>Telefone</td>' +
            '<td>'+val.phone+'</td>' +
            '</tr>' +
            '<tr>' +
            '<td>NIF</td>' +
            '<td>'+val.nif+'</td>' +
            '</tr>' +
            '<tr>' +
            '<td>E-mail</td>' +
            '<td>'+val.email+'</td>' +
            '</tr>' +
            '</table>';
    });
    console.log(userData);
    return userData;
}

/**
 * Creates a new view to allow the manager to confirm all the data related with the
 * account introduced before submission
 * @returns {string}
 */
function validateAccount() {
    var newAccount = JSON.parse(sessionStorage.getItem("newAccount"));
    var account = '' +
        '<label>Dados da Conta</label>' +
        '<table>' +
        '<thead>' +
        '<tr>' ;
    if (sessionStorage.getItem("accountType") == 'current') {
        account += '' +
            '<th colspan="2">Conta à Ordem</th>' +
            '</tr>' +
            '</thead>';
    }
    else if (sessionStorage.getItem("accountType") == 'saving'){
        account += '' +
            '<th colspan="2">Conta Poupança</th>' +
            '</tr>' +
            '</thead>';
    }
    else {
        account += '' +
            '<th colspan="2">Empréstimo</th>' +
            '</tr>' +
            '</thead>';
    }
    account += '' +
        '<tr>' +
        '<td>Produto</td>' +
        '<td>'+newAccount.product_name+'</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Montante</td>' +
        '<td>'+newAccount.amount+'</td>' +
        '</tr>' +
        '</table>';
    return account;

}

/**
 * Puts all the information about the account to SessionStorage to be present afterwards
 * when confirming the data
 * @param mForm
 */
function handleAddAccountForm(mForm) {
    var serialized = mForm.serializeArray();
    var account = {};

    // build key-values
    $.each(serialized, function(){
        account [this.name] = this.value;
    });
    account['product_name'] = $("#product option:selected").text();
    sessionStorage.setItem("newAccount",JSON.stringify(account));
    mForm[0].reset();
}

/**
 * Creates an hidden form used to send all the data of the users and account
 * to the server in order to create them.
 * @returns {string}
 */
function prepareDataToSend() {
    return "" +
        "<form method='post' id='addValidAccount'>"+
        "<input type='hidden' name='newAccount' value='"+sessionStorage.getItem("newAccount")+"'>"+
        "<input type='hidden' name='account' value='"+sessionStorage.getItem("account")+"'>" +
        "<input type='hidden' name='_token' value='"+$('meta[name="_token"]').attr('content')+"'>"+
        "<input type='hidden' name='cliData' value='"+sessionStorage.getItem("clientData")+"'>" +
        "<div>" +
        "<button type='submit' class='addAccountButton'>Criar nova conta</button>" +
        "<button type='button' id='back'>Voltar atrás</button>" +
        "</div>";
}

/**
 * Changes the attribute action of the form according with the type of account
 * we will create
 */
function addFormAction() {
    if (sessionStorage.getItem("accountType") == 'current') {
        $("#addValidAccount").attr('action','/account/current/add');
    }
    else if (sessionStorage.getItem("accountType") == 'saving'){
        $("#addValidAccount").attr('action','/account/saving/add');
    }
    else {
        $("#addValidAccount").attr('action','/account/loan/add');
    }
}