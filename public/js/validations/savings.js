$("#savingForm").validate({
    errorElement:'div',
    rules: {
        account: {
            required: true
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
        amount: {
            min: "Certifique-se que introduzi um valor positivo",
            required: "É obrigatório preencher o valor a transferir",
            number: "Certifique-se que apenas introduziu valores numéricos"
        }
    }
});