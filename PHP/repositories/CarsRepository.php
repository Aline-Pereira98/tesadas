<?php

namespace Cadastro\repositories;

require_once dirname(__FILE__) . '/../database/Connection.php';
use Cadastro\database\Connection;

class CarsRepository
{
    private $conn;

    public function __construct()
    {
        $connection = new Connection();
        $this->conn = $connection->connectDB();
    }

    public function getCarsBeneficiary(string $idBeneficiary)
    {
        try {
            $sql = "SELECT v.* FROM veiculos v INNER JOIN beneficiarios b ON v.`id_beneficiario` = b.id WHERE b.id = ? ORDER BY v.id DESC";
            $query = $this->conn->prepare($sql);
            $query->bind_param('s', $idBeneficiary);

            if ($query->execute()) {
                return $query->get_result()->fetch_all(MYSQLI_ASSOC);
            }
        } catch (Error $e) {
            var_dump($e);
            echo 'Exce��o: ', $e->getMessage(), "\n";
        }
    }
    public function registerCar($car)
    {
        try {
            [
                'plate' => $plate,
                'chassi' => $chassi,
                'automaker' => $automaker,
                'model' => $model,
                'yearManufacturing' => $yearManufacturing,
                'yearModel' => $yearModel,
                'idBeneficiary' => $idBeneficiary,
                'situation' => $situation
            ] = $car;

            $sql = "INSERT INTO veiculos (placa, chassi, montadora, modelo, ano_fabricacao, ano_modelo, id_beneficiario, situacao)
                    VALUES (?,?,?,?,?,?,?,?)";

            $query = $this->conn->prepare($sql);
            $query->bind_param('ssssssis', $plate, $chassi, $automaker, $model, $yearManufacturing, $yearModel, $idBeneficiary, $situation);

            if(!$query->execute()) {
                if($query-> errno === 1062) {
                    echo "Ve�culo j� cadastrado!" .PHP_EOL;
                }
            } else {
                echo "Cadastro realizado!" .PHP_EOL;
            }

        } catch (Error $e) {
            var_dump($e);
            echo 'Exce??o: ', $e->getMessage(), "\n";
        }
    }

    public function deleteCar($idCar)
    {
        try {

            $sql = "DELETE FROM veiculos WHERE id = ? ";
            $query = $this->conn->prepare($sql);
            $query->bind_param('i', $idCar);
            $query->execute();
        } catch (Error $e) {
            var_dump($e);
            echo 'Exce??o: ', $e->getMessage(), "\n";
        }
    }

    public function getCarById($idCar)
    {
        try {

            $sql = "SELECT * FROM veiculos WHERE id = ? ";
            $query = $this->conn->prepare($sql);
            $query->bind_param('i', $idCar);
            $query->execute();
            $result = $query->get_result();
            if($result->num_rows === 0) {
                return ['error' => 'Benefici�rio n�o encontrado'];
            } else {
                return $result->fetch_assoc();
            }

        } catch (Error $e) {
            var_dump($e);
            echo 'Exce??o: ', $e->getMessage(), "\n";
        }
    }

    public function updateCarById($dataUpdate)
    {
        try {
            [
                'placa' => $placa,
                'chassi' => $chassi,
                'montadora' => $montadora,
                'modelo' => $modelo,
                'ano_fabricacao' => $ano_fabricacao,
                'ano_modelo' => $ano_modelo,
                'id_beneficiario' => $id_beneficiario,
                'situacao' => $situacao,
                'id' => $id
            ] = $dataUpdate;


            $sql = 'UPDATE veiculos SET 
                    placa = ? ,chassi = ? ,montadora = ?, modelo = ?, ano_fabricacao = ? ,ano_modelo = ? ,id_beneficiario = ?,situacao = ? 
                    WHERE id = ? ';

            $query = $this->conn->prepare($sql);
            $query->bind_param('ssssssisi', $placa, $chassi, $montadora, $modelo, $ano_fabricacao, $ano_modelo, $id_beneficiario, $situacao, $id);
            $query->execute();
        } catch (Error $e) {
            var_dump($e);
            echo 'Exce??o: ', $e->getMessage(), "\n";
        }
    }

}