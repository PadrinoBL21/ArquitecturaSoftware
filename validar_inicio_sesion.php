<?php
include 'CONEXION.php';

session_start();

$usuario = $_POST['username'];
$contrasena = $_POST['password'];

$sql = "SELECT * FROM usuarios WHERE email = '$usuario' AND contrasena = '$contrasena'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
   
    $_SESSION['username'] = $row['email'];
    $_SESSION['rol'] = $row['rol'];

    header("Location: principal.php");
    exit();
} else {
    echo "<script>
        alert('Inicio de sesión incorrecto. Por favor, ingrese usuario y contraseña válidos.');
        window.history.back();
        </script>";
}

$conn->close();
?>
