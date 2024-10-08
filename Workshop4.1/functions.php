<?php 

function getProvinces() {
    $conn = getConnection();
    $provinces = [];
    
    // Consulta SQL para obtener las provincias
    $sql = "SELECT ID, Nombre_Provincia FROM provincias";
    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $provinces[$row['ID']] = $row['Nombre_Provincia'];
        }
    } else {
        echo "Error al obtener provincias: " . mysqli_error($conn);
    }

    mysqli_close($conn);  
    return $provinces;
}

function getConnection() {
    $connection = mysqli_connect('localhost', 'root', '', 'php_web3');
    
    // Verificar si la conexión fue exitosa
    if (!$connection) {
        die("Conexión fallida: " . mysqli_connect_error());
    }

    return $connection;
}

function getProvinceName($id_provincia) {
    $conn = getConnection();
    
    // Consulta SQL para obtener el nombre de la provincia
    $sql = "SELECT Nombre_Provincia FROM provincias WHERE ID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id_provincia);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $nombre_provincia);
        
        if (mysqli_stmt_fetch($stmt)) {
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            return $nombre_provincia;
        } else {
            echo "Error al obtener el nombre de la provincia: " . mysqli_stmt_error($stmt);
        }
    } else {
        echo "Error al preparar la consulta: " . mysqli_error($conn);
    }

    mysqli_close($conn);
    return null; 
}

function saveUser($usuario) {
    $nombre = $usuario['Nombre'];  
    $apellido = $usuario['Apellido'];  
    $email = $usuario['Email'];  
    $contraseña = password_hash($usuario['Contraseña'], PASSWORD_DEFAULT); 
    $id_provincia = $usuario['ID_provincia'];  

    // Obtener el nombre de la provincia
    $nombre_provincia = getProvinceName($id_provincia);

    // Obtener la conexión a la base de datos
    $conn = getConnection();

    // Consulta SQL para insertar el usuario en la base de datos
    $sql = "INSERT INTO usuario (Nombre, Apellido, Email, Contraseña, ID_provincia, Nombre_Provincia) 
            VALUES (?, ?, ?, ?, ?, ?)";
    
    // Preparar la declaración
    $stmt = mysqli_prepare($conn, $sql);
    
    if ($stmt) {
       
        mysqli_stmt_bind_param($stmt, "ssssss", $nombre, $apellido, $email, $contraseña, $id_provincia, $nombre_provincia);

        
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            mysqli_close($conn); 
            return true;
        } else {
            echo "Error al insertar el usuario: " . mysqli_stmt_error($stmt);
        }
    } else {
        echo "Error al preparar la consulta: " . mysqli_error($conn);
    }

    mysqli_close($conn); 
    return false;
}



function authenticate($email, $password): bool|array|null {
    $conn = getConnection();

    // Consulta SQL para obtener el usuario
    $sql = "SELECT * FROM usuario WHERE Email = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);

        if ($user && password_verify($password, $user['Contraseña'])) {
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            return $user; // Devolver el usuario autenticado
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($conn);
    return null; // Devuelve null si no se encuentra el usuario o la contraseña no es correcta
}


function updateUser($usuario) {
    $id = $usuario['ID']; // ID del usuario a actualizar
    $nombre = $usuario['Nombre'];
    $apellido = $usuario['Apellido'];
    $email = $usuario['Email'];
    $id_provincia = $usuario['ID_provincia'];

    // Obtener el nombre de la provincia
    $nombre_provincia = getProvinceName($id_provincia);

    // Obtener la conexión a la base de datos
    $conn = getConnection();

    // Consulta SQL para actualizar el usuario en la base de datos
    $sql = "UPDATE usuario SET Nombre = ?, Apellido = ?, Email = ?, ID_provincia = ?, Nombre_Provincia = ? WHERE ID = ?";

    // Preparar la declaración
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssi", $nombre, $apellido, $email, $id_provincia, $nombre_provincia, $id);

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

    mysqli_close($conn);
    return false; // Falló la actualización
}


function deleteUser($id) {
    // Obtener la conexión a la base de datos
    $conn = getConnection();

    // Consulta SQL para eliminar el usuario de la base de datos
    $sql = "DELETE FROM usuario WHERE ID = ?";
    
    // Preparar la declaración
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id); // Vincular el parámetro

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt); // Cerrar la declaración
            mysqli_close($conn); // Cerrar la conexión
            return true; // Eliminación exitosa
        } else {
            echo "Error al eliminar el usuario: " . mysqli_stmt_error($stmt);
        }
    } else {
        echo "Error al preparar la consulta: " . mysqli_error($conn);
    }

    mysqli_close($conn); // Cerrar la conexión
    return false; // Falló la eliminación
}
?>