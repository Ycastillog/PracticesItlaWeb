<?php
include 'funciones.php';

$tipo = $_GET['tipo']; // 'personaje' o 'profesion'
$id = $_GET['id'];

if ($tipo == 'personaje') {
    $personajes = leerJSON('datos/personajes.json');
    unset($personajes[$id]);
    $personajes = array_values($personajes);
    guardarJSON('datos/personajes.json', $personajes);
    header('Location: index.php');
    exit;
}

if ($tipo == 'profesion') {
    $profesiones = leerJSON('datos/profesiones.json');
    unset($profesiones[$id]);
    $profesiones = array_values($profesiones);
    guardarJSON('datos/profesiones.json', $profesiones);
    header('Location: profesiones.php');
    exit;
}
?>
