<?php
include('functions.php');
require('inc/header.php');

// Obtener la conexión a la base de datos
$connection = getConnection();

// Consulta SQL para obtener todos los usuarios
$sql = "SELECT * FROM usuario";
$result = mysqli_query($connection, $sql);

// Verificar si se obtuvieron resultados
if (!$result) {
    die("Error en la consulta: " . mysqli_error($connection));
}
?>

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
                <th>Acciones</th> <!-- Nueva columna para acciones -->
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['ID']); ?></td>
                    <td><?php echo htmlspecialchars($row['Nombre']); ?></td>
                    <td><?php echo htmlspecialchars($row['Apellido']); ?></td>
                    <td><?php echo htmlspecialchars($row['Email']); ?></td>
                    <td><?php echo htmlspecialchars($row['Nombre_Provincia']); ?></td>
                    <td>
                        <!-- Botón de editar -->
                        <a href="edit.php?id=<?php echo htmlspecialchars($row['ID']); ?>" class="btn btn-warning btn-sm">Editar</a>
                        <!-- Botón de eliminar -->
                        <a href="delete.php?id=<?php echo htmlspecialchars($row['ID']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">Eliminar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php 
mysqli_close($connection);
require('inc/footer.php'); 
?>
