<?php
var_dump($_POST);

include_once '../class/Carro.php';

// verificando se os dados foram enviados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo 'toaqui';
    var_dump($_POST); 
    $carro = new Carro($conn);

    // verificar se os campos do formulário foram preenchidos
    if (!empty($_POST['placa']) && !empty($_POST['chassi']) && !empty($_POST['modelo']) && !empty($_POST['montadora']) && isset($_POST['situacao'])) {
        echo 'toaqui 2';
        $carro->placa = $_POST['placa'];
        $carro->chassi = $_POST['chassi'];
        $carro->modelo = $_POST['modelo'];
        $carro->montadora = $_POST['montadora'];
        $carro->situacao = $_POST['situacao'];

        // chamar o método create para inserir o carro no banco de dados
        if ($carro->create()) {
            echo 'toaqui 3';
            // echo "Veículo cadastrado com sucesso!"; 
        } else {
            echo 'toaqui 4';
            echo "Erro ao cadastrar veículo"; 
        }
    } else {
        echo 'toaqui 5';
        echo "Por favor, preencha todos os campos do formulário."; 
    }
} else {
    echo "O formulário não foi enviado."; // se o método de envio não for POST
}
?>
