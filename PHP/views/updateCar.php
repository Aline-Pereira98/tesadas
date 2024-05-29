<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once dirname(__FILE__) . '/../controllers/CarsController.php';
$idCar = $_GET['id'];
$controller = new CarsController();
$car = $controller->getCar($idCar);

if(isset($_POST['submit'])) {
	$dataUpdate = $_POST;
    $controler = new CarsController();
    $controler->updateCar($car, $dataUpdate);
    header("Location: homeCars.php?id=" . $car['id_beneficiario']);
}


?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="./assets/icon-title.png">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/cars.css">
    <link rel="stylesheet" href="../css/homeCars.css">
    <title>Ve?culos | Cadastro</title>
</head>
<body>
<div id="container">
    <a id="house" href="index.php"><img id="house-img" src="../assets/house.svg" alt=""></a>
    <div id="background-container">
        <img src="../assets/background.png" alt="">
    </div>
    <div id="form">
        <div id="form-titles__container">
            <h1>Alterar veículo</h1>
        </div>
        <div class="diviser"></div>
        <h3>Dados do veículo</h3>
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
            </div>
        </div>
	    <div class="diviser"></div>
	    <form id="register-container" action="updateCar.php?id=<?php echo $idCar; ?>" method="post">
		    <h3>Insira nos campos as alterações necessárias</h3>
		    <div class="cars-input__container">

			    <div class="registers-input__container">
				    <input data-type="plate" type="text" class="input-registers" id="plate" name="placa" placeholder="Placa" required>
				    <div class="span-container">
					    <img class="display-none" src="./assets/warning.svg" alt="">
					    <span data-error="plate" class="erros-registers display-none"></span>
				    </div>
			    </div>

			    <div class="registers-input__container">
				    <input data-type="chassi" type="text" class="input-registers" id="chassi" name="chassi" placeholder="Número do chassi" required>
				    <div class="span-container">
					    <img class="display-none" src="./assets/warning.svg" alt="">
					    <span data-error="chassi" class="erros-registers display-none"></span>
				    </div>
			    </div>

			    <div class="registers-input__container">
				    <input data-type="automaker" type="text" class="input-registers" id="automaker" name="montadora" placeholder="Montadora" required>
				    <div class="span-container">
					    <img class="display-none" src="./assets/warning.svg" alt="">
					    <span data-error="automaker" class="erros-registers display-none"></span>
				    </div>
			    </div>

			    <div class="registers-input__container">
				    <input data-type="model" type="text" class="input-registers" id="model" name="modelo" placeholder="Modelo" required>
	                <div class="span-container">
	                    <img class="display-none" src="./assets/warning.svg" alt="">
	                    <span data-error="model" class="erros-registers display-none"></span>
                    </div>
                </div>

	            <div class="registers-input__container">
	                <input data-type="year_manufacturing" type="text" class="input-registers" id="year_manufacturing" name="ano_fabricacao" placeholder="Ano de fabricação" required>
	                <div class="span-container">
	                    <img class="display-none" src="./assets/warning.svg" alt="">
	                    <span data-error="year_manufacturing" class="erros-registers display-none"></span>
                    </div>
                </div>

	            <div class="registers-input__container">
	                <input data-type="year_model" type="text" class="input-registers" id="year_model" name="ano_modelo" placeholder="Ano do modelo" required>
	                <div class="span-container">
	                    <img class="display-none" src="./assets/warning.svg" alt="">
	                    <span data-error="year_model" class="erros-registers display-none"></span>
                    </div>
                </div>

                <div class="registers-input__container">
                    <select data-type="situation" class="input-registers" id="situation" name="situacao" placeholder="Situação" required>
                        <option value="" disabled selected>Situação</option>
                        <option value="A">Ativo</option>
                        <option value="I">Inativo</option>
                    </select>
                    <div class="span-container">
                        <img class="display-none" src="./assets/warning.svg" alt="">
                        <span data-error="situation" class="erros-registers display-none"></span>
                    </div>
                </div>
            </div>
            <div class="diviser"></div>
            <div id="button-container">
                <button type="submit" name="submit">Alterar</button>
            </div>
        </form>
    </div>
</div>
<script src="../js/cars.js" type="module"></script>
</body>
</html>
