<?php
include '../../CONEXION.php';

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../../index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yucles</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../../css/tablas.css">
    <link rel="icon" href="../../img/logologin.jpg">
    <style>
     
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Yucles</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Nombre máquina</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Añade más filas según sea necesario -->
                    <tr>
                        <td>Yucle D400E</td>
                        <td class="text-center">
                            <a class="btn btn-info btn-lg" href="Consultas/Yucle D400E/YucleHorarioD400E.php" title="Consulta">
                                <i class="far fa-clipboard icono-personalizado"></i>
                            </a>
                            <a class="btn btn-warning btn-lg" href="horarios/YucleHorarioD400E.php" title="Editar">
                                <i class="far fa-edit icono-personalizado"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>Yucle D300E</td>
                        <td class="text-center">
                            <a class="btn btn-info btn-lg" href="Consultas/Yucle D300E/YucleHorarioD300E.php" title="Consulta">
                                <i class="far fa-clipboard icono-personalizado"></i>
                            </a>
                            <a class="btn btn-warning btn-lg" href="horarios/YucleHorarioD300E.php" title="Editar">
                                <i class="far fa-edit icono-personalizado"></i>
                            </a>
                        </td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
        <div class="text-center mt-4">
            <a href="../../principal.php" class="btn btn-secondary btn-lg">Volver a principal</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
