
<?php
// Inicia la sesión
session_start();

// Son nescesarias en cada maquina para definir el nombre de la maquina y su id Primero se debe añadir la maquina en la base de datos /*
$_SESSION['nombre_maquina'] = "Espada Dazzini";
$_SESSION['maquina_id'] = "9";

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

    <h1>Espada Dazzini</h1>

        <div class="nav">
            <a href="../agregar_reporte_matutino.php">Horario Día</a>
            <a href="../agregar_reporte_vespertino.php">Horario Noche</a>
        </div>

        
        <a href="../espadas_principal.php" class="btn-actualizar">Volver</a>
        

        
    </div>
</body>

</html>

