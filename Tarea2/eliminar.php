<?php
include 'libreria/objetos.php';

$codigo = $_GET['codigo'] ?? '';
$archivo = 'datos/obras.json';
$obras = cargar_datos($archivo);

// Filtrar todas menos la que tiene ese código
$nueva_lista = array_filter($obras, fn($obra) => $obra['codigo'] !== $codigo);

// Guardar nuevamente
guardar_datos($archivo, array_values($nueva_lista));

// Redirigir
header("Location: ver_obra.php");
exit;
