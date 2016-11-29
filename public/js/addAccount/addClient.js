/**
 * Created by vmcb on 01-11-2016.
 */

function handleAddClientForm() {
    $("#body").on("submit","#addCliForm",function (event) {
        var serialized = $(this).serializeArray();
        var cliData = {};

        // build key-values
        $.each(serialized, function(){
            cliData [this.name] = this.value;
        });
        cliData['new'] = true;
        var clientData = JSON.parse(sessionStorage.getItem('clientData'));
        clientData.push(cliData);
        sessionStorage.setItem("clientData",JSON.stringify(clientData));
        $(this)[0].reset();
        $("#body").html(html.more_users).off("submit","#addCliForm");
        event.preventDefault();
    })
}

$().ready(function () {
    $('#zip2').on('input', function() {
        if($('#zip1').val().length == 4 && $('#zip2').val().length == 3) {
            console.log($('#zip1').val()+$('#zip2').val());
            requestAddress();
        }
    });
    $('#zip1').on('input', function() {
        if($('#zip1').val().length == 4 && $('#zip2').val().length == 3) {
            requestAddress()
        }
    });

    function requestAddress() {
        $.ajax({
            dataType: "jsonp",
            url:'http://codigospostais.appspot.com/cp7?codigo='+$('#zip1').val()+$('#zip2').val(),
            success: function (data) {
                $('#zipLoc').val(data.localidade);
                $('#address').val(data.arteria);
            },
            error: function (err) {
                alert('O código portal introduzido não foi reconhecido.\nPor favor introduza a morada manualmente.');
            }
        });
    }
});