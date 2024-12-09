<?php
include 'CONEXION.php';

$sql = "SELECT id, nombre FROM municipios";
$result = $conn->query($sql);

$municipios = array();

if ($result->num_rows > 0) {
    // Output de datos de cada fila
    while ($row = $result->fetch_assoc()) {
        $municipios[] = $row;
    }
} else {
    echo "0 results";
}
$conn->close();

echo json_encode($municipios);
?>
