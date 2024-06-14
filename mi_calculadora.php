<!DOCTYPE html>
<html>
<head>
    <title>Calculadora</title>
</head>
<body>

<h2>Calculadora</h2>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Primer número: <input type="text" name="num1" id="num1"><br>
    Segundo número: <input type="text" name="num2" id="num2"><br>
    Operación:
    <select name="operacion" id="operacion">
        <option value="sumar">Sumar</option>
        <option value="restar">Restar</option>
        <option value="multiplicar">Multiplicar</option>
        <option value="dividir">Dividir</option>
    </select><br>
    <input type="submit" name="submit" value="Calcular">
    <input type="button" value="Limpiar" onclick="limpiarCampos()">
</form>

<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si los campos de entrada están establecidos y contienen valores válidos
    if (isset($_POST['num1']) && isset($_POST['num2']) && isset($_POST['operacion'])) {
        // Obtener los valores del formulario y convertir a números
        $num1 = floatval($_POST['num1']);
        $num2 = floatval($_POST['num2']);
        $operacion = $_POST['operacion'];

        // Realizar la operación según la selección del usuario
        switch ($operacion) {
            case 'sumar':
                $resultado = $num1 + $num2;
                echo "<h3>Operación realizada: Sumar</h3>";
                echo "<p>$num1 + $num2 = $resultado</p>";
                break;
            case 'restar':
                $resultado = $num1 - $num2;
                echo "<h3>Operación realizada: Restar</h3>";
                echo "<p>$num1 - $num2 = $resultado</p>";
                break;
            case 'multiplicar':
                $resultado = $num1 * $num2;
                echo "<h3>Operación realizada: Multiplicar</h3>";
                echo "<p>$num1 * $num2 = $resultado</p>";
                break;
            case 'dividir':
                if ($num2 != 0) {
                    $resultado = $num1 / $num2;
                    echo "<h3>Operación realizada: Dividir</h3>";
                    echo "<p>$num1 / $num2 = $resultado</p>";
                } else {
                    $resultado = 'Error: división por cero';
                    echo "<h3>Operación realizada: Dividir</h3>";
                    echo "<p>Error: división por cero</p>";
                }
                break;
            default:
                $resultado = 'Operación no válida';
                echo "<h3>Operación realizada: Operación no válida</h3>";
        }

        // Mostrar el resultado
        echo "<br>Resultado: $resultado";
    } else {
        // Mostrar un mensaje de error si los campos de entrada no están establecidos
        echo "Error: Todos los campos son requeridos";
    }
}
?>

<script>
function limpiarCampos() {
    document.getElementById('num1').value = '';
    document.getElementById('num2').value = '';
    document.getElementById('operacion').selectedIndex = 0; // Reiniciar la selección de operación
    document.getElementById('resultado').innerHTML = ''; // Limpiar el área de resultado
}
</script>

</body>
</html>
