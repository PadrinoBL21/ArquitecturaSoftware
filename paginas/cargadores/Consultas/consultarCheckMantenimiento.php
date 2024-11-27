<?php
include '../../../CONEXION.php';
session_start();
$maquina_id = isset($_SESSION['maquina_id']) ? $_SESSION['maquina_id'] : 'ID de la Máquina No Disponible';

// Variables para la paginación
define('LIMIT', 10);
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * LIMIT;

// Filtrar resultados según la barra de búsqueda
$search = isset($_GET['search']) ? $_GET['search'] : '';
$search_query = "";
if (!empty($search)) {
    $search_query = " AND (r.Revisado_Por LIKE '%$search%' OR DATE_FORMAT(r.fecha, '%Y-%m-%d') LIKE '%$search%' OR m.Nombre_Maquina LIKE '%$search%')";
}

// Consulta con límite y búsqueda
$query_consulta = mysqli_query($conn, "SELECT 
    r.id_reporte,
    DATE_FORMAT(r.fecha, '%Y-%m-%d') AS fecha,
    m.Nombre_Maquina,
    r.Revisado_Por,
    r.Turno,
    r.Maquina_ID,
    m.estatus
FROM Reportes r 
INNER JOIN Maquinas m ON r.Maquina_ID = m.Maquina_ID
WHERE r.Maquina_ID = $maquina_id AND r.Turno = 'Check' $search_query
ORDER BY r.id_reporte DESC
LIMIT " . LIMIT . " OFFSET $offset");

$result_consulta = mysqli_num_rows($query_consulta);

if ($result_consulta > 0) {
    $data_consulta = mysqli_fetch_all($query_consulta, MYSQLI_ASSOC);
} else {
    echo "<script>
    alert('No existen reportes para la máquina seleccionada.');
    window.history.back();
    </script>";
    exit;
}

// Consulta para obtener el número total de registros
$query_total = mysqli_query($conn, "SELECT COUNT(*) AS total FROM Reportes r 
INNER JOIN Maquinas m ON r.Maquina_ID = m.Maquina_ID
WHERE r.Maquina_ID = $maquina_id AND r.Turno = 'Check' $search_query");
$total_rows = mysqli_fetch_assoc($query_total)['total'];
$total_pages = ceil($total_rows / LIMIT);
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
    <link rel="stylesheet" href="../../../css/tablas.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Reportes de Máquina</h1>
        <h2 class="text-center mb-4">Máquina: <?php echo $data_consulta[0]['Nombre_Maquina']; ?></h2>
        <h3 class="text-center mb-4">Turno: <?php echo $data_consulta[0]['Turno']; ?></h3>
        <h4 class="text-center mb-4">Estatus de la Máquina: <?php echo $data_consulta[0]['estatus']; ?></h4>

        <!-- Barra de búsqueda -->
        <form method="get" action="" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Ingrese cadena de búsqueda" value="<?php echo htmlspecialchars($search); ?>">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Buscar</button>
                </div>
            </div>
        </form>

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

        <!-- Paginación -->
        <nav aria-label="Page navigation" class="mt-4">
            <ul class="pagination justify-content-center">
                <?php if ($page > 1) { ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page - 1; ?>&search=<?php echo urlencode($search); ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php } ?>
                <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                    <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>"><?php echo $i; ?></a>
                    </li>
                <?php } ?>
                <?php if ($page < $total_pages) { ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page + 1; ?>&search=<?php echo urlencode($search); ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </nav>

        <div class="text-center mt-4">
            <a href="../cargadores_principal.php" class="btn btn-secondary btn-custom"><i class="fas fa-arrow-left icono-personalizado"></i> Volver</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
