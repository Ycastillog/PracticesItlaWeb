v<?php
include 'funciones.php';

$personajes = leerJSON('datos/personajes.json');
$profesiones = leerJSON('datos/profesiones.json');

$totalPersonajes = count($personajes);
$totalProfesiones = count($profesiones);

$edades = [];
$categorias = [];
$experiencias = [];
$salarios = [];
$personajeSalarioAlto = null;
$mayorSalario = 0;

foreach ($personajes as $p) {
    $edad = date_diff(date_create($p['fecha_nacimiento']), date_create('today'))->y;
    $edades[] = $edad;

    $experiencias[] = $p['experiencia'];

    foreach ($profesiones as $prof) {
        if ($prof['nombre'] == $p['profesion']) {
            $cat = $prof['categoria'];
            $salario = $prof['salario'];
            $categorias[$cat] = ($categorias[$cat] ?? 0) + 1;
            $salarios[] = $salario;

            if ($salario > $mayorSalario) {
                $mayorSalario = $salario;
                $personajeSalarioAlto = $p['nombre'] . ' ' . $p['apellido'];
            }
        }
    }
}

$edadPromedio = $edades ? array_sum($edades) / count($edades) : 0;
$experienciaMasComun = array_count_values($experiencias);
arsort($experienciaMasComun);
$experienciaMasComun = key($experienciaMasComun);

$salarioPromedio = $salarios ? array_sum($salarios) / count($salarios) : 0;

$salarioMinimo = min($salarios);
$salarioMaximo = max($salarios);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Mundo Barbie</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container py-5">
    <h1 class="mb-4 text-center text-danger">📊 Dashboard del Mundo Barbie</h1>

    <div class="row">
        <div class="col-md-6">
            <ul class="list-group">
                <li class="list-group-item">Total de personajes: <strong><?= $totalPersonajes ?></strong></li>
                <li class="list-group-item">Total de profesiones: <strong><?= $totalProfesiones ?></strong></li>
                <li class="list-group-item">Edad promedio: <strong><?= round($edadPromedio, 1) ?> años</strong></li>
                <li class="list-group-item">Nivel de experiencia más común: <strong><?= $experienciaMasComun ?></strong></li>
                <li class="list-group-item">Profesión con mayor salario: <strong>$<?= number_format($salarioMaximo, 2) ?></strong></li>
                <li class="list-group-item">Profesión con menor salario: <strong>$<?= number_format($salarioMinimo, 2) ?></strong></li>
                <li class="list-group-item">Salario promedio: <strong>$<?= number_format($salarioPromedio, 2) ?></strong></li>
                <li class="list-group-item">Personaje con el salario más alto: <strong><?= $personajeSalarioAlto ?></strong></li>
            </ul>
        </div>
        <div class="col-md-6">
            <canvas id="graficoCategorias"></canvas>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('graficoCategorias').getContext('2d');
        const grafico = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode(array_keys($categorias)) ?>,
                datasets: [{
                    label: 'Distribución por categoría',
                    data: <?= json_encode(array_values($categorias)) ?>,
                    backgroundColor: '#f06292'
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>
</body>
</html>
