<?php
include('functions.php'); // Asegúrate de tener funciones de conexión a la base de datos

// Verificar que se ha pasado un argumento
if ($argc != 2) {
    echo "Uso: php validateActiveSessions.php <horas>\n";
    exit(1);
}

$horas = (int)$argv[1]; // Convertir el argumento a entero

if ($horas <= 0) {
    echo "Por favor, ingresa un valor de horas mayor a cero.\n";
    exit(1);
}

// Calcular el tiempo límite
$limiteTiempo = date('Y-m-d H:i:s', strtotime("-$horas hours"));

// Consultar todos los usuarios activos
$sql = "SELECT ID FROM usuario WHERE Estado = 'active' AND Ultimo_Inicio_Sesion < ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $limiteTiempo);
$stmt->execute();
$result = $stmt->get_result();

// Marcar como inactivos a los usuarios que superen el tiempo límite
while ($usuario = $result->fetch_assoc()) {
    $idUsuario = $usuario['ID'];
    
    // Actualizar el estado del usuario a 'inactive'
    $updateSql = "UPDATE usuario SET Estado = 'inactive' WHERE ID = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("i", $idUsuario);
    
    if ($updateStmt->execute()) {
        echo "Usuario con ID $idUsuario ha sido marcado como 'inactive'.\n";
    } else {
        echo "Error al actualizar el usuario con ID $idUsuario: " . $updateStmt->error . "\n";
    }
}

$stmt->close();
$conn->close();
?>
