$("#payment_form").validate({
    errorElement:'div',
    rules: {
        account: {
            required: true
        },
        entity: {
            required: true,
            digits: true
        },
        phone_number: {
            required: true,
            minlength: 9,
            maxlength: 9,
            digits: true
        },
        reference: {
            required: true,
            digits: true
        },
        amount: {
            min: 0.1,
            required: true,
            number: true
        }
    },
    messages: {
        account: {
            required: "É obrigatória a seleção da conta de origem"
        },
        entity: {
            required: "O campo entidade é de preenchimento obrigatório",
            digits:"Certifique-se que introduziu uma entidade válida"
        },
        reference: {
            required: "O campo referência é de preenchimento obrigatório",
            digits:"Certifique-se que introduziu uma referência válida"
        },
        phone_number: {
            required: "O campo Telefone é obrigatório",
            minlength: "Certifique-se que introduziu um número válido",
            maxlength: "Certifique-se que introduziu um número válido",
            digits:"Certifique-se que introduziu um número válido"
        },
        amount: {
            min: "Certifique-se que introduziu um valor positivo",
            required: "É obrigatório preencher o valor a pagar",
            number: "Certifique-se que apenas introduziu valores numéricos"
        }
    }
});