<?php
$servername = "192.168.1.254";
$username = "root";
$password = "root.venus#2753";
$dbname = "teste_aline";

$conn = new mysqli(
    $servername, 
    $username, 
    $password, 
    $dbname
);


if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
