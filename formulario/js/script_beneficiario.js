$(document).ready(function() {
    const form = $("#form");

    const campos = {
        username: $("#nome"),
        cpf: $("#cpf"),
        email: $("#email"),
        cep: $("#cep"),
        rua: $("#rua"),
        numero: $("#numero"),
        bairro: $("#bairro"),
        cidade: $("#cidade"),
        estado: $("#estado"),
        senha: $("#senha"),
        senhaconfirmacao: $("#senhaconfirmacao")
    }

    $.each(campos, function(_, campo) {
        campo.on("blur", function() {
            validarCampo(campo);
        });
    });

    

    $('#btnCadastro').on("click", function(event) {
        event.preventDefault();
        console.log("Botão clicado");

        if (!checkForm()) {
            console.log("Formulário inválido");
            return; 
        }

        // Armazenar os valores dos campos do formulário
        var formData = {};

        // Itera sobre os campos e adiciona seus valores ao objeto formData
        $.each(campos, function(key, campo) {
            formData[key] = campo.val();
        });

        // Verificar se o formulário está sendo serializado corretamente
        console.log("Dados do formulário:", formData);
        
        $.ajax({
            url: "../scripts/cadastrar_beneficiario.php",
            method: "POST",
            data: formData, 
            
            success: function(response) {
                alert("Beneficiario cadastrado com sucesso!!");
            },
            error: function(xhr, status, error) {
                alert("Erro ao cadastrar beneficiario."); 
            }
            
        });
        console.log("to aqui 2")
    });

    campos.cep.on('focusout', async () => {
        try {
            const onlyNumbers = /^[0-9]+$/;
            const cepValid = /^[0-9]{8}$/;

            if (!onlyNumbers.test(campos.cep.val()) || !cepValid.test(campos.cep.val())) {
                throw { cep_error: 'Cep inválido' };
            }

            const response = await fetch(`https://viacep.com.br/ws/${campos.cep.val()}/json/`);

            if (!response.ok) {
                throw await response.json();
            }

            const responseCep = await response.json();
            campos.rua.val(responseCep.logradouro);
            campos.bairro.val(responseCep.bairro);
            campos.cidade.val(responseCep.localidade);
            campos.estado.val(responseCep.uf);

        } catch (error) {
            if (error?.cep_error) {
                alert(error.cep_error); // Mostrar mensagem de erro usando alert
            }
            console.log(error);
        }
    });

    // Função para validar cada campo do formulário
    function validarCampo(campo) {
        const valor = campo.val();
        const formItem = campo.parent();

        if (valor === "") {
            errorInput(campo, "Este campo é obrigatório");
            return false;
        } else {
            formItem.removeClass('error');
            formItem.find(".error-message").remove();
            return true;
        }
    }

    // Função para verificar todo o formulário
    function checkForm() {
        let isValid = true;

        $.each(campos, function(_, campo) {
            if (!validarCampo(campo)) {
                isValid = false;
            }
        });

        return isValid;
    }

    // Exibir mensagem de erro no campo
    function errorInput(campo, mensagem) {
        const formItem = campo.parent();
        let textMessage = formItem.find(".error-message");

        if (textMessage.length === 0) {
            textMessage = $("<span class='error-message'></span>");
            formItem.append(textMessage);
        }

        textMessage.text(mensagem);
        formItem.addClass("error");
    }
});
