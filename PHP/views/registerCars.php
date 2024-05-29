<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once dirname(__FILE__) . '/../controllers/CarsController.php';

if(isset($_POST['submit'])){
    $idBeneficiary = $_GET['id'];
    $controler = new CarsController();
    $controler->newCar($_POST, intval($idBeneficiary));

    header("Location: homeCars.php?id=$idBeneficiary");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<link rel="icon" href="./assets/icon-title.png">
	<link rel="stylesheet" href="../css/reset.css">
	<link rel="stylesheet" href="../css/styles.css">
	<link rel="stylesheet" href="css/cars.css">
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
			<h1>Cadastro de Veículos</h1>
			<h3>Informe os dados do veículo a ser assegurado</h3>
		</div>
		<form id="register-container" action="registerCars.php?id=<?php echo $_GET['id']; ?>" method="post">
			<div class="cars-input__container">
				<div class="registers-input__container">
					<input data-type="automaker" type="text" class="input-registers" id="automaker" name="automaker" placeholder="Montadora" required>
					<div class="span-container">
						<img class="display-none" src="./assets/warning.svg" alt="">
						<span data-error="automaker" class="erros-registers display-none"></span>
					</div>
				</div>

				<div class="registers-input__container">
					<input data-type="model" type="text" class="input-registers" id="model" name="model" placeholder="Modelo" required>
					<div class="span-container">
						<img class="display-none" src="./assets/warning.svg" alt="">
						<span data-error="model" class="erros-registers display-none"></span>
					</div>
				</div>

				<div class="registers-input__container">
					<input data-type="year_manufacturing" type="text" class="input-registers" id="year_manufacturing" name="yearManufacturing" placeholder="Ano de fabricação" required>
					<div class="span-container">
						<img class="display-none" src="./assets/warning.svg" alt="">
						<span data-error="year_manufacturing" class="erros-registers display-none"></span>
					</div>
				</div>

				<div class="registers-input__container">
					<input data-type="year_model" type="text" class="input-registers" id="year_model" name="yearModel" placeholder="Ano do modelo" required>
					<div class="span-container">
						<img class="display-none" src="./assets/warning.svg" alt="">
						<span data-error="year_model" class="erros-registers display-none"></span>
					</div>
				</div>

				<div class="registers-input__container">
					<input data-type="plate" type="text" class="input-registers" id="plate" name="plate" placeholder="Placa" required>
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
                </div>
                <div class="diviser"></div>
                <div id="button-container">
                    <button type="submit" name="submit">Registrar</button>
                </div>
		</form>
	</div>
</div>
<script src="../js/cars.js" type="module"></script>
</body>
</html>