<?php
$nombre = "Yeison";
$apellido = "Castillo";
$edad = 29;
$carrera = "Desarrollo de Software";
$universidad = "ITLA";
$mayorEdad = ($edad >= 18) ? "Eres mayor de edad" : "Eres menor de edad";
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Mi Tarjeta</title>
  <style>
    body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }
    .navbar { background-color: #000; overflow: hidden; padding: 10px 0; text-align: center; }
    .navbar a { color: white; padding: 14px 20px; text-decoration: none; display: inline-block; font-weight: bold; }
    .navbar a:hover, .navbar a.active { background-color: #555; }
    .container { padding: 20px; text-align: center; }
    h2 { color: #333; }
    p { font-size: 18px; }
  </style>
</head>
<body>

<div class="navbar">
  <a href="mi_tarjeta.php" class="active">Mi Tarjeta</a>
  <a href="calculadora.php">Calculadora</a>
  <a href="adivina.php">Adivina</a>
  <a href="acerca_de.php">Acerca de</a>
</div>

<div class="container">
  <h2>Mi Tarjeta Personal</h2>
  <p><strong>Nombre:</strong> <?= htmlspecialchars("$nombre $apellido") ?></p>
  <p><strong>Edad:</strong> <?= htmlspecialchars($edad) ?></p>
  <p><strong>Carrera:</strong> <?= htmlspecialchars($carrera) ?></p>
  <p><strong>Centro:</strong> <?= htmlspecialchars($universidad) ?></p>
  <p><em><?= htmlspecialchars($mayorEdad) ?></em></p>
</div>

</body>
</html>

