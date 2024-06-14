<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
</head>
<body>
    <h2>Formulario de Registro</h2>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" required><br>
        <label for="correo">Correo electrónico:</label><br>
        <input type="email" id="correo" name="correo" required><br>
        <label for="clave">Clave:</label><br>
        <input type="password" id="clave" name="clave" required><br>
        <label for="estatus">Estatus:</label><br>
        <select id="estatus" name="estatus" required>
            <option value="activo">Activo</option>
            <option value="inactivo">Inactivo</option>
        </select><br>
        <label for="tipo_usuario">Tipo de usuario:</label><br>
        <select id="tipo_usuario" name="tipo_usuario" required>
            <option value="administrador">Administrador</option>
            <option value="normal">Normal</option>
        </select><br>
        <input type="submit" value="Registrar">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    }
    ?>
</body>
</html>
