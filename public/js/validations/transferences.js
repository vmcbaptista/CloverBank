$("#transferencesForm").validate({
    errorElement:'div',
    rules: {
        account: {
            required: true
        },
        Montante: {
            min: 0.1,
            required: true,
            number: true
        },
        PinCliente: {
            required: true
        },
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
                        console.log($("#IBAN").val());
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
        },
        account: {
            required: "É obrigatória a seleção da conta de origem"
        },
        Montante: {
            min: "Certifique-se que introduzi um valor positivo",
            required: "É obrigatório preencher o valor a transferir",
            number: "Certifique-se que apenas introduziu valores numéricos"
        },
        PinCliente: {
            required: "É obrigatório preencher o código de verificação"
        }
    }
});