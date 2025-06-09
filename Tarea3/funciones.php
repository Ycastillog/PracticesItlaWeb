<?php

function leerJSON($archivo) {
    if (!file_exists($archivo)) {
        file_put_contents($archivo, '[]');
    }
    $contenido = file_get_contents($archivo);
    $data = json_decode($contenido, true);
    return is_array($data) ? $data : [];
}

function guardarJSON($archivo, $datos) {
    $json = json_encode($datos, JSON_PRETTY_PRINT);
    file_put_contents($archivo, $json);
}

function generarID($datos) {
    return count($datos) > 0 ? max(array_column($datos, 'id')) + 1 : 1;
}

