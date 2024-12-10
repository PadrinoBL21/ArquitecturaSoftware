<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include '../../CONEXION.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'], $_POST['nombre'], $_POST['rol'])) {
    $email = $_POST['email'];
    $nombre = $_POST['nombre'];
    $rol = $_POST['rol'];

    $query = "UPDATE usuarios SET nombre = ?, rol = ? WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $nombre, $rol, $email);

    if ($stmt->execute()) {
        echo "<p>Usuario actualizado correctamente.</p>";
        header("Location: usuarios_principal.php");

    } else {
        echo "<p>Error al actualizar el usuario.</p>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<p>No se proporcionaron datos válidos para actualizar el usuario.</p>";
}
?>
