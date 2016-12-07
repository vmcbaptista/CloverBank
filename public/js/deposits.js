/**
 * Created by paulomendez on 06/12/16.
 */
$().ready(function(){

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