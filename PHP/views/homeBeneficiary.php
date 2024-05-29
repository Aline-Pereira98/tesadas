<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once dirname(__FILE__) . '/../controllers/BeneficiaryController.php';

if (isset($_POST['submit'])) {
    $controller = new BeneficiaryController();
    $beneficiary = $controller->getBeneficiary($_POST['cpf']);
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="../assets/icon-title.png">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/homeBeneficiaries.css">
    <title>Veículos | Cadastro</title>
</head>
<body>
<div id="container">
	<a id="house" href="../index.php"><img id="house-img" src="../assets/house.svg" alt=""></a>
	<div id="background-container">
		<img src="../assets/background.png" alt="">
	</div>
	<div id="form">
		<div id="form-titles__container">
			<h1>Beneficiários</h1>
			<h3>Informações</h3>
		</div>
		<form id="register-container" action="homeBeneficiary.php" method="post">
			<div class="form-home__inputs">
				<div class="registers-input__container">
					<input data-type="cpf" type="text" class="input-registers" id="cpf" name="cpf"
					       pattern="^[0-9]{3}.?[0-9]{3}.?[0-9]{3}-?[0-9]{2}" placeholder="Informe o CPF do beneficiário" required>
					<div class="span-container">
						<img class="display-none" src="../assets/warning.svg" alt="">
						<span data-error="cpf" class="erros-registers display-none"></span>
					</div>
				</div>

				<div id="button-container">
					<button type="submit" name="submit">Buscar</button>
				</div>
			</div>
		</form>
		<div class="diviser"></div>
		<h3 class="subtitles">Dados do beneficiário</h3>
        <?php if(isset($beneficiary) && count($beneficiary) > 1) { ?>
		<table>
			<tr class="table-info">
				<th class="table-info__names">Nome:</th>
				<td class="table-info__datas"><?php echo $beneficiary['nome']; ?></td>
			</tr>
			<tr class=table-info>
				<th class="table-info__names">Documento:</th>
				<td class="table-info__datas"><?php echo $beneficiary['documento']; ?></td>
			</tr>
			<tr class="table-info">
				<th class="table-info__names">Endereço:</th>
				<td class="table-info__datas"><?php echo $beneficiary['logradouro']; ?></td>
				<td class="table-info__datas"><?php echo $beneficiary['numero']; ?></td>
				<td class="table-info__datas"><?php echo $beneficiary['bairro']; ?></td>
				<td class="table-info__datas"><?php echo $beneficiary['cidade']; ?></td>
				<td class="table-info__datas"><?php echo $beneficiary['uf']; ?></td>
			</tr>
			<tr class="table-info">
				<th class="table-info__names">Contato:</th>
				<td class="table-info__datas"><?php echo $beneficiary['telefone']; ?></td>
				<td class="table-info__datas"><?php echo $beneficiary['celular']; ?></td>
			</tr>
		</table>
		<div id="buttons-home__container">
			<div>
				<button class="button-home" onclick="window.location.href = './homeCars.php?id=<?php echo $beneficiary['id']; ?>'" name="submit">Veículos</button>
			</div>
		</div>
        <?php } elseif(isset($beneficiary) && count($beneficiary) === 1) { ?>
        <h3 class="subtitles"><?php echo $beneficiary['error']; ?></h3>
        <?php } ?>
	</div>
</div>
<script src="../js/cars.js" type="module"></script>
</body>
</html>