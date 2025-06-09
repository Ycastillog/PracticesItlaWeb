<?php
include 'funciones.php';
$personajes = leerJSON('datos/personajes.json');
$profesiones = leerJSON('datos/profesiones.json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = generarID($personajes);
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $foto = $_FILES['foto']['name'];
    $profesion = $_POST['profesion'];
    $experiencia = $_POST['experiencia'];

    move_uploaded_file($_FILES['foto']['tmp_name'], 'imagenes/' . $foto);

    $personaje = [
        'id' => $id,
        'nombre' => $nombre,
        'apellido' => $apellido,
        'fecha_nacimiento' => $fecha_nacimiento,
        'foto' => $foto,
        'profesion' => $profesion,
        'experiencia' => $experiencia
    ];

    $personajes[] = $personaje;
    guardarJSON('datos/personajes.json', $personajes);
    header('Location: index.php');
    exit;
}

$listaProfesiones = array_column($profesiones, 'nombre');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registrar Personaje</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container py-5">
    <h1>Registrar Personaje</h1>
    <form method="POST" enctype="multipart/form-data">
        <input class="form-control my-2" type="text" name="nombre" placeholder="Nombre" required>
        <input class="form-control my-2" type="text" name="apellido" placeholder="Apellido" required>
        <input class="form-control my-2" type="date" name="fecha_nacimiento" required>
        <input class="form-control my-2" type="file" name="foto" accept="image/*" required>
        <select class="form-control my-2" name="profesion" required>
            <option value="">Seleccionar profesión</option>
            <?php foreach ($listaProfesiones as $p): ?>
                <option value="<?= $p ?>"><?= $p ?></option>
            <?php endforeach; ?>
        </select>
        <select class="form-control my-2" name="experiencia" required>
            <option value="Principiante">Principiante</option>
            <option value="Intermedio">Intermedio</option>
            <option value="Avanzado">Avanzado</option>
        </select>
        <button class="btn btn-primary" type="submit">Registrar</button>
    </form>
</body>
</html>
