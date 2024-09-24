<?php 
  // Inicializar las variables
  $nombre = @$_REQUEST['nombre'];
  $apellido = @$_REQUEST['apellido'];
  $telefono = @$_REQUEST['telefono'];
  $correo = @$_REQUEST['correo'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
</head>
<body>
    <h1>Registro de Información Personal</h1>
    <form action="save.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($nombre); ?>" required>
        <br>
        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" id="apellido" value="<?php echo htmlspecialchars($apellido); ?>" required>
        <br>
        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" id="telefono" value="<?php echo htmlspecialchars($telefono); ?>" required>
        <br>
        <label for="correo">Correo:</label>
        <input type="email" name="correo" id="correo" value="<?php echo htmlspecialchars($correo); ?>" required>
        <br>
        <button type="submit">Guardar</button>
    </form>
</body>
</html>
