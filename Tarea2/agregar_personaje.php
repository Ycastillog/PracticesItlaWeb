<?php
include 'libreria/plantilla.php';
include 'libreria/objetos.php';

encabezado('Agregar Nuevo Personaje');

$personajes = cargar_datos('datos/personajes.json');

$mensaje = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigo = uniqid();
    $nombre = trim($_POST['nombre'] ?? '');
    $obra_codigo = trim($_POST['obra_codigo'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');
    $foto_url = '';

    // Manejar subida de imagen
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $archivo_tmp = $_FILES['foto']['tmp_name'];
        $nombre_archivo = basename($_FILES['foto']['name']);
        $ext = strtolower(pathinfo($nombre_archivo, PATHINFO_EXTENSION));
        $ext_permitidas = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($ext, $ext_permitidas)) {
            // Crear carpeta uploads si no existe
            if (!is_dir('uploads')) {
                mkdir('uploads', 0755, true);
            }

            // Nombre único para evitar sobreescritura
            $nuevo_nombre = 'uploads/' . uniqid() . '.' . $ext;
            if (move_uploaded_file($archivo_tmp, $nuevo_nombre)) {
                $foto_url = $nuevo_nombre;
            } else {
                $mensaje = 'Error al subir la imagen.';
            }
        } else {
            $mensaje = 'Tipo de archivo no permitido. Solo jpg, jpeg, png, gif.';
        }
    }

    if ($nombre && $obra_codigo) {
        $personajes[] = [
            'codigo' => $codigo,
            'nombre' => $nombre,
            'obra_codigo' => $obra_codigo,
            'descripcion' => $descripcion,
            'foto_url' => $foto_url
        ];
        guardar_datos('datos/personajes.json', $personajes);
        $mensaje = "Personaje agregado correctamente.";
    } else {
        if (!$mensaje) {
            $mensaje = "Debe completar los campos obligatorios.";
        }
    }
}

$obras = cargar_datos('datos/obras.json');
?>

<h2>Agregar Nuevo Personaje</h2>

<?php if ($mensaje): ?>
    <div class="alert alert-info"><?= htmlspecialchars($mensaje) ?></div>
<?php endif; ?>

<form method="post" action="agregar_personaje.php" enctype="multipart/form-data" class="mb-4">
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre del Personaje *</label>
        <input type="text" id="nombre" name="nombre" class="form-control" required />
    </div>

    <div class="mb-3">
        <label for="obra_codigo" class="form-label">Obra a la que pertenece *</label>
        <select id="obra_codigo" name="obra_codigo" class="form-select" required>
            <option value="">Seleccione una obra</option>
            <?php foreach ($obras as $obra): ?>
                <option value="<?= htmlspecialchars($obra['codigo']) ?>">
                    <?= htmlspecialchars($obra['nombre']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción</label>
        <textarea id="descripcion" name="descripcion" class="form-control"></textarea>
    </div>

    <div class="mb-3">
        <label for="foto" class="form-label">Foto del Personaje (jpg, png, gif)</label>
        <input type="file" id="foto" name="foto" class="form-control" accept=".jpg,.jpeg,.png,.gif" />
    </div>

    <button type="submit" class="btn btn-primary">Agregar Personaje</button>
</form>

<?php pie(); ?>

