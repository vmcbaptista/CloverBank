/**
 * Created by fcl on 27-11-2016.
 */
function filterAccount() {
    $("#"+$("#account").val()+"").show();
}

$().ready(function () {
    $(".account_info").hide();
    filterAccount();
    $("#account").change(function () {
        $(".account_info").hide();
        filterAccount();
    });
});