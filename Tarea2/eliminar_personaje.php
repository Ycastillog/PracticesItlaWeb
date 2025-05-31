<?php
include 'libreria/plantilla.php';
include 'libreria/objetos.php';

$cedula = $_GET['cedula'] ?? '';
$personajes = cargar_datos('datos/personajes.json');

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

unset($personajes[$index]);
$personajes = array_values($personajes);
guardar_datos('datos/personajes.json', $personajes);

header('Location: detalle.php?codigo=' . urlencode($_GET['codigo_obra'] ?? ''));
exit;
?>
