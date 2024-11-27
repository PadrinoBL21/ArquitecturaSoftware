<?php
include '../../CONEXION.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['email'])) {
    $email = $_GET['email'];

    $query = "DELETE FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header("Location: usuarios_principal.php");
        exit(); // Asegura que el script termine después de la redirección
    } else {
        echo "<p>Error al eliminar el usuario.</p>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<p>No se proporcionó un correo válido para eliminar el usuario.</p>";
}
?>
