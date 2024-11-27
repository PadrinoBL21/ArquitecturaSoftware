<?php
include '../../../CONEXION.php';
session_start();
$maquina_id = isset($_SESSION['maquina_id']) ? $_SESSION['maquina_id'] : 'ID de la Máquina No Disponible';

$query_consulta = mysqli_query($conn, "SELECT 
    r.id_reporte,
    DATE_FORMAT(r.fecha, '%Y-%m-%d') AS fecha,
    m.Nombre_Maquina,
    r.Revisado_Por,
    r.Turno,
    r.Maquina_ID
FROM Reportes r 
INNER JOIN Maquinas m ON r.Maquina_ID = m.Maquina_ID
WHERE r.Maquina_ID = $maquina_id AND r.Turno = 'Check'
ORDER BY r.id_reporte DESC
LIMIT 30");

$result_consulta = mysqli_num_rows($query_consulta);

if ($result_consulta > 0) {
    $data_consulta = mysqli_fetch_all($query_consulta, MYSQLI_ASSOC);
} else {
    echo "<script>
    alert('No existen reportes para la máquina seleccionada.');
    window.history.back();
    </script>";
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes de Máquina</title>
    <link rel="icon" href="../../../img/logologin.jpg">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../../../css/tablas.css" />

    <style>

    </style>
</head>

<body>
<div class="container mt-5">
        <h1 class="text-center mb-4">Reportes de Máquina</h1>
        <h2 class="text-center mb-4">Máquina: <?php echo $data_consulta[0]['Nombre_Maquina']; ?></h2>
        <h3 class="text-center mb-4">Turno: <?php echo $data_consulta[0]['Turno']; ?></h3>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Reporte</th>
                        <th>Fecha</th>
                        <th>Revisado Por</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data_consulta as $reporte) { ?>
                        <tr>
                            <td><?php echo $reporte['id_reporte']; ?></td>
                            <td><?php echo $reporte['fecha']; ?></td>
                            <td><?php echo $reporte['Revisado_Por']; ?></td>
                            <td>
                                <a href="consultar_id_reporte.php?id_reporte=<?php echo $reporte['id_reporte']; ?>" class="btn btn-info btn-lg">
                                    <i class="fas fa-eye icono-personalizado"></i> Ver Reporte
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="text-center mt-4">
            <a href="../compresores_principal.php" class="btn btn-secondary btn-custom"><i class="fas fa-arrow-left icono-personalizado"></i>  Volver</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
