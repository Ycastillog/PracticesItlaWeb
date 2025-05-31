<?php
include 'libreria/plantilla.php';
include 'libreria/objetos.php';

$cedula = $_GET['cedula'] ?? '';
$personajes = cargar_datos('datos/personajes.json');
$obras = cargar_datos('datos/obras.json');

$index = null;
foreach ($personajes as $i => $p) {
    if ($p['cedula'] === $cedula) {
        $index = $i;
        break;
    }
}

if ($index === null) {
    encabezado('Personaje no encontrado');
    echo "<div class='alert alert-danger'>Personaje no encontrado.</div>";
    pie();
    exit;
}

$datos = $personajes[$index];
$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = [
        'cedula' => $cedula,
        'foto_url' => trim($_POST['foto_url'] ?? ''),
        'nombre' => trim($_POST['nombre'] ?? ''),
        'apellido' => trim($_POST['apellido'] ?? ''),
        'fecha_nacimiento' => $_POST['fecha_nacimiento'] ?? '',
        'sexo' => $_POST['sexo'] ?? '',
        'habilidad' => trim($_POST['habilidad'] ?? ''),
        'codigo_obra' => $_POST['codigo_obra'] ?? ''
    ];

    // Validar
    if ($datos['nombre'] === '') $errores[] = "El nombre es obligatorio.";
    if ($datos['apellido'] === '') $errores[] = "El apellido es obligatorio.";
    if ($datos['fecha_nacimiento'] === '') $errores[] = "La fecha de nacimiento es obligatoria.";
    if ($datos['sexo'] === '') $errores[] = "El sexo es obligatorio.";
    if ($datos['codigo_obra'] === '') $errores[] = "Debe seleccionar una obra.";

    if (empty($errores)) {
        $personajes[$index] = $datos;
        guardar_datos('datos/personajes.json', $personajes);
        echo "<div class='alert alert-success'>Personaje actualizado con éxito.</div>";
    }
}

encabezado('Editar Personaje');
?>

<h2>Editar Personaje</h2>

<?php if (!empty($errores)): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($errores as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="editar_personaje.php?cedula=<?= urlencode($cedula) ?>" method="post">
    <div class="mb-3">
        <label for="cedula" class="form-label">Cédula</label>
        <input type="text" name="cedula" id="cedula" class="form-control" value="<?= htmlspecialchars($datos['cedula']) ?>" readonly>
    </div>

    <div class="mb-3">
        <label for="foto_url" class="form-label">URL o ruta de imagen</label>
        <input type="text" name="foto_url" id="foto_url" class="form-control" value="<?= htmlspecialchars($datos['foto_url']) ?>">
    </div>

    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" name="nombre" id="nombre" class="form-control" value="<?= htmlspecialchars($datos['nombre']) ?>" required>
    </div>

    <div class="mb-3">
        <label for="apellido" class="form-label">Apellido</label>
        <input type="text" name="apellido" id="apellido" class="form-control" value="<?= htmlspecialchars($datos['apellido']) ?>" required>
    </div>

    <div class="mb-3">
        <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" value="<?= htmlspecialchars($datos['fecha_nacimiento']) ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Sexo</label><br>
        <div class="form-check form-check-inline">
            <input type="radio" id="sexo_m" name="sexo" value="M" class="form-check-input" <?= $datos['sexo']=='M'?'checked':'' ?> required>
            <label for="sexo_m" class="form-check-label">Masculino</label>
        </div>
        <div class="form-check form-check-inline">
            <input type="radio" id="sexo_f" name="sexo" value="F" class="form-check-input" <?= $datos['sexo']=='F'?'checked':'' ?>>
            <label for="sexo_f" class="form-check-label">Femenino</label>
        </div>
    </div>

    <div class="mb-3">
        <label for="habilidad" class="form-label">Habilidad</label>
        <input type="text" name="habilidad" id="habilidad" class="form-control" value="<?= htmlspecialchars($datos['habilidad']) ?>">
    </div>

    <div class="mb-3">
        <label for="codigo_obra" class="form-label">Obra</label>
        <select name="codigo_obra" id="codigo_obra" class="form-select" required>
            <option value="">Seleccione</option>
            <?php foreach ($obras as $obra): ?>
                <option value="<?= htmlspecialchars($obra['codigo']) ?>" <?= $datos['codigo_obra']==$obra['codigo']?'selected':'' ?>>
                    <?= htmlspecialchars($obra['nombre']) ?> (<?= htmlspecialchars($obra['tipo']) ?>)
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Guardar cambios</button>
</form>

<?php pie(); ?>

