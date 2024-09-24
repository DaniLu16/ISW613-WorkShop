<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $nombre = $conexion->real_escape_string($_POST['nombre']);
    $apellido = $conexion->real_escape_string($_POST['apellido']);
    $telefono = $conexion->real_escape_string($_POST['telefono']);
    $correo = $conexion->real_escape_string($_POST['correo']);

    // Consulta SQL para insertar los datos en la tabla
    $sql = "INSERT INTO usuarios (nombre, apellido, telefono, correo) 
            VALUES ('$nombre', '$apellido', '$telefono', '$correo')";

    // Ejecutar la consulta y verificar si fue exitosa
    if ($conexion->query($sql) === TRUE) {
        echo "Datos guardados exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
}

// Cerrar conexión
$conexion->close();
?>