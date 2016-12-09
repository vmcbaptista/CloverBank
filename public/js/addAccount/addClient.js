/**
 * Gets all the information filled about the new client and puts is on
 * SessionStorage to don't loose them when going through the process
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
        $("#body").html(html.more_users);
        history.pushState({html: $("#body").html()},'','?moreUsers');
        event.preventDefault();
    })
}