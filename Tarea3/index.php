<?php
include 'funciones.php';

$personajes = leerJSON('datos/personajes.json');
$profesiones = leerJSON('datos/profesiones.json');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Inicio - Mundo Barbie</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="estilos.css">
</head>
<body class="container py-5">
    <h1 class="mb-4 text-center text-pink">🌸 Mundo Barbie - Panel Principal 🌸</h1>

    <div class="mb-4 d-flex gap-3 justify-content-center">
        <a class="btn btn-success" href="registrar_personaje.php">Registrar Personaje</a>
        <a class="btn btn-info" href="registrar_profesion.php">Registrar Profesión</a>
        <a class="btn btn-warning" href="dashboard.php">Ver Dashboard</a>
    </div>

    <h2>👩‍🎤 Personajes Registrados</h2>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Fecha Nac.</th>
                <th>Profesión</th>
                <th>Experiencia</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($personajes as $i => $p): ?>
            <tr>
                <td><img src="imagenes/<?= $p['foto'] ?>" width="60"></td>
                <td><?= $p['nombre'] ?></td>
                <td><?= $p['apellido'] ?></td>
                <td><?= $p['fecha_nacimiento'] ?></td>
                <td><?= $p['profesion'] ?></td>
                <td><?= $p['experiencia'] ?></td>
                <td>
                    <a href="editar.php?id=<?= $i ?>" class="btn btn-sm btn-outline-primary">Editar</a>
                    <a href="eliminar.php?tipo=personaje&id=<?= $i ?>" class="btn btn-sm btn-outline-danger">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <h2 class="mt-5">💼 Profesiones Registradas</h2>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Salario ($USD)</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($profesiones as $i => $p): ?>
            <tr>
                <td><?= $p['nombre'] ?></td>
                <td><?= $p['categoria'] ?></td>
                <td>$<?= number_format($p['salario'], 2) ?></td>
                <td>
                    <a href="editar_profesion.php?id=<?= $i ?>" class="btn btn-sm btn-outline-primary">Editar</a>
                    <a href="eliminar.php?tipo=profesion&id=<?= $i ?>" class="btn btn-sm btn-outline-danger">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
