$("#activate_account").validate({
    errorElement:'div',
    rules: {
        product: "required",
        branch: "required",
        amount: {
            required: true,
            number: true
        }
    },
    messages: {
        product: "O campo produto é obrigatório",
        branch: "O campo branch é obrigatório",
        amount: {
            required: "O campo montante/depósito inicial é obrigatório",
            number: "Certifique-se que apenas introduziu valores numéricos.",
        }
    }
});