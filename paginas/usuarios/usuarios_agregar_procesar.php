<?php
include '../../CONEXION.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nombre'], $_POST['email'], $_POST['rol'], $_POST['password'])) {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $rol_nombre = $_POST['rol'];
    $contrasena = $_POST['password'];

    $hashed_password = password_hash($contrasena, PASSWORD_BCRYPT);

    // Buscar el id del rol en base al nombre del rol
    $query_rol = "SELECT id_tipoUsuario FROM tipousuarios WHERE tipoUsuario_nombre = ?";
    $stmt_rol = $conn->prepare($query_rol);
    if ($stmt_rol === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }
    $stmt_rol->bind_param("s", $rol_nombre);
    $stmt_rol->execute();
    $result_rol = $stmt_rol->get_result();

    if ($result_rol->num_rows > 0) {
        $row_rol = $result_rol->fetch_assoc();
        $id_tipoUsuario = $row_rol['id_tipoUsuario'];

        // Insertar el usuario
        $query = "INSERT INTO usuarios (nombre, email, rol, contrasena, fecha_registro) VALUES (?, ?, ?, ?, NOW())";
        $stmt = $conn->prepare($query);
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $conn->error);
        }
        $stmt->bind_param("ssss", $nombre, $email, $id_tipoUsuario, $hashed_password);

        if ($stmt->execute()) {
            echo "<p>Usuario agregado correctamente.</p>";
            header("Location: usuarios_principal.php");
            exit();
        } else {
            echo "<p>Error al agregar el usuario: " . $stmt->error . "</p>";
        }

        $stmt->close();
    } else {
        echo "<p>Error: No se encontró el rol especificado. Verifica que el nombre del rol sea correcto.</p>";
    }

    $stmt_rol->close();
    $conn->close();
} else {
    echo "<p>No se proporcionaron datos válidos para agregar el usuario.</p>";
}
?>
