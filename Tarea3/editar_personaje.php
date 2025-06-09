<?php
include 'funciones.php';

$personajes = leerJSON('datos/personajes.json');
$profesiones = leerJSON('datos/profesiones.json');

$id = $_GET['id'];
$personaje = $personajes[$id];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $personaje['nombre'] = $_POST['nombre'];
    $personaje['apellido'] = $_POST['apellido'];
    $personaje['fecha_nacimiento'] = $_POST['fecha_nacimiento'];
    $personaje['profesion'] = $_POST['profesion'];
    $personaje['experiencia'] = $_POST['experiencia'];

    if ($_FILES['foto']['name']) {
        $nombreFoto = uniqid() . '_' . $_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], 'imagenes/' . $nombreFoto);
        $personaje['foto'] = $nombreFoto;
    }

    $personajes[$id] = $personaje;
    guardarJSON('datos/personajes.json', $personajes);
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Editar Personaje</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container py-5">
    <h1 class="mb-4">✏️ Editar Personaje</h1>
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" value="<?= $personaje['nombre'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Apellido</label>
            <input type="text" name="apellido" class="form-control" value="<?= $personaje['apellido'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Fecha de nacimiento</label>
            <input type="date" name="fecha_nacimiento" class="form-control" value="<?= $personaje['fecha_nacimiento'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Profesión</label>
            <select name="profesion" class="form-control" required>
                <?php foreach ($profesiones as $p): ?>
                    <option value="<?= $p['nombre'] ?>" <?= $p['nombre'] == $personaje['profesion'] ? 'selected' : '' ?>>
                        <?= $p['nombre'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Nivel de experiencia</label>
            <select name="experiencia" class="form-control" required>
                <?php
                $niveles = ['Principiante', 'Intermedio', 'Avanzado'];
                foreach ($niveles as $nivel) {
                    $selected = $nivel == $personaje['experiencia'] ? 'selected' : '';
                    echo "<option value='$nivel' $selected>$nivel</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Cambiar foto (opcional)</label>
            <input type="file" name="foto" class="form-control">
            <p class="mt-2">Actual: <img src="imagenes/<?= $personaje['foto'] ?>" width="80"></p>
        </div>
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
</body>
</html>
