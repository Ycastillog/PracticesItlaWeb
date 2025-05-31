<?php
include 'libreria/plantilla.php';
include 'libreria/objetos.php';

$codigo = $_GET['codigo'] ?? '';
$obras = cargar_datos('datos/obras.json');
$personajes = cargar_datos('datos/personajes.json');

$obra = null;
foreach ($obras as $o) {
    if ($o['codigo'] === $codigo) {
        $obra = $o;
        break;
    }
}

if (!$obra) {
    encabezado('Obra no encontrada');
    echo "<div class='alert alert-danger'>Obra no encontrada.</div>";
    pie();
    exit;
}

encabezado("Detalles de " . $obra['nombre']);
?>

<div class="row">
    <div class="col-md-4">
        <?php if (!empty($obra['foto_url'])): ?>
            <img src="<?= htmlspecialchars($obra['foto_url']) ?>" alt="<?= htmlspecialchars($obra['nombre']) ?>" class="img-fluid rounded">
        <?php else: ?>
            <div class="border bg-secondary text-white text-center p-5">Sin imagen</div>
        <?php endif; ?>
    </div>
    <div class="col-md-8">
        <h2><?= htmlspecialchars($obra['nombre']) ?></h2>
        <p><strong>Tipo:</strong> <?= htmlspecialchars($obra['tipo'] ?? 'Desconocido') ?></p>
        <p><strong>País:</strong> <?= htmlspecialchars($obra['pais'] ?? 'Desconocido') ?></p>
        <p><strong>Autor:</strong> <?= htmlspecialchars($obra['autor'] ?? 'Desconocido') ?></p>
        <p><strong>Descripción:</strong><br><?= nl2br(htmlspecialchars($obra['descripcion'] ?? 'Sin descripción')) ?></p>
    </div>
</div>

<hr>

<h3>Personajes de esta obra</h3>

<?php
$lista_personajes = array_filter($personajes, fn($p) => isset($p['obra_codigo']) && $p['obra_codigo'] === $codigo);

if (empty($lista_personajes)) {
    echo "<p>No hay personajes asociados a esta obra.</p>";
} else {
    echo "<table class='table table-striped'>";
    echo "<thead><tr><th>Foto</th><th>Nombre Completo</th><th>Edad</th><th>Sexo</th><th>Habilidad</th><th>Signo Zodiacal</th><th>Acciones</th></tr></thead><tbody>";
    foreach ($lista_personajes as $p) {
        $fecha_nac = $p['fecha_nacimiento'] ?? null;
        $nombre = $p['nombre'] ?? 'Desconocido';
        $apellido = $p['apellido'] ?? '';
        $sexo = $p['sexo'] ?? 'No especificado';
        $habilidad = $p['habilidad'] ?? 'N/A';
        $cedula = $p['cedula'] ?? '';

        // Funciones defensivas para edad y signo
        $edad = $fecha_nac ? calcular_edad($fecha_nac) : 'Desconocida';
        $signo = $fecha_nac ? signo_zodiacal($fecha_nac) : 'Desconocido';

        echo "<tr>";
        echo "<td>";
        if (!empty($p['foto_url'])) {
            echo "<img src='" . htmlspecialchars($p['foto_url']) . "' alt='Foto' width='50'>";
        } else {
            echo "Sin foto";
        }
        echo "</td>";
        echo "<td>" . htmlspecialchars($nombre . ' ' . $apellido) . "</td>";
        echo "<td>" . htmlspecialchars($edad) . "</td>";
        echo "<td>" . htmlspecialchars($sexo) . "</td>";
        echo "<td>" . htmlspecialchars($habilidad) . "</td>";
        echo "<td>" . htmlspecialchars($signo) . "</td>";
        echo "<td>";
        if ($cedula !== '') {
            echo "<a href='editar_personaje.php?cedula=" . urlencode($cedula) . "' class='btn btn-sm btn-warning'>Editar</a> ";
            echo "<a href='eliminar_personaje.php?cedula=" . urlencode($cedula) . "' class='btn btn-sm btn-danger' onclick='return confirm(\"¿Está seguro?\")'>Eliminar</a>";
        } else {
            echo "Sin acciones";
        }
        echo "</td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
}

pie();
?>



