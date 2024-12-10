<?php
include '../../CONEXION.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'], $_POST['nombre'], $_POST['rol'])) {
    $email = trim($_POST['email']);
    $nombre = trim($_POST['nombre']);
    $rol = trim($_POST['rol']);

    // Validar que los campos no estén vacíos
    if (empty($email) || empty($nombre) || empty($rol)) {
        die("Por favor, complete todos los campos.");
    }

    // Verificar que el rol existe
    $query_check_rol = "SELECT id_tipoUsuario FROM tipousuarios WHERE id_tipoUsuario = ?";
    $stmt_check = $conn->prepare($query_check_rol);
    if (!$stmt_check) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }
    $stmt_check->bind_param("s", $rol);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows === 0) {
        die("El rol especificado no existe.");
    }
    $stmt_check->close();

    // Actualizar el usuario
    $query = "UPDATE usuarios SET nombre = ?, rol = ? WHERE email = ?";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }
    $stmt->bind_param("sss", $nombre, $rol, $email);

    if ($stmt->execute()) {
        echo "<p>Usuario actualizado correctamente.</p>";
        header("Location: usuarios_principal.php");
        exit();
    } else {
        die("Error al ejecutar la consulta: " . $stmt->error);
    }

    $stmt->close();
    $conn->close();
} else {
    die("No se proporcionaron datos válidos para actualizar el usuario.");
}
?>
