
<?php
// Inicia la sesión
session_start();

// Son nescesarias en cada maquina para definir el nombre de la maquina y su id Primero se debe añadir la maquina en la base de datos /*
$_SESSION['nombre_maquina'] = "Generador Cummins verde";
$_SESSION['maquina_id'] = "15";

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horario</title>
    <link rel="icon" href="../../../img/logologin.jpg">
    <link rel="stylesheet" href="../../../css/principal.css" />
</head>

<body>

    <div class="container">

    <h1>Generador Cummins Verde</h1>

        <div class="nav">
            <a href="../agregar_reporte_matutino.php">Horario Día</a>
            <a href="../agregar_reporte_vespertino.php">Horario Noche</a>
            <a href="../agregar_check_mantenimiento.php">Check Mantenimiento</a>

        </div>

        
        <a href="../generadores_principal.php" class="btn-actualizar">Volver</a>
        

        
    </div>
</body>

</html>

