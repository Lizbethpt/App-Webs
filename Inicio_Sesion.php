<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
</head>
<body>
<h2>Login</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <label for="usuario">Usuario:</label><br>
    <input type="text" id="usuario" name="usuario" required><br>
    <label for="password">Contraseña:</label><br>
    <input type="password" id="password" name="password" required><br>
    <input type="submit" name="submit" value="Iniciar Sesión">
    <input type="submit" name="submit" value="Cancelar">
    <a href="usuarios.php">Registro</a>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['submit'] == 'Iniciar Sesión') {
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

    $user = $_POST["usuario"];
    $pass = $_POST["password"];

    $sql = "SELECT clave FROM usuarios WHERE nombre = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();

    if (password_verify($pass, $hashed_password)) {
        header("Location: usuarios.php");
        exit();
    } else {
        echo "<p>Usuario o contraseña incorrectos. Por favor, inténtalo de nuevo.</p>";
    }

    $stmt->close();
    $conn->close();
}
?>
</body>
</html>
