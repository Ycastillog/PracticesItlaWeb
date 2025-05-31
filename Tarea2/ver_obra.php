<?php
include 'libreria/plantilla.php';
include 'libreria/objetos.php';

encabezado('Listado de Obras');

$obras = cargar_datos('datos/obras.json');
?>

<h2>Listado de Obras</h2>

<?php if (empty($obras)): ?>
    <p>No hay obras registradas.</p>
<?php else: ?>
    <div class="row row-cols-1 row-cols-md-3 g-4">
    <?php foreach ($obras as $obra): ?>
        <div class="col">
            <div class="card h-100">
                <?php if ($obra['foto_url']): ?>
                    <img src="<?= htmlspecialchars($obra['foto_url']) ?>" class="card-img-top" alt="<?= htmlspecialchars($obra['nombre']) ?>">
                <?php else: ?>
                    <svg class="bd-placeholder-img card-img-top" width="100%" height="180" xmlns="http://www.w3.org/2000/svg" 
                        role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false">
                        <title>No Image</title>
                        <rect width="100%" height="100%" fill="#868e96"></rect>
                        <text x="50%" y="50%" fill="#dee2e6" dy=".3em" text-anchor="middle">No Image</text>
                    </svg>
                <?php endif; ?>
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($obra['nombre']) ?></h5>
                    <p class="card-text"><?= htmlspecialchars($obra['descripcion']) ?></p>
                    <p><strong>Tipo:</strong> <?= htmlspecialchars($obra['tipo']) ?></p>
                    <p><strong>País:</strong> <?= htmlspecialchars($obra['pais']) ?></p>
                    <p><strong>Autor:</strong> <?= htmlspecialchars($obra['autor']) ?></p>
                    <a href="detalle.php?codigo=<?= urlencode($obra['codigo']) ?>" class="btn btn-primary mb-1">📄 Ver detalles</a>
                    <a href="editar.php?codigo=<?= urlencode($obra['codigo']) ?>" class="btn btn-warning mb-1">✏️ Editar</a>
                    <a href="eliminar.php?codigo=<?= urlencode($obra['codigo']) ?>" class="btn btn-danger mb-1" onclick="return confirm('¿Estás seguro de eliminar esta obra?')">🗑️ Eliminar</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php pie(); ?>


