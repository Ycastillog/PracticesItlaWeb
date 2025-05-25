<?php
$mensaje = "";
$numero_usuario = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $numero_usuario = intval($_POST["numero"] ?? 0);

    if ($numero_usuario < 1 || $numero_usuario > 5) {
        $mensaje = "<p style='color: red;'>Por favor, ingresa un número entre 1 y 5.</p>";
    } else {
        $numero_aleatorio = rand(1, 5);

        if ($numero_usuario === $numero_aleatorio) {
            $mensaje = "<p style='color: green;'>¡Felicidades! Adivinaste el número: <strong>$numero_aleatorio</strong></p>";
        } else {
            $mensaje = "<p style='color: red;'>¡Sigue intentando! El número correcto era: <strong>$numero_aleatorio</strong></p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Adivina el número</title>
  <style>
    body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }
    .navbar { background-color: #000; overflow: hidden; padding: 10px 0; text-align: center; }
    .navbar a { color: white; padding: 14px 20px; text-decoration: none; display: inline-block; font-weight: bold; }
    .navbar a:hover, .navbar a.active { background-color: #555; }
    .container { padding: 20px; text-align: center; }
    input { margin: 5px; padding: 8px; width: 80px; }
    h2 { color: #333; }
  </style>
</head>
<body>

<div class="navbar">
  <a href="mi_tarjeta.php">Mi Tarjeta</a>
  <a href="calculadora.php">Calculadora</a>
  <a href="adivina.php" class="active">Adivina</a>
  <a href="acerca_de.php">Acerca de</a>
</div>

<div class="container">
  <h2>Adivina un número del 1 al 5</h2>
  <form method="post" action="adivina.php">
    <input type="number" name="numero" min="1" max="5" required value="<?= $numero_usuario !== null ? $numero_usuario : '' ?>" />
    <input type="submit" value="Adivinar" />
  </form>

  <?= $mensaje ?>
</div>

</body>
</html>


