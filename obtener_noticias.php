<?php
// Archivo de conexión a la base de datos (por ejemplo, db_connection.php)
include 'CONEXION.php';

// Realizar la conexión a la base de datos

// Consulta SQL para seleccionar todas las noticias
$sql = "SELECT * FROM articulo";

// Ejecutar la consulta
$resultado = mysqli_query($conn, $sql);

$noticias=array();
// Verificar si hay resultados
if (mysqli_num_rows($resultado) > 0) {
    

    // Iterar sobre los resultados y mostrar cada fila
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $noticias[]=$fila;
    }
   echo json_encode($noticias);
} else {
    echo "No se encontraron noticias.";
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
