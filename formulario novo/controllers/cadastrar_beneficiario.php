<?php

include_once '../database/connection.php';
include_once '../class/Beneficiario.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    var_dump($_POST); // Debug: verificar se os dados do formulário foram enviados corretamente

    $beneficiario = new Beneficiario($conn);
    echo "to aqui 1". PHP_EOL;

    // Atribuir os valores do formulário às propriedades da classe Beneficiario
    $beneficiario->nome = $_POST['nome'];
    $beneficiario->documento = $_POST['documento'];
    $beneficiario->email = $_POST['email'];
    $beneficiario->cep = $_POST['cep'];
    $beneficiario->rua = $_POST['rua'];
    $beneficiario->numero = $_POST['numero'];
    $beneficiario->bairro = $_POST['bairro'];
    $beneficiario->cidade = $_POST['cidade'];
    $beneficiario->estado = $_POST['estado'];
    $beneficiario->senha = $_POST['senha'];

    if ($beneficiario->create()) {
        echo "to aqui 2". PHP_EOL;
        echo "Beneficiário cadastrado!";
    } else {
        echo "to aqui 3". PHP_EOL;
        echo "Erro ao cadastrar beneficiário.";
    }
} else {
    echo "to aqui 4". PHP_EOL;
    echo "O formulário não foi enviado.";
}
?>
