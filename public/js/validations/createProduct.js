$("#createProduct").validate({
    errorElement:'div',
    rules: {
        prod_type: {
            required: true
        },
        name: {
            required: true
        },
        description: {
            required: true
        },
        access_condition: {
            required: true
        },
        min_amount: {
            required: true,
            number: true,
            min: 0.01
        },
        max_amount: {
            required: true,
            number: true,
            min: 0.01
        },
        rate: {
            required: true,
            number: true,
            min: 0.01
        },
        spread: {
            required: true,
            number: true,
            min: 0.01
        },
        IPC_tax: {
            required: true,
            number: true,
            min: 0.01
        },
        duration: {
            required: true,
            number: true,
            min: 1
        },
        tanb: {
            required: true,
            number: true,
            min: 0.01
        },
        BS_tax: {
            required: true,
            number: true,
            min: 0.01
        },
        reinforcements: {
            required: true
        },
        maint_costs: {
            required: true,
            number: true,
            min: 0.01
        }
    },
    messages: {
        prod_type: {
            required: "O campo tipo de produto é obrigatório"
        },
        name: {
            required: "O campo nome do produto é obrigatório"
        },
        description: {
            required: "O campo descrição é obrigatório"
        },
        access_condition: {
            required: "O campo condições de acesso é obrigatório"
        },
        min_amount: {
            required: "O campo montante mínimo é obrigatório",
            number: "Certifique-se que introduziu um valor numérico",
            min: "Certifique-se que introduziu um valor positivo"
        },
        max_amount: {
            required: "O campo montante máximo é obrigatório",
            number: "Certifique-se que introduziu um valor numérico",
            min: "Certifique-se que introduziu um valor positivo"
        },
        rate: {
            required: "O campo taxa de juro é obrigatório",
            number: "Certifique-se que introduziu um valor numérico",
            min: "Certifique-se que introduziu um valor positivo"
        },
        spread: {
            required: "O campo spread é obrigatório",
            number: "Certifique-se que introduziu um valor numérico",
            min: "Certifique-se que introduziu um valor positivo"
        },
        IPC_tax: {
            required: "O campo imposto de selo é obrigatório",
            number: "Certifique-se que introduziu um valor numérico",
            min: "Certifique-se que introduziu um valor positivo"
        },
        duration: {
            required: "O campo duração é obrigatório",
            number: "Certifique-se que introduziu um valor numérico",
            min: "Certifique-se que introduziu um valor positivo"
        },
        tanb: {
            required: "O campo taxa de juro é obrigatório",
            number: "Certifique-se que introduziu um valor numérico",
            min: "Certifique-se que introduziu um valor positivo"
        },
        BS_tax: {
            required: "O campo imposto é obrigatório",
            number: "Certifique-se que introduziu um valor numérico",
            min: "Certifique-se que introduziu um valor positivo"
        },
        reinforcements: {
            required: "O campo permite reforços é obrigatório"
        },
        maint_costs: {
            required: "O campo custos de manutenção é obrigatório",
            number: "Certifique-se que introduziu um valor numérico",
            min: "Certifique-se que introduziu um valor positivo"
        }
    }
});