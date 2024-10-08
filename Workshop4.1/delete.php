<?php
include('functions.php'); 


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Verificar si la función deleteUser está definida
    if (function_exists('deleteUser')) { // Verifica si la función existe
        if (deleteUser($id)) {
            // Redirigir a la lista de usuarios si la eliminación fue exitosa
            header('Location: users.php');
            exit();
        } else {
          
            echo "Error al eliminar el usuario.";
        }
    } else {
        echo "La función deleteUser no está definida.";
    }
} else {
    echo "ID no proporcionado.";
}

