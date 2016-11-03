/**
 * Created by vmcb on 01-11-2016.
 */
$().ready(function () {
    $("#product").change(function () {
        $("#amount").removeAttr("disabled");
    });


    $("#addAccount").submit(function (e) {
        $(this).append(
          "<input type='hidden' name='cliData' value='"+sessionStorage.getItem("clientData")+"'>"
        );
        return true;
    })
});