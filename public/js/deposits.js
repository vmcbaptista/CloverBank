/**
 * Created by paulomendez on 06/12/16.
 */
$().ready(function(){

    sessionStorage.clear();

    sessionStorage.SessionName = "clientData";
    sessionStorage.setItem("clientData", JSON.stringify([]));

    handleSearchForm();
    handleSearchResults();

    // Reconfigures the views when the user goes back
    window.onpopstate = function(event) {
        location.href = "/deposits";
    };

    $("#body").on("click","#back",function () {
        location.href = "/deposits";
    });
});