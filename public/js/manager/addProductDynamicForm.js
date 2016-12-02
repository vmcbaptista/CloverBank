/**
 * Created by fcl on 02/12/16.
 */
/*when the page is charged*/
$().ready(function(){
    if($("input[name='prod_type']").is(":checked")){
        /*This will show the things that a a user will see by default*/
        $("#form").append(htmlForm.basePart + htmlForm.currentPart)
    }
})
/*when radio button is clicked*/
$("input[name='prod_type']").click(function(){
    $("#form").empty()
    if(this.id=="current")
    {
        $("#form").append(htmlForm.basePart + htmlForm.currentPart)
    }
    else if(this.id=="saving"){
        $("#form").append(htmlForm.basePart + htmlForm.savingPart)
    }
    else{
        $("#form").append(htmlForm.basePart + htmlForm.loanPart)

    }
})

/*Has all the HTML to render the form for a new product*/
var htmlForm = {
    basePart:
    '<label for="name">Nome Produto: </label><br>'+
    '<input type="text" name="name" id="name"><br>'+
    '<label for="description">Condições de Acesso: </label><br>'+
    '<input type="text" name="access_condition" id="access_condition"><br>'+
    '<label for="description">Descrição: </label><br>'+
    '<input type="text" name="description" id="description"><br>'+
    '<label for="min_amount">Capital Mínimo: </label><br>'+
    '<input type="text" name="min_amount" id="min_amount"><br>'
    ,
    loanPart:
    '<label for="max_amount">Capital Máximo: </label><br>'+
    '<input type="text" name="max_amount" id="max_amount"><br>'+
    '<label for="rate">Taxa de Juro (TAN): </label><br>'+
    '<input type="text" name="rate" id="rate"><br>'+
    '<label for="spread">Spread: </label><br>'+
    '<input type="text" name="spread" id="spread"><br>'+
    '<label for="IPC_tax">Impostos e Comissões: </label><br>'+
    '<input type="text" name="IPC_tax" id="IPC_tax"><br>'+
    '<label for="duration">Prestações : </label><br>'+
    '<input type="text" name="duration" id="duration"><br>'
    ,
    savingPart:
    '<label for="max_amount">Capital Máximo: </label><br>'+
    '<input type="text" name="max_amount" id="max_amount"><br>'+
    '<label for="tanb">Taxa anual de juro nominal bruta - TANB (%): </label><br>'+
    '<input type="text" name="tanb" id="tanb"><br>'+
    '<label for="BS_tax">Imposto sobre juros (%): </label><br>'+
    '<input type="text" name="BS_tax" id="BS_tax"><br>'+
    '<label >Reforços de Capital: </label><br>'+
    '<label for="allow">Permitido: </label>'+
    '<input type="radio" name="reinforcements" id="allow" value="1">'+
    '<label for="not_allow">Não Permitido: </label>'+
    '<input type="radio" name="reinforcements" id="not_allow" value="0"/><br>'+
    '<label for="duration">Prazo (meses): </label><br>'+
    '<input type="text" name="duration" id="duration"><br>'
    ,
    currentPart:
    '<label for="maint_costs">Custos de Manutenção</label><br>'+
    '<input type="text" name="maint_costs" id="maint_costs"><br>'
}