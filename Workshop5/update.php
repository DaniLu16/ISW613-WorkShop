<?php
include 'functions.php';

// Comprobar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Para verificar los datos enviados
    var_dump($_POST); 

    $usuario = [
        'ID' => $_POST['ID'],
        'Nombre' => $_POST['Nombre'],
        'Apellido' => $_POST['Apellido'],
        'Email' => $_POST['Email'],
        'ID_provincia' => $_POST['ID_provincia'],
    ];

    // Llamar a la función para actualizar el usuario
    if (updateUser($usuario)) {
        // Redirigir a la lista de usuarios después de la actualización
        header("Location: users.php?message=Usuario actualizado correctamente.");
        exit();
    } else {
        echo "Error al actualizar el usuario.";
    }
} else {
    // Si no se ha enviado el formulario, obtener el ID del usuario desde la URL
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    // Obtener los datos del usuario desde la base de datos
    $usuario = getUserById($id); // Asegúrate de que esta función esté definida en functions.php

    // Comprobar si el usuario existe
    if (!$usuario) {
        echo "Usuario no encontrado.";
        exit;
    }
}

// Obtener las provincias para mostrarlas en un select
$provinces = getProvinces(); // Llama a tu función para obtener las provincias

// Incluir el archivo de cabecera
require 'inc/header.php';
?>

<div class="container mt-5">
    <h1 class="text-center">Actualizar Usuario</h1>
    <form action="update.php?id=<?php echo htmlspecialchars($usuario['ID']); ?>" method="POST">
        <input type="hidden" name="ID" value="<?php echo htmlspecialchars($usuario['ID']); ?>">
        
        <div class="form-group">
            <label for="Nombre">Nombre:</label>
            <input type="text" class="form-control" id="Nombre" name="Nombre" value="<?php echo htmlspecialchars($usuario['Nombre']); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="Apellido">Apellido:</label>
            <input type="text" class="form-control" id="Apellido" name="Apellido" value="<?php echo htmlspecialchars($usuario['Apellido']); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="Email">Email:</label>
            <input type="email" class="form-control" id="Email" name="Email" value="<?php echo htmlspecialchars($usuario['Email']); ?>" required>
        </div>

        <div class="form-group">
            <label for="ID_provincia">Provincia:</label>
            <select class="form-control" id="ID_provincia" name="ID_provincia" required>
                <?php foreach ($provinces as $id_provincia => $nombre_provincia): ?>
                    <option value="<?php echo htmlspecialchars($id_provincia); ?>" <?php echo ($id_provincia == $usuario['ID_provincia']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($nombre_provincia); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
    </form>
</div>

<!-- Incluir Bootstrap JS y dependencias (jQuery y Popper.js) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php
require 'inc/footer.php'; 
?>
