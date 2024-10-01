<?php 
require('functions.php');

// Obtener la conexión a la base de datos
$conn = getConnection();

// Consulta SQL para obtener todos los usuarios
$sql = "SELECT * FROM usuario";
$result = mysqli_query($conn, $sql);

// Verificar si se obtuvieron resultados
if (!$result) {
    die("Error en la consulta: " . mysqli_error($conn));
}
?>
<?php 
require('functions.php');

// Obtener la conexión a la base de datos
$conn = getConnection();

// Consulta SQL para obtener todos los usuarios
$sql = "SELECT * FROM usuario";
$result = mysqli_query($conn, $sql);

// Verificar si se obtuvieron resultados
if (!$result) {
    die("Error en la consulta: " . mysqli_error($conn));
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- Enlace a Bootstrap -->
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Lista de Usuarios</h1>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Provincia</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td><?php echo $row['ID']; ?></td>
                        <td><?php echo $row['Nombre']; ?></td>
                        <td><?php echo $row['Apellido']; ?></td>
                        <td><?php echo $row['Email']; ?></td>
                        <td><?php echo $row['Nombre_Provincia']; ?></td>
                        
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <?php 
    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
    ?>
    
    
</body>
</html>
