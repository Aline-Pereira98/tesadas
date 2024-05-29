<?php
namespace Cadastro\database;
require_once dirname(__FILE__) . '/../config.php';
use mysqli;

class Connection
{
    public function connectDB()
    {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME);

        if($conn) {
            return $conn;
        } else {
            echo 'Deu ruim parça!';
        }


    }
}