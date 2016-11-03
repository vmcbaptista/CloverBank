/**
 * Created by vmcb on 01-11-2016.
 */
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


    $("#addCliForm").submit(function (event) {
        var serialized = $(this).serializeArray(),
            clientData = {};

        // build key-values
        $.each(serialized, function(){
            clientData [this.name] = this.value;
        });
        sessionStorage.SessionName = "clientData";
        sessionStorage.setItem("clientData",JSON.stringify(clientData));
        $('#client').val(JSON.parse(sessionStorage.getItem("clientData")).name);
        $(this)[0].reset();
        $("#createModal").css('display','none');
        $("#current").attr("selected","selected");
        $("#product").removeAttr('disabled');
        event.preventDefault();
    });
});