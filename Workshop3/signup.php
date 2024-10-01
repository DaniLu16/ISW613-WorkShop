<?php 
require('functions.php');

if ($_POST && isset($_POST['Nombre'])) {  // Cambiar $_REQUEST a $_POST
    // Obtener cada campo e insertar en la base de datos
    $usuario['ID'] = null; // Suponiendo que la ID se autoincrementa
    $usuario['Nombre'] = $_POST['Nombre']; // Campo Nombre
    $usuario['Apellido'] = $_POST['Apellido']; // Campo Apellido
    $usuario['Email'] = $_POST['Email']; // Campo Email
    $usuario['Contraseña'] = $_POST['Contraseña']; // Campo Contraseña
    $usuario['ID_provincia'] = $_POST['ID_provincia']; // Campo ID_provincia

    // Guardar el usuario
    if (saveUser($usuario)) {
        header("Location: users.php"); // Cambiado a 'Location: users.php'
        exit; // Asegúrate de llamar a exit() después de header
    }
   
}
?>
