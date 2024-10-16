<?php
// Definir un arreglo con temperaturas
$temperaturas = array(
    78, 60, 62, 68, 71, 68, 73, 85, 66, 64, 
    76, 63, 75, 76, 73, 68, 62, 73, 72, 65, 
    74, 62, 62, 65, 64, 68, 73, 75, 79, 73
);

// Calcular la temperatura promedio
$promedio = array_sum($temperaturas) / count($temperaturas);
echo "La temperatura promedio es: " . number_format($promedio, 1) . "\n";

// Eliminar duplicados y ordenar las temperaturas
$temperaturas_unicas = array_unique($temperaturas);
sort($temperaturas_unicas);

// Obtener las 5 temperaturas más bajas
$mas_bajas = array_slice($temperaturas_unicas, 0, 5);
echo "Lista de las 5 temperaturas más bajas (sin duplicados):\n";
echo implode("\n", $mas_bajas) . "\n";

// Obtener las 5 temperaturas más altas
$mas_altas = array_slice($temperaturas_unicas, -5);
echo "Lista de las 5 temperaturas más altas (sin duplicados):\n";
echo implode("\n", $mas_altas) . "\n";
?>
