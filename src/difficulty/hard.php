<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="author" content="PGX">
	<!-- IMPORTANDO EL CSS -->
	<link rel="stylesheet" href="../style.css">
	<title>XSS-STORAGE</title>
	<script>
        function validarInput(event) {
            const key = event.key;
            const regex = /^[a-zA-Z0-9]$/; 
            if (!regex.test(key) && key !== 'Backspace' && key !== 'Tab') {
                event.preventDefault(); 
            }
        }
    </script>
</head>
<body>
<form method="post">
<div class="container">
<header>
<h2>XSS-STORAGE</h2><label id="difficulty">(Hard)</label>
</header>
<body>

<div id="inputs">
<input type="text" id="inp" name="code" maxlength="90" onkeydown="validarInput(event)" autocomplete="off">




</div>
<div id="mostrar">
<?php

$refresh = "<html><head>	<meta http-equiv='refresh' content='0'></head>";
function mostrarDatos() {
$conexion = new mysqli('localhost', 'root', '', 'laboratorio');
if ($conexion->connect_error) {
die("Conexión fallida: " . $conexion->connect_error);
}

$resultadoTablas = $conexion->query("SHOW TABLES");

if ($resultadoTablas->num_rows > 0) {
while ($fila = $resultadoTablas->fetch_array(MYSQLI_NUM)) {
$nombreTabla = $fila[0];
$resultadoRegistros = $conexion->query("SELECT * FROM $nombreTabla");
if ($resultadoRegistros->num_rows > 0) {

$n=1;
while ($registro = $resultadoRegistros->fetch_assoc()) {

echo "<tr>";
foreach ($registro as $valor) {
$valor = htmlspecialchars($valor);
echo "<font color='#5b7aff'>[$n]</font> $valor<br>";
$n++;
}
echo "</tr>";
}
} else {
echo "No existen codigos en la base de datos<br>";
}
}
} else {
echo "No hay tablas en la base de datos.";
}

$conexion->close();
}

mostrarDatos();
?>
</div>
<div id="buttons">
<?php
$conexion = new mysqli('localhost', 'root', '', 'laboratorio');
if ($conexion->connect_error) {
die("Conexión fallida: " . $conexion->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
if (isset($_POST['eliminar'])) {
$stmt = $conexion->prepare("DELETE FROM storage1");
if ($stmt->execute()) {
echo "Registros eliminados<br>$refresh";
} else {
echo "Error: " . $stmt->error . "<br>";
}
$stmt->close();
} elseif (isset($_POST['ejecutar'])) {
$code = $_POST['code'];
$code = htmlspecialchars($code);
$stmt = $conexion->prepare("INSERT INTO storage1 (code) VALUES (?)"); 
$stmt->bind_param("s", $code);
if ($stmt->execute()) {
echo "Registro agregado exitosamente.<br>$refresh";
} else {
echo "Error: " . $stmt->error . "<br>";
}
$stmt->close();
}


}

$conexion->close();
?>



<p>
<input type="submit" id="btn" name="eliminar" value="ELIMINAR">
<input type="submit" id="btn" name="ejecutar" value="EJECUTAR">
</p>
</div>
</div>
</form>
</body>

</html>