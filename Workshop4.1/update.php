<?php
function updateUser($id, $nombre = null, $apellido = null, $email = null, $id_provincia = null) {
    $conn = getConnection();

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // Recuperar datos del usuario
        $sql = "SELECT * FROM usuario WHERE ID = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $user = mysqli_fetch_assoc($result);

            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            return $user; // Devuelve los datos del usuario
        } else {
            echo "Error al preparar la consulta: " . mysqli_error($conn);
        }
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Actualizar datos del usuario
        $sql = "UPDATE usuario SET Nombre = ?, Apellido = ?, Email = ?, ID_provincia = ? WHERE ID = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sssii", $nombre, $apellido, $email, $id_provincia, $id);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                return true; // Actualización exitosa
            } else {
                echo "Error al actualizar el usuario: " . mysqli_stmt_error($stmt);
            }
        } else {
            echo "Error al preparar la consulta: " . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
    return false;
}
?>
