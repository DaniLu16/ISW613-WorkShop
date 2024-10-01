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

    mysqli_close($conn);  // Cerrar la conexión a la base de datos
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
    return null; // Retornar null si no se encuentra
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
        // Enlazar parámetros
        mysqli_stmt_bind_param($stmt, "ssssss", $nombre, $apellido, $email, $contraseña, $id_provincia, $nombre_provincia);

        // Ejecutar la consulta
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            mysqli_close($conn); // Cerrar la conexión a la base de datos
            return true;
        } else {
            echo "Error al insertar el usuario: " . mysqli_stmt_error($stmt);
        }
    } else {
        echo "Error al preparar la consulta: " . mysqli_error($conn);
    }

    mysqli_close($conn); // Cerrar la conexión a la base de datos
    return false;
}
?>
