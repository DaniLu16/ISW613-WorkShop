<?php
include('functions.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Verificar que la solicitud es POST
    // Desinfectar entradas
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password']; // Considera aplicar hashing a la contraseña también

    // Verifica las credenciales del usuario
    $usuario = verifyUser($email, $password); // Asegúrate de tener esta función definida

    if ($usuario && $usuario['Estado'] === 'active') {
        // Actualizar last_login_datetime
        $connection = getConnection();
        $sql = "UPDATE usuario SET Ultimo_Inicio_Sesion = NOW() WHERE ID = ?";
        $stmt = $connection->prepare($sql);
        
        if (!$stmt) {
            echo "Error en la preparación de la consulta: " . $connection->error;
            exit;
        }

        $stmt->bind_param("i", $usuario['ID']);
        
        if (!$stmt->execute()) {
            echo "Error al ejecutar la consulta: " . $stmt->error;
            exit;
        }

        // Iniciar sesión y guardar información del usuario
        session_start();
        $_SESSION['user'] = $usuario;
        header("Location: ../users.php"); // Cambia a la ruta que necesites
        exit;
    } else {
        // Redirigir a la página de inicio con un mensaje de error
        header("Location: ../index.php?error=Credenciales incorrectas o cuenta inactiva.");
        exit;
    }
}
?>
