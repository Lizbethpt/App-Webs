<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "calculadora";
$port = 3307; 

$conn = new mysqli($servername, $username, $password, $database, $port);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
