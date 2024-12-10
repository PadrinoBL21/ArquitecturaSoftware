<?php
include 'CONEXION.php';

session_start();

$usuario = $_POST['username'];
$contrasena = $_POST['password'];

// Preparar la consulta para evitar inyecciones SQL
$sql = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $conn->error);
}
$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Verificar la contraseña usando password_verify
    if (password_verify($contrasena, $row['contrasena'])) {
        $_SESSION['username'] = $row['email'];
        $_SESSION['rol'] = $row['rol'];

        header("Location: principal.php");
        exit();
    } else {
        echo "<script>
            alert('Contraseña incorrecta. Por favor, intente nuevamente.');
            window.history.back();
            </script>";
    }
} else {
    echo "<script>
        alert('Usuario no encontrado. Por favor, intente nuevamente.');
        window.history.back();
        </script>";
}

$stmt->close();
$conn->close();
?>
