<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$servername = "localhost";
$username = "root";
$password = "12345";
$dbname = "registro";


// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$clave = password_hash($_POST['clave'], PASSWORD_BCRYPT); // Encriptar la clave
$estatus = $_POST['estatus'];
$tipo_usuario = $_POST['tipo_usuario'];

// Insertar datos en la base de datos
$sql = "INSERT INTO usuarios (nombre, correo_electronico, clave, estatus, tipo_usuario) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $nombre, $correo, $clave, $estatus, $tipo_usuario);

if ($stmt->execute()) {
    echo "Registro exitoso";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>
