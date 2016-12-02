/**
 * Created by vmcb on 01-11-2016.
 */

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
    '<input id="amount" type="text" name="amount" disabled>'+
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

function getProducts(type) {
    $.getJSON('/product/'+type,'',function (data) {
        // para cada produto do tipo passado obtem informações específicas sobre o mesmo
        for (i = 0; i < data.length; i++) {
            $.ajax({
                // O nome do produto encontra-se na tabela product
                url:'/product/'+data[i].product_id,
                // O id que importa associar à conta é o id do tipo de produto que é obtido no pedido AJAX anterior
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
    sessionStorage.SessionName = "clientData";
    sessionStorage.setItem("clientData", JSON.stringify([]));

    sessionStorage.SessionName = "accountType";
    sessionStorage.setItem("accountType", '');

    sessionStorage.SessionName = "account";
    sessionStorage.setItem("account", '');

    sessionStorage.SessionName = "newAccount";
    sessionStorage.setItem("newAccount", '');

    $("#body").on("click","#current",function () {
        sessionStorage.SessionName = "createAccount";
        sessionStorage.setItem("createAccount", 'true');
        $("#body").html(html.first_user);
        history.pushState({html: $("#body").html()},'','?current');
        sessionStorage.setItem("accountType", 'current');
    })
        .on("click","#next",function () {
            $("#body").html(html.account_form).off('click','#next');
            getProducts('current');
            validateAccountForm();
        })
        .on("click","#saving",function () {
            sessionStorage.SessionName = "createAccount";
            sessionStorage.setItem("createAccount", 'true');
            sessionStorage.setItem("accountType", 'saving');
            $("#body").html(html.search_form).off('click','#saving');
            history.pushState({html: $("#body").html()},'','?saving');
            handleSearchForm();
            handleSearchResults();
        })
        .on("click","#loan",function () {
            sessionStorage.SessionName = "createAccount";
            sessionStorage.setItem("createAccount", 'true');
            sessionStorage.setItem("accountType", 'loan');
            $("#body").html(html.search_form).off('click','#loan');
            history.pushState({html: $("#body").html()},'','?loan');
            handleSearchForm();
            handleSearchResults();
        })
        .on("click","#existing",function () {
            $("#body").html(html.search_form);
            history.pushState({html: $("#body").html()},'','?existing');
            handleSearchForm();
            handleSearchResults();
        })
        .on("click","#new",function () {
            $("#body").html(html.add_client);
            validateAddClientForm();
            history.pushState({html: $("#body").html()},'','?newClient');
            handleAddClientForm();
        }).on("click","#back",function () {
        window.history.back();
    })
        .on("change","#product",function() {
            $("#amount").removeAttr("disabled");
        })
        .on("submit","#addAccount",function (e) {
            history.pushState({html: $("#body").html()},'','?createCurrent');
            e.preventDefault();
            handleAddAccountForm($(this));
            $("#body").html(validateUsers()+validateAccount()+prepareDataToSend()).off('click','#addAccount');
            addFormAction();
            history.pushState({html: $("#body").html()},'','?validate');
        })
        .on("submit","#addValidAccount",function (e) {
            sessionStorage.clear();
            return true;
        });

    $("#product").change(function () {
        $("#amount").removeAttr("disabled");
    });

    history.pushState({html: $("#body").html()},'','?initial');
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

function removeLastClient() {
    clientData = JSON.parse(sessionStorage.getItem("clientData"));
    clientData.pop();
    sessionStorage.setItem("clientData",JSON.stringify(clientData));
}

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