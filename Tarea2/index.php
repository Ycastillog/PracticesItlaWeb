<?php
// index.php

include 'libreria/plantilla.php'; // si usas plantilla para encabezado y pie
include 'libreria/objetos.php';   // si usas funciones auxiliares

$obras = [];
if (file_exists('datos/obras.json')) {
    $json = file_get_contents('datos/obras.json');
    $obras = json_decode($json, true) ?? [];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Lo que he visto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container mt-5">

        <!-- Título principal -->
        <h1 class="mb-4 text-center">Lo que he visto</h1>
        <p class="text-center fst-italic mb-5">Listado de películas y series en la que he invertido mi tiempo</p>

        <!-- Listado de obras -->
        <?php if (!empty($obras)): ?>
            <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
                <?php foreach ($obras as $obra): ?>
                    <div class="col">
                        <div class="card h-100">
                            <?php if (!empty($obra['foto_url'])): ?>
                                <img src="<?= htmlspecialchars($obra['foto_url']) ?>" class="card-img-top" alt="<?= htmlspecialchars($obra['nombre']) ?>">
                            <?php else: ?>
                                <div class="bg-secondary text-white text-center p-5">Sin imagen</div>
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($obra['nombre']) ?></h5>
                                <p class="card-text"><?= nl2br(htmlspecialchars(substr($obra['descripcion'] ?? '', 0, 100))) ?>...</p>
                                <a href="detalle.php?codigo=<?= urlencode($obra['codigo']) ?>" class="btn btn-primary">Ver detalles</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No hay obras registradas.</p>
        <?php endif; ?>

        <!-- Botones de navegación -->
        <div class="row g-3 mb-5">
            <div class="col-md-6">
                <a href="registrar_obra.php" class="btn btn-primary w-100">
                    📚 Registrar Nueva Obra
                </a>
            </div>
            <div class="col-md-6">
                <a href="agregar_personaje.php" class="btn btn-secondary w-100">
                    👤 Agregar Nuevo Personaje
                </a>
            </div>
            <div class="col-md-6">
                <a href="ver_obra.php" class="btn btn-success w-100">
                    📋 Ver Listado de Obras
                </a>
            </div>
            <div class="col-md-6">
                <a href="personajes.php" class="btn btn-dark w-100">
                    🧑‍🎤 Ver Personajes Registrados
                </a>
            </div>
        </div>

    </div>

    <!-- Footer -->
    <footer class="text-center py-4 bg-light mt-auto">
        <div class="container">
            <small>Derechos reservados © 2025 - Lo que he visto</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
