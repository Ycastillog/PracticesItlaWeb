<?php
// eliminar_obra.php
$archivo = 'datos/obras.json';

if (isset($_GET['id'])) {
    $codigo = $_GET['id'];

    if (file_exists($archivo)) {
        $obras = json_decode(file_get_contents($archivo), true);
        
        // Buscar y eliminar por código
        foreach ($obras as $i => $obra) {
            if ($obra['codigo'] === $codigo) {
                unset($obras[$i]);
                $obras = array_values($obras); // Reindexar
                file_put_contents($archivo, json_encode($obras, JSON_PRETTY_PRINT));
                break;
            }
        }
    }
}

header("Location: ver_obra.php");
exit;

