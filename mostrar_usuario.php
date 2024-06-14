<?php
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

$sql = "SELECT id, nombre, correo_electronico, estatus, tipo_usuario FROM usuarios";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Mostrar datos de cada fila
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Nombre: " . $row["nombre"]. " - Correo: " . $row["correo_electronico"]. " - Estatus: " . $row["estatus"]. " - Tipo de usuario: " . $row["tipo_usuario"]. "<br>";
    }
} else {
    echo "0 resultados";
}
$conn->close();
?>
