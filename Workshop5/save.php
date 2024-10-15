<?php 
 include('functions.php');

if ($_POST && isset($_POST['Nombre'])) {  
    // Obtener cada campo e insertar en la base de datos
    $usuario['ID'] = null; //  ID se autoincrementa
    $usuario['Nombre'] = $_POST['Nombre']; 
    $usuario['Apellido'] = $_POST['Apellido']; 
    $usuario['Email'] = $_POST['Email']; 
    $usuario['Contraseña'] = $_POST['Contraseña']; 
    $usuario['ID_provincia'] = $_POST['ID_provincia']; 

    // Guardar el usuario
    if (saveUser($usuario)) { 
        header("Location: users.php"); 
        exit; 
    }
   
}
?>
