<?php
// editar.php
include 'libreria/plantilla.php';
include 'libreria/objetos.php';

$archivo = 'datos/obras.json';
$codigo = $_GET['codigo'] ?? '';
$obras = cargar_datos($archivo);
$obra = null;

// Buscar la obra por código
foreach ($obras as $o) {
    if ($o['codigo'] === $codigo) {
        $obra = $o;
        break;
    }
}

// Si no se encuentra la obra
if (!$obra) {
    encabezado("Obra no encontrada");
    echo "<div class='container mt-5'><div class='alert alert-danger'>Obra no encontrada.</div></div>";
    pie();
    exit;
}

// Si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($obras as &$o) {
        if ($o['codigo'] === $codigo) {
            $o['nombre'] = $_POST['nombre'];
            $o['descripcion'] = $_POST['descripcion'];
            $o['tipo'] = $_POST['tipo'];
            $o['pais'] = $_POST['pais'];
            $o['autor'] = $_POST['autor'];
            $o['foto_url'] = $_POST['foto_url'];
            break;
        }
    }
    guardar_datos($archivo, $obras);
    header("Location: ver_obra.php");
    exit;
}

encabezado("Editar Obra");
?>

<div class="container mt-5">
    <h2 class="mb-4">Editar Obra</h2>
    <form method="post" class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($obra['nombre']) ?>" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Autor</label>
            <input type="text" name="autor" class="form-control" value="<?= htmlspecialchars($obra['autor']) ?>" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Tipo</label>
            <input type="text" name="tipo" class="form-control" value="<?= htmlspecialchars($obra['tipo']) ?>" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">País</label>
            <input type="text" name="pais" class="form-control" value="<?= htmlspecialchars($obra['pais']) ?>" required>
        </div>
        <div class="col-12">
            <label class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control" rows="3" required><?= htmlspecialchars($obra['descripcion']) ?></textarea>
        </div>
        <div class="col-12">
            <label class="form-label">URL de la Imagen</label>
            <input type="text" name="foto_url" class="form-control" value="<?= htmlspecialchars($obra['foto_url']) ?>">
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-success">💾 Guardar Cambios</button>
            <a href="ver_obra.php" class="btn btn-secondary">↩️ Cancelar</a>
        </div>
    </form>
</div>

<?php pie(); ?>
