$("#searchIBAN").validate({
    errorElement:'div',
    rules: {
        IBAN: {
            required: true,
            number: true,
            remote: {
                url: '/account/check',
                type: 'post',
                headers: {
                    'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                },
                data: {
                    IBAN: function () {
                        return $("#IBAN").val();
                    }
                }
            }

        }
    },
    messages: {
        IBAN: {
            required: "O campo IBAN é obrigatório",
            number: "Certifique-se que apenas introduziu valores numéricos",
            remote: "O IBAN introduzido não pertence ao Cloverbank"
        }
    }
});

$("#insert_amount").validate({
    errorElement:'div',
    rules: {
        amount: {
            required: true,
            number: true
        }
    },
    messages: {
        amount: {
            required: "É obrigatório preencher o valor a depositar",
            number: "Certifique-se que apenas introduziu valores numéricos"
        }
    }
});

$("#searchCliForm").validate({
    errorElement:'div',
    rules: {
        nif: {
            required: true,
            digits: true,
            minlength: 9,
            maxlength: 9
        }
    },
    messages: {
        nif: {
            required: "O campo NIF é obrigatório",
            minlength: "Certifique-se que introduziu um Número de Contribuinte válido",
            maxlength: "Certifique-se que introduziu um Número de Contribuinte válido",
            digits: "Certifique-se que introduziu um Número de Contribuinte válido"
        }
    }
});