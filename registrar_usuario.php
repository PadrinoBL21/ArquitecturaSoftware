<?php
include 'CONEXION.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$db = $conn;
$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombres = mysqli_real_escape_string($db, $_POST['nombres']);
    $apellidos = mysqli_real_escape_string($db, $_POST['apellidos']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $contrasena = mysqli_real_escape_string($db, $_POST['contrasena']);
    $municipios_id = $_POST['municipios_id'];

    if (!$nombres) $errores[] = "El campo Nombre(s) no puede estar vacío";
    if (!$apellidos) $errores[] = "El campo Apellidos no puede estar vacío";
    if (!$email) $errores[] = 'Debes ingresar un e-mail válido';
    if (!$password) $errores[] = "Debes ingresar una contraseña";
    if ($password !== $contrasena) $errores[] = "Las contraseñas deben coincidir";

    if (empty($errores)) {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $query = "INSERT INTO usuarios (nombres, apellidos, email, contrasena, municipios_id) 
                  VALUES (?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($db, $query)) {
            mysqli_stmt_bind_param($stmt, 'ssssi', $nombres, $apellidos, $email, $passwordHash, $municipios_id);
            $resultado = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            if ($resultado) {
                $mail = new PHPMailer(true);
                try {
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'itsx.msco.maiz@gmail.com';
                    $mail->Password = 'anilldfshtmghoim';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                    $mail->Port = 465;
                    $mail->setFrom('itsx.msco.maiz@gmail.com', 'AppMaiz');
                    $mail->addAddress($email, $nombres);
                    $mail->isHTML(true);
                    $mail->Subject = 'Registro de Cuenta Exitoso';
                    $mail->Body = 'Gracias por registrarte ' . $nombres . ' ' . $apellidos . '.<br>
                                   Tu cuenta se ha registrado exitosamente.<br> 
                                   Ya puedes acceder al apartado de análisis de deficiencias iniciando sesión en tu cuenta.';
                    $mail->send();
                } catch (Exception $e) {
                    echo 'Error al enviar el correo: ' . $mail->ErrorInfo;
                }
            } else {
                echo 'Error al insertar el usuario en la base de datos.';
            }
        } else {
            echo 'Error al preparar la consulta.';
        }
    } else {
        foreach ($errores as $error) {
            echo $error . "<br>";
        }
    }
}
?>
