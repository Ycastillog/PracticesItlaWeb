<?php
$resultado = "";
$error = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $num1 = $_POST["num1"] ?? '';
    $num2 = $_POST["num2"] ?? '';
    $operacion = $_POST["operacion"] ?? '';

    if (!is_numeric($num1) || !is_numeric($num2)) {
        $resultado = "<span style='color: red;'>Por favor, ingresa números válidos.</span>";
        $error = true;
    } else {
        $num1 = floatval($num1);
        $num2 = floatval($num2);

        switch ($operacion) {
            case "sumar":
                $resultado = $num1 + $num2;
                break;
            case "restar":
                $resultado = $num1 - $num2;
                break;
            case "multiplicar":
                $resultado = $num1 * $num2;
                break;
            case "dividir":
                if ($num2 == 0) {
                    $resultado = "<span style='color: red;'>No se puede dividir entre cero.</span>";
                    $error = true;
                } else {
                    $resultado = $num1 / $num2;
                }
                break;
            default:
                $resultado = "<span style='color: red;'>Operación no válida.</span>";
                $error = true;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Calculadora</title>
  <style>
    body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }
    .navbar { background-color: #000; overflow: hidden; padding: 10px 0; text-align: center; }
    .navbar a { color: white; padding: 14px 20px; text-decoration: none; display: inline-block; font-weight: bold; }
    .navbar a:hover, .navbar a.active { background-color: #555; }
    .container { padding: 20px; text-align: center; }
    input, select { margin: 5px; padding: 8px; }
    h2 { color: #333; }
  </style>
</head>
<body>

<div class="navbar">
  <a href="mi_tarjeta.php">Mi Tarjeta</a>
  <a href="calculadora.php" class="active">Calculadora</a>
  <a href="adivina.php">Adivina</a>
  <a href="acerca_de.php">Acerca de</a>
</div>

<div class="container">
  <h2>Calculadora en PHP</h2>
  <form method="post" action="calculadora.php">
    <input type="number" name="num1" required value="<?= isset($_POST['num1']) ? htmlspecialchars($_POST['num1']) : '' ?>" />
    <select name="operacion" required>
      <option value="sumar" <?= (isset($_POST['operacion']) && $_POST['operacion'] === 'sumar') ? 'selected' : '' ?>>Sumar</option>
      <option value="restar" <?= (isset($_POST['operacion']) && $_POST['operacion'] === 'restar') ? 'selected' : '' ?>>Restar</option>
      <option value="multiplicar" <?= (isset($_POST['operacion']) && $_POST['operacion'] === 'multiplicar') ? 'selected' : '' ?>>Multiplicar</option>
      <option value="dividir" <?= (isset($_POST['operacion']) && $_POST['operacion'] === 'dividir') ? 'selected' : '' ?>>Dividir</option>
    </select>
    <input type="number" name="num2" required value="<?= isset($_POST['num2']) ? htmlspecialchars($_POST['num2']) : '' ?>" />
    <input type="submit" value="Calcular" />
  </form>

  <p><strong>Resultado:</strong> <?= $error ? $resultado : htmlspecialchars($resultado) ?></p>
</div>

</body>
</html>

