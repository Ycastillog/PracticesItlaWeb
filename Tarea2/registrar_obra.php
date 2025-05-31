<?php
include 'libreria/plantilla.php';
include 'libreria/objetos.php';

encabezado('Registrar Nueva Obra');

// Procesar formulario cuando se envía
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $obras = cargar_datos('datos/obras.json');

    // Crear nuevo arreglo obra
    $nueva_obra = [
        'codigo' => uniqid(), // código único automático
        'nombre' => $_POST['nombre'] ?? '',
        'descripcion' => $_POST['descripcion'] ?? '',
        'tipo' => $_POST['tipo'] ?? '',
        'pais' => $_POST['pais'] ?? '',
        'autor' => $_POST['autor'] ?? '',
        'foto_url' => $_POST['foto_url'] ?? '',
    ];

    // Validar campos mínimos (por ejemplo nombre)
    if (empty($nueva_obra['nombre'])) {
        echo '<div class="alert alert-danger">El nombre es obligatorio.</div>';
    } else {
        // Agregar la nueva obra al array
        $obras[] = $nueva_obra;

        // Guardar en el JSON
        guardar_datos('datos/obras.json', $obras);

        // Redireccionar a listado o mostrar mensaje
        header('Location: ver_obra.php');
        exit;
    }
}
?>

<h2>Registrar Nueva Obra</h2>

<form method="POST" action="registrar_obra.php">
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" required>
    </div>

    <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción</label>
        <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
    </div>

    <div class="mb-3">
        <label for="tipo" class="form-label">Tipo</label>
        <input type="text" class="form-control" id="tipo" name="tipo">
    </div>

    <div class="mb-3">
        <label for="pais" class="form-label">País</label>
        <input type="text" class="form-control" id="pais" name="pais">
    </div>

    <div class="mb-3">
        <label for="autor" class="form-label">Autor</label>
        <input type="text" class="form-control" id="autor" name="autor">
    </div>

    <div class="mb-3">
        <label for="foto_url" class="form-label">URL de la Foto</label>
        <input type="url" class="form-control" id="foto_url" name="foto_url" placeholder="https://ejemplo.com/imagen.jpg">
    </div>

    <button type="submit" class="btn btn-primary">Guardar Obra</button>
</form>

<?php pie(); ?>




