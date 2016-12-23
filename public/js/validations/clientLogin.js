$("#loginForm").validate({
    errorElement:'div',
    rules: {
        username: {
            required: true
        },
        password: {
            required: true
        }
    },
    messages: {
        username: {
            required: "O campo Nome de Utilizador é obrigatório"
        },
        password: {
            required: "O campo Palavra-Passe é obrigatório"
        }
    }
});

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
            digits:true
        },
        nif: {
            required:true,
            minlength: 9,
            maxlength: 9,
            digits:true
        }
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
            digits: "Certifique-se que introduziu um Número de Contribuinte válido"
        }
    }
});

$("#changeForm").validate({
    errorElement:'div',
    rules: {
        PasswordAtual: {
            required: true
        },
        Newpassword: {
            required: true
        },
        ConfirmNewpassword: {
            required: true,
            equalTo:"#Newpassword"
        }
    },
    messages: {
        PasswordAtual: {
            required: "O campo Password atual é obrigatório"
        },
        Newpassword: {
            required: "O campo Nova password é obrigatório"
        },
        ConfirmNewpassword: {
            required: "O campo Confirme password é obrigatório",
            equalTo:"A palavra-passe não coincide"
        }
    }
});
$("#resetForm").validate({
    errorElement:'div',
    rules: {
        EmailManager: {
            required:true,
            email:true
        },
        NewPassword: {
            required: true
        },
        verificationCode: {
            required: true
        },
        ConfirmNewpassword: {
            required: true,
            equalTo:"#Newpassword"
        }

    },
    messages: {
        EmailManager: {
            required: "O campo Email é obrigatório",
            email: "Certifique-se que introduziu um e-mail válido"
        },
        Newpassword: {
            required: "O campo Nova password é obrigatório"
        },
        verificationCode: {
            required: "O campo Código de Verificação é obrigatório"
        },
        ConfirmNewpassword: {
            required: "O campo Confirme password é obrigatório",
            equalTo:"A palavra-passe não coincide"
        }
    }
});