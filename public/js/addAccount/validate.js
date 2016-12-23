/**
 * Validates the forms used to create all the types of account
 */
function validateAccountForm() {
    $("#addAccount").validate({
        errorElement:'div',
        rules: {
            product: "required",
            amount: {
                required: true,
                digits: true,
                // Checks if the amount filled satisfies the conditions of the selected account
                remote: {
                    url: '/account/' + sessionStorage.getItem('accountType') + '/validateAmount/',
                    type: 'get',
                    data: {
                        amount: function () {
                            return $("#amount").val();
                        },
                        product: function () {
                            return $("#product").val();
                        },
                        account: function () {
                            return sessionStorage.getItem('account');
                        }
                    }
                }
            }
        },
        messages: {
            product: "O campo produto é obrigatório",
            amount: {
                required: "O campo montante/depósito inicial é obrigatório",
                number: "Certifique-se que apenas introduziu valores numéricos.",
                remote: "O montante/depósito inicial não satisfaz as condições para o produto selecionado."
            }
        }
    });
}

/**
 * Validates the forms that allow the creation of clients
 */
function validateAddClientForm() {
    $("#addCliForm").validate({
        errorElement:'div',
        rules: {
            name: "required",
            address: "required",
            email: {
                required:true,
                email:true
            },
            phone: {
                required:true,
                minlength: 9,
                maxlength: 9,
                digits:true,
            },
            nif: {
                required:true,
                minlength: 9,
                maxlength: 9,
                digits:true,
                // Check if the NIF already exists on the DB
                remote: {
                    url: '/client/checkNif',
                    type: 'get',
                    data: {
                        nif: function() {
                            return $("#nif").val();
                        }
                    }
                }
            },
        },
        messages: {
            name: "O campo Nome é obrigatório",
            address: "O campo Morada é obrigatório",
            email: {
                required: "O campo Email é obrigatório",
                email: "Certifique-se que introduziu um e-mail válido",
            },
            phone: {
                required: "O campo Telefone é obrigatório",
                minlength: "Certifique-se que introduziu um número válido",
                maxlength: "Certifique-se que introduziu um número válido",
                digits:"Certifique-se que introduziu um número válido"
            },
            nif: {
                required: "O campo Número de Contribuinte é obrigatório",
                minlength: "Certifique-se que introduziu um Número de Contribuinte válido",
                maxlength: "Certifique-se que introduziu um Número de Contribuinte válido",
                digits: "Certifique-se que introduziu um Número de Contribuinte válido",
                remote: "Já existe um cliente com o Número de Contribuinte introduzido"
            }
        }
    });
}