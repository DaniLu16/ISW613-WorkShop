
<?php
session_start(); // Iniciar la sesión

// Verificar si hay una sesión activa
if (isset($_SESSION['user_id'])) {
    // Destruir la sesión
    session_unset(); // Limpiar las variables de sesión
    session_destroy(); // Destruir la sesión
}

// Redirigir al usuario a signup.php
header("Location: signup.php");
exit(); // Asegurarse de que no se ejecute más código
?>
