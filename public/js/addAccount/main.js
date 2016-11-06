/**
 * Created by vmcb on 01-11-2016.
 */

var html = {
    search_form:''+
    '<form method="POST" id="searchCliForm">'+
    '<label>Número de Contribuinte</label><br>'+
    '<input type="text" name="nif"><br>'+
    '<input id="submit" type="submit" value="Procurar cliente">'+
    '</form>',
    product_type:'' +
    '<p>Selecione o tipo de conta que pretende criar:</p>' +
    '<button id="current">Conta à Ordem</button>' +
    '<button id="saving">Conta Poupança</button>' +
    '<button id="loan">Empréstimo</button>',
    current_form:'' +
    '<form method="post" id="addAccount">'+
    '<label>Produto</label><br>'+
    '<select id="product" name="product">'+
    '<option></option>'+
    '</select>'+
    '<label id="amountLabel">Depósito Inicial</label><br>'+
    '<input id="amount" type="text" name="amount" disabled><br>'+
    '<button type="submit">Criar nova conta</button>' +
    '</form>',
    more_users:'' +
    '<p>Deseja juntar mais algum titular a esta conta?' +
    '<button id="new">Novo cliente</button>' +
    '<button id="existing">Cliente já existente</button>' +
    '<button id="next">Não desejo adicionar mais nenhum titular</button>'
};

$().ready(function () {
    sessionStorage.SessionName = "clientData";
    sessionStorage.setItem("clientData", JSON.stringify([]));

    $("#body").on("click","#current",function () {
        $("#body").html(html.current_form);
        $("#addAccount").attr('action','/account/current/add');
        getProducts('current');
    })
        .on("click","#saving",function () {
            $("#body").html(html.current_form);
            $("#addAccount").attr('action','/account/saving/add');
            getProducts('saving');
        })
        .on("click","#loan",function () {
            $("#body").html(html.current_form);
            $("#amountLabel").text("Montante Pretendido");
            $("#addAccount").attr('action','/account/loan/add');
            getProducts('loan');

        })
        .on("click","#next",function () {
            $("#body").html(html.product_type);
        })
        .on("click","#existing",function () {
            $("#body").html(html.search_form);
            handleSearchForm();
            handleSearchResults()
        })
        .on("click","#new",function () {
            $.get("/client/register", function(data){
                $("#body").html(data);
            })
        })
        .on("change","#product",function() {
            $("#amount").removeAttr("disabled");
        })
        .on("submit","#addAccount",function (e) {
            $(this).append(
                "<input type='hidden' name='_token' value='"+$('meta[name="_token"]').attr('content')+"'>"+
                "<input type='hidden' name='cliData' value='"+sessionStorage.getItem("clientData")+"'>"
            );
            return true;
        });

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

    $("#product").change(function () {
        $("#amount").removeAttr("disabled");
    });
});