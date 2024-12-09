<?php
$servername = "bitacoradatabase-1.cuik0pe63vnh.us-east-2.rds.amazonaws.com";
$username = "admin";
$password = "CPmobl16";
$dbname = "bitacorasMantenimientoOP2";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>