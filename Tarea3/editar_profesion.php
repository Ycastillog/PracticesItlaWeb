<?php
include 'funciones.php';

$profesiones = leerJSON('datos/profesiones.json');
$id = $_GET['id'];
$profesion = $profesiones[$id];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $profesion['nombre'] = $_POST['nombre'];
    $profesion['categoria'] = $_POST['categoria'];
    $profesion['salario'] = floatval($_POST['salario']);

    $profesiones[$id] = $profesion;
    guardarJSON('datos/profesiones.json',
