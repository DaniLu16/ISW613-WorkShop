<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = [
        'ID' => $_POST['ID'],
        'Nombre' => $_POST['Nombre'],
        'Apellido' => $_POST['Apellido'],
        'Email' => $_POST['Email'],
        'ID_provincia' => $_POST['ID_provincia'],
    ];
    updateUser($usuario);
    
}


?>