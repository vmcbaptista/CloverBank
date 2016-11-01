/**
 * Created by vmcb on 01-11-2016.
 */

$().ready(function () {
    $("#create").click(function () {
        $("#createModal").css('display', 'block');
    });

    $("#search").click(function () {
        $("#searchModal").css('display', 'block');
    });

    $(".close").click(function () {
        $("#createModal").css('display','none');
        $("#searchModal").css('display','none');
    });
});