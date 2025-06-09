<?php
include 'funciones.php';
$profesiones = leerJSON('datos/profesiones.json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = generarID($profesiones);
    $nombre = $_POST['nombre'];
    $categoria = $_POST['categoria'];
    $salario = floatval($_POST['salario']);

    $profesion = [
        'id' => $id,
        'nombre' => $nombre,
        'categoria' => $categoria,
        'salario' => $salario
    ];

    $profesiones[] = $profesion;
    guardarJSON('datos/profesiones.json', $profesiones);
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registrar Profesión</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container py-5">
    <h1>Registrar Profesión</h1>
    <form method="POST">
        <input class="form-control my-2" type="text" name="nombre" placeholder="Nombre de la profesión" required>
        <select class="form-control my-2" name="categoria" required>
            <option value="">Seleccionar categoría</option>
            <option value="Ciencia">Ciencia</option>
            <option value="Arte">Arte</option>
            <option value="Deporte">Deporte</option>
            <option value="Entretenimiento">Entretenimiento</option>
            <option value="Salud">Salud</option>
            <option value="Moda">Moda</option>
        </select>
        <input class="form-control my-2" type="number" step="0.01" name="salario" placeholder="Salario mensual ($USD)" required>
        <button class="btn btn-primary" type="submit">Registrar</button>
    </form>
</body>
</html>
