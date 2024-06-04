<?php

include_once '../database/connection.php';

class Beneficiario {
    private $conn;
    private $table_name = "tbl_associado";

    public $nome;
    public $documento;
    public $email;
    public $cep;
    public $rua;
    public $numero;
    public $bairro;
    public $cidade;
    public $estado;
    public $senha;

    public function __construct($conn){
        $this->conn = $conn;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  (nome, documento, email, cep, rua, numero, bairro, cidade, estado, senha) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Preparar a consulta SQL
        $stmt = $this->conn->prepare($query);

        // Verificar se a preparação da consulta falhou
        if ($stmt === false) {
            die('Preparação da consulta deu ruim: ' . htmlspecialchars($this->conn->error));
        }

        // Sanitizar os dados para evitar injeção de SQL
        $this->sanitizeInputs();

        // Vincular parâmetros da consulta com os valores
        $stmt->bind_param(
            "ssssssssss",
            $this->nome, 
            $this->documento, 
            $this->email, 
            $this->cep, 
            $this->rua, 
            $this->numero, 
            $this->bairro, 
            $this->cidade, 
            $this->estado, 
            $this->senha
        );

        // Executar a consulta
        if ($stmt->execute()) {
            return true;
        } else {
            // Exibir mensagem de erro detalhada em caso de falha
            echo "Erro ao cadastrar beneficiário: " . htmlspecialchars($stmt->error);
        }

        return false;
    }

    // Método para sanitizar os dados
    private function sanitizeInputs() {
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->documento = htmlspecialchars(strip_tags($this->documento));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->cep = htmlspecialchars(strip_tags($this->cep));
        $this->rua = htmlspecialchars(strip_tags($this->rua));
        $this->numero = htmlspecialchars(strip_tags($this->numero));
        $this->bairro = htmlspecialchars(strip_tags($this->bairro));
        $this->cidade = htmlspecialchars(strip_tags($this->cidade));
        $this->estado = htmlspecialchars(strip_tags($this->estado));
        $this->senha = htmlspecialchars(strip_tags($this->senha));
    }
}
?>
