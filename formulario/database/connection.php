<?php
// $servername = "192.168.1.254";
// $username = "root";
// $password = "root.venus#2753";
// $dbname = "teste_aline";

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "webassist_aline";

$conn = new mysqli(
    $servername, 
    $username, 
    $password, 
    $dbname
);


if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
