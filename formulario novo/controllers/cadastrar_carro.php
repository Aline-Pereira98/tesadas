<?php
// var_dump($_POST);
header('Content-Type: application/json');

include_once '../database/connection.php';
include_once '../class/Carro.php';

$sql = "SELECT * FROM tbl_veiculo";
$search = $conn->query($sql);

$result = array(); // Inicialize a variável $result

while($row = mysqli_fetch_array($search)) {
    $result[] = $row;
}

// Para exibir o array de forma legível
echo json_encode($result);

// verificando se os dados foram enviados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // var_dump($_POST); 
    $carro = new Carro($conn);

    // verificar se os campos do formulário foram preenchidos
    if (!empty($_POST['placa']) && !empty($_POST['chassi']) && !empty($_POST['modelo']) && !empty($_POST['montadora']) && isset($_POST['situacao'])) {
        $carro->placa = $_POST['placa'];
        $carro->chassi = $_POST['chassi'];
        $carro->modelo = $_POST['modelo'];
        $carro->montadora = $_POST['montadora'];
        $carro->situacao = $_POST['situacao'];

        // chamar o método create para inserir o carro no banco de dados
        if ($carro->create()) {
            echo "Veículo cadastrado com sucesso!"; 
        } else {
            echo "Erro ao cadastrar veículo"; 
        }
    } else {
        echo "Por favor, preencha todos os campos do formulário."; 
    }
}
?>
