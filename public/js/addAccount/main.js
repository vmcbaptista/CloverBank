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
    '</form>',
    search_form:''+
    '<form method="POST" id="searchCliForm">'+
    '<label>Insira o Número de Contribuinte do Cliente que deseja procurar</label><br>'+
    '<input type="text" name="nif"><br>'+
    '<input id="submit" type="submit" class="searchButton" value="Procurar cliente">'+
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
    '</form>',
    first_user:'' +
    '<p>Selecione uma das seguintes opções para o 1º Titular da Conta</p>' +
    '<div class="buttons">' +
    '<button id="new">Novo cliente</button>' +
    '<button id="existing">Cliente já existente</button>' +
    '</div>',
    more_users:'' +
    '<p>Deseja juntar mais algum titular a esta conta?' +
    '<div class="buttons">' +
    '<button id="new">Novo cliente</button>' +
    '<button id="existing">Cliente já existente</button>' +
    '<button id="next">Não desejo adicionar mais nenhum titular</button>' +
    '</div>'
};

function getProducts(type) {
    $.getJSON('/product/'+type,'',function (data) {
        for (i = 0; i < data.length; i++) {
            $.ajax({
                url:'/product/'+data[i].product_id,
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

    $("#body").on("click","#current",function () {
        $("#body").html(html.first_user);
        sessionStorage.setItem("accountType", 'current');
    })
        .on("click","#next",function () {
            $("#body").html(html.account_form);
            $("#addAccount").attr('action','/account/current/add');
            getProducts('current');
        })
        .on("click","#saving",function () {
            sessionStorage.setItem("accountType", 'saving');
            $("#body").html(html.search_form);
            handleSearchForm();
            handleSearchResults();
        })
        .on("click","#loan",function () {
            sessionStorage.setItem("accountType", 'loan');
            $("#body").html(html.search_form);
            handleSearchForm();
            handleSearchResults();
        })
        .on("click","#existing",function () {
            $("#body").html(html.search_form);
            handleSearchForm();
            handleSearchResults();
        })
        .on("click","#new",function () {
            $("#body").html(html.add_client);
            handleAddClientForm();
        })
        .on("change","#product",function() {
            $("#amount").removeAttr("disabled");
        })
        .on("submit","#addAccount",function (e) {
            $(this).append(
                "<input type='hidden' name='account' value='"+sessionStorage.getItem("account")+"'>"+
                "<input type='hidden' name='_token' value='"+$('meta[name="_token"]').attr('content')+"'>"+
                "<input type='hidden' name='cliData' value='"+sessionStorage.getItem("clientData")+"'>"
            );
            return true;
        });

    $("#product").change(function () {
        $("#amount").removeAttr("disabled");
    });
});