<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once dirname(__FILE__) . '/../controllers/CarsController.php';

$idBeneficiary = $_GET['id'];
$controller = new CarsController();
$cars = $controller->getCarsBeneficiary($idBeneficiary);

if(isset($_POST['delete'])) {
    $controller->deleteCar($_POST['delete']);
    header("location: homeCars.php?id=$idBeneficiary");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="./assets/icon-title.png">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/homeCars.css">
    <title>Veículos | Cadastro</title>
</head>
<body>
<div id="container">
    <a id="house" href="index.php"><img id="house-img" src="../assets/house.svg" alt=""></a>
    <div id="background-container">
        <img src="../assets/background.png" alt="">
    </div>
    <div id="form">
        <div id="form-titles__container">
            <h1>Veículos</h1>
            <h3>Informações dos veículos</h3>
        </div>
        <div class="form-home__inputs">
            <div id="button-container">
                <button onclick="window.location.href = './registerCars.php?id=<?php echo $idBeneficiary; ?>'" type="submit">Cadastrar veículo</button>
            </div>
        </div>
        <div class="diviser"></div>
        <h3 class="subtitles">Veículos cadastrados</h3>
        <div id="cars-list__container">
            <?php if(isset($cars)) {
                foreach($cars as $car){ ?>
                    <div class="cars-itens__container">
                        <div class="cars-infos__container">
                            <div class="table-container">
                                <table>
                                    <thead>
                                        <th>Modelo</th>
                                        <th>Montadora</th>
                                        <th>Placa</th>
                                        <th>Chassi</th>
                                        <th>Ano de fabricação</th>
                                        <th>Ano do modelo</th>
                                        <th>Situação</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $car['modelo']; ?></td>
                                            <td><?php echo $car['montadora']; ?></td>
                                            <td><?php echo $car['placa']; ?></td>
                                            <td><?php echo $car['chassi']; ?></td>
                                            <td><?php echo $car['ano_fabricacao'];?></td>
                                            <td><?php echo $car['ano_modelo']; ?></td>
                                            <td><?php echo $car['situacao']; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div id="buttons-home__container">
                                <div>
                                    <button onclick="window.location.href = './updateCar.php?id=<?php echo $car['id']; ?>'" class="button-home" name="submit">Alterar</button>
                                </div>
                                <div>
                                    <form action="homeCars.php?id=<?php echo $idBeneficiary; ?>" method="post">
                                        <button type="submit" class="button-home" name="delete" value="<?php echo $car['id']; ?>">Excluir</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
             <?php }} ?>
        </div>
    </div>
</div>
<script src="js/cars.js" type="module"></script>
</body>
</html>