<?php
$servername = "database-1.cuik0pe63vnh.us-east-2.rds.amazonaws.com";
$username = "adminSSS";
$password = "CPmobl16";
$dbname = "bitacorasmantenimientoop2";

try {
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Verificar conexión
    if ($conn->connect_error) {
        throw new Exception("Conexión fallida: " . $conn->connect_error);
    }
} catch (Exception $e) {
    // Guardar detalles del error en un archivo de registro
    error_log($e->getMessage(), 3, "error_log.txt");
    
    // Mostrar mensaje genérico al usuario
    die("Ocurrió un error con la conexión a la BD, contactar con el administrador de TI.");
}
?>
