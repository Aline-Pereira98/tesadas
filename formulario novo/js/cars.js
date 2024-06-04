$(document).ready(function() {
    obterVeiculos();

    const form = $("#form");
    const message = $('#message');

    const campos = {
        placa: $("#placa"),
        chassi: $("#chassi"),
        modelo: $("#modelo"),
        montadora: $("#montadora"),
        situacao: $("#situacao")
    };

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

        //armazenar os valores dos campos do formulário
        var formData = {};

        // Itera sobre os campos e adiciona seus valores ao objeto formData
        $.each(campos, function(key, campo) {
            formData[key] = campo.val();
        });

        // Verificar se o formulário está sendo serializado corretamente
        console.log("Dados do formulário:", formData);
        
        $.ajax({
            url: "../controllers/cadastrar_carro.php",
            method: "POST",
            data: formData, 
            
            success: function(response) {
                alert("Veículo cadastrado com sucesso!");
                window.location.replace('../home.html')
            },
            error: function(xhr, status, error) {
                alert("Erro ao cadastrar veículo."); 
            }
        });
    });    

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

    function checkForm() {
        let isValid = true;

        $.each(campos, function(_, campo) {
            if (!validarCampo(campo)) {
                isValid = false;
            }
        });

        return isValid;
    }

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


function obterVeiculos() {
    $.ajax({
        url: '../scripts/cadastrar_carro.php',
        method: 'GET',
        dataType: 'json',
        success: async (response) => {
            let html = "";
            response.map((carro) => {
                html += `<p>${carro.idVeiculo} | ${carro.placa} | ${carro.modelo}</p>`;
            })
            $("#result").html(html)
        },
        error: (error) => {
            console.log(error)
        }
    })
}