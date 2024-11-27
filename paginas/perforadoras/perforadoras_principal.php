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
    <title>Perforadoras</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../../css/tablas.css">
    <link rel="icon" href="../../img/logologin.jpg">
    <style>
  
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Perforadoras</h1>
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
                        <td>Hidráulica Dazzini 1</td>
                        <td class="text-center">
                            <a class="btn btn-info btn-lg" href="Consultas/Perforadora hidráulica Dazzini 1/PerforadoraHorariohidraulicaDazzini1.php" title="Consulta">
                                <i class="far fa-clipboard icono-personalizado"></i>
                            </a>
                            <a class="btn btn-warning btn-lg" href="horarios/PerforadoraHorariohidraulicaDazzini1.php" title="Editar">
                                <i class="far fa-edit icono-personalizado"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>Hidráulica Dazzini 2</td>
                        <td class="text-center">
                            <a class="btn btn-info btn-lg" href="Consultas/Perforadora hidráulica Dazzini 2/PerforadoraHorariohidraulicaDazzini2.php" title="Consulta">
                                <i class="far fa-clipboard icono-personalizado"></i>
                            </a>
                            <a class="btn btn-warning btn-lg" href="horarios/PerforadoraHorariohidraulicaDazzini2.php" title="Editar">
                                <i class="far fa-edit icono-personalizado"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>Perforadora Aire 3</td>
                        <td class="text-center">
                            <a class="btn btn-info btn-lg" href="Consultas/Perforadora Aire 3/PerforadoraHorarioAire3.php" title="Consulta">
                                <i class="far fa-clipboard icono-personalizado"></i>
                            </a>
                            <a class="btn btn-warning btn-lg" href="horarios/PerforadoraHorarioAire3.php" title="Editar">
                                <i class="far fa-edit icono-personalizado"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>Perforadora española 4</td>
                        <td class="text-center">
                            <a class="btn btn-info btn-lg" href="Consultas/Perforadora española 4/PerforadoraHorarioespañola4.php" title="Consulta">
                                <i class="far fa-clipboard icono-personalizado"></i>
                            </a>
                            <a class="btn btn-warning btn-lg" href="horarios/PerforadoraHorarioespañola4.php" title="Editar">
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
