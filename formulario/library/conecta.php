<?php
error_reporting(E_ALL);

$server ="localhost";
$userDB="root";
$Password="";
$Bd="prueba1";
$connect = new mysqli($server, $userDB, $Password, $Bd);
if ($connect->connect_error) {
    die("Error al conectar la base de datos: " . $connect->connect_error);
} else {
    echo "Conexión exitosa";
}   
?>