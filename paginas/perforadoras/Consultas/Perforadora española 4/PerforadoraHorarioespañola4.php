<?php
// Inicia la sesión
session_start();

// Establece el nombre de la máquina en la variable de sesión
$_SESSION['nombre_maquina'] = "Perforadora española 4";
$_SESSION['maquina_id'] = "29";
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horario</title>
    <link rel="icon" href="../../../../img/logologin.jpg">
    <link rel="stylesheet" href="../../../../css/principal.css" />
</head>

<body>

    <div class="container">

    <h1>Perforadora española 4</h1>

        <div class="nav">
            <a href="../consultar_reporte_matutino.php">Horario Día</a>
            <a href="../consultar_reporte_vespertino.php">Horario Noche</a>
        </div>

        
        <a href="../../perforadoras_principal.php" class="btn-actualizar">Volver</a>
        

        
    </div>
</body>

</html>

