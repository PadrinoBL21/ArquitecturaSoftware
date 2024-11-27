<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../../../index.html");
    exit();
}

$_SESSION['nombre_maquina'] = "Cargador frontal 988F";
$_SESSION['maquina_id'] = "2";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horario</title>
    <link rel="icon" href="../../img/logologin.jpg">
    <link rel="stylesheet" href="../../../css/principal.css" />
</head>

<body>

    <div class="container">

    <h1>Cargador frontal 988F</h1>

        <div class="nav">
            <a href="../agregar_reporte_matutino.php">Horario Día</a>
            <a href="../agregar_reporte_vespertino.php">Horario Noche</a>
            <a href="../agregar_check_mantenimiento.php">Check de mantenimiento</a>
        </div>

        
        <a href="../cargadores_principal.php" class="btn-actualizar">Volver</a>
        

        
    </div>
</body>

</html>

