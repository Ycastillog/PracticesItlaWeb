<?php
function cargar_datos($archivo) {
    if (!file_exists($archivo)) {
        file_put_contents($archivo, json_encode([]));
    }
    $json = file_get_contents($archivo);
    return json_decode($json, true) ?: [];
}

function guardar_datos($archivo, $datos) {
    file_put_contents($archivo, json_encode($datos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

function calcular_edad($fecha_nacimiento) {
    $nacimiento = new DateTime($fecha_nacimiento);
    $hoy = new DateTime();
    $edad = $hoy->diff($nacimiento)->y;
    return $edad;
}

function signo_zodiacal($fecha_nacimiento) {
    $fecha = strtotime($fecha_nacimiento);
    $dia = (int)date('d', $fecha);
    $mes = (int)date('m', $fecha);

    $signos = [
        ['nombre'=>'Capricornio','desde'=>[12,22],'hasta'=>[1,20]],
        ['nombre'=>'Acuario','desde'=>[1,21],'hasta'=>[2,19]],
        ['nombre'=>'Piscis','desde'=>[2,20],'hasta'=>[3,20]],
        ['nombre'=>'Aries','desde'=>[3,21],'hasta'=>[4,20]],
        ['nombre'=>'Tauro','desde'=>[4,21],'hasta'=>[5,21]],
        ['nombre'=>'Géminis','desde'=>[5,22],'hasta'=>[6,21]],
        ['nombre'=>'Cáncer','desde'=>[6,22],'hasta'=>[7,22]],
        ['nombre'=>'Leo','desde'=>[7,23],'hasta'=>[8,23]],
        ['nombre'=>'Virgo','desde'=>[8,24],'hasta'=>[9,23]],
        ['nombre'=>'Libra','desde'=>[9,24],'hasta'=>[10,23]],
        ['nombre'=>'Escorpio','desde'=>[10,24],'hasta'=>[11,22]],
        ['nombre'=>'Sagitario','desde'=>[11,23],'hasta'=>[12,21]],
    ];

    foreach ($signos as $signo) {
        list($dMes, $dDia) = $signo['desde'];
        list($hMes, $hDia) = $signo['hasta'];
        if (($mes == $dMes && $dia >= $dDia) || ($mes == $hMes && $dia <= $hDia)) {
            return $signo['nombre'];
        }
    }
    return "Desconocido";
}

