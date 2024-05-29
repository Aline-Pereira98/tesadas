<?php

namespace Cadastro\repositories;

require_once dirname(__FILE__) . '/../database/Connection.php';
use Cadastro\database\Connection;

class BeneficiaryRepository
{
    private $conn;

    public function __construct()
    {

        $connection = new Connection();
        $this->conn = $connection->connectDB();
    }

    public function registerBeneficiary($beneficiary)
    {
        try {

            [
                'name' => $name,
                'cpf' => $cpf,
                'number' => $number,
                'street' => $street,
                'district' => $district,
                'city' => $city,
                'state' => $state,
                'phone' => $phone,
                'cell' => $cell,
                'situation' => $situation
            ] = $beneficiary;

            $sql = "INSERT INTO beneficiarios (nome, documento, logradouro, numero, bairro, cidade, uf, telefone, celular, situacao)
                    VALUES (?,?,?,?,?,?,?,?,?,?)";

            $query = $this->conn->prepare($sql);
            $query->bind_param('ssssssssss', $name,$cpf, $street,  $number, $district, $city, $state, $phone, $cell, $situation);

            if(!$query->execute()) {
                if($query-> errno === 1062) {
                    echo "Beneneficiario possui cadastro!" .PHP_EOL;
                }
            } else {
                echo "Cadastro realizado! Bem vindo(a), $this->name" .PHP_EOL;
            }

        } catch (Error $e) {
            var_dump($e);
            echo 'Exce??o: ', $e->getMessage(), "\n";
        }
    }

    public function getBeneficiary(string $cpf)
    {
        try {
            $sql = "SELECT * FROM beneficiarios WHERE documento = ? ";

            $query = $this->conn->prepare($sql);
            $query->bind_param('s', $cpf);
            $query->execute();
            $result = $query->get_result();
            if($result->num_rows === 0) {
                return ['error' => 'Beneficiário não encontrado'];
            } else {
                return $result->fetch_assoc();
            }

        } catch (Error $e) {
            var_dump($e);
            echo 'Exceção: ', $e->getMessage(), "\n";
        }
    }
}