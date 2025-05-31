<?php
include 'libreria/plantilla.php';
include 'libreria/objetos.php';

encabezado('Personajes Registrados');

$personajes = cargar_datos('datos/personajes.json');
$obras = cargar_datos('datos/obras.json');

$mapa_obras = [];
foreach ($obras as $obra) {
    $mapa_obras[$obra['codigo']] = $obra['nombre'];
}
?>

<h2>Personajes Registrados</h2>

<?php if (empty($personajes)): ?>
    <p>No hay personajes registrados.</p>
<?php else: ?>
    <div class="list-group">
        <?php foreach ($personajes as $personaje): ?>
            <div class="list-group-item d-flex gap-3 align-items-center">
                <?php if (!empty($personaje['foto_url']) && file_exists($personaje['foto_url'])): ?>
                    <img src="<?= htmlspecialchars($personaje['foto_url']) ?>" alt="<?= htmlspecialchars($personaje['nombre']) ?>" width="100" height="100" style="object-fit: cover; border-radius: 8px;" />
                <?php else: ?>
                    <div style="width:100px; height:100px; background:#ccc; display:flex; align-items:center; justify-content:center; border-radius: 8px;">
                        Sin Imagen
                    </div>
                <?php endif; ?>
                <div>
                    <h5><?= htmlspecialchars($personaje['nombre']) ?></h5>
                    <p><strong>Obra:</strong> <?= htmlspecialchars($mapa_obras[$personaje['obra_codigo']] ?? 'Desconocida') ?></p>
                    <p><?= nl2br(htmlspecialchars($personaje['descripcion'])) ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php pie(); ?>

