<?php
// Inicia la sesión
session_start();

// Establece el nombre de la máquina en la variable de sesión
$_SESSION['nombre_maquina'] = "Cargador frontal 988F";
$_SESSION['maquina_id'] = "2";
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

    <h1>Cargador frontal 988F</h1>

        <div class="nav">
            <a href="../consultarReporteMatutino.php">Horario Día</a>
            <a href="../consultarReporteVespertino.php">Horario Noche</a>
            <a href="../consultarCheckMantenimiento.php">Check De Mantenimiento</a>
        </div>

        
        <a href="../../cargadores_principal.php" class="btn-actualizar">Volver</a>
        

        
    </div>
</body>

</html>

