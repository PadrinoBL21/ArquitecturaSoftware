<?php
include '../../../CONEXION.php';
session_start();

if (isset($_GET['id_reporte'])) {
    $id_reporte = $_GET['id_reporte'];


     $query_consulta_individual = mysqli_query($conn, "SELECT r.*, m.Nombre_Maquina FROM Reportes r 
    INNER JOIN Maquinas m ON r.Maquina_ID = m.Maquina_ID
    WHERE r.id_reporte = $id_reporte");

    $result_consulta_individual = mysqli_num_rows($query_consulta_individual);
    
    if ($result_consulta_individual > 0) {
        $data_consulta_individual = mysqli_fetch_assoc($query_consulta_individual);
    } else {
        echo "<script>
            alert('No se encontró el reporte con el ID proporcionado.');
            window.history.back();
            </script>";
        exit; 
    }
} else {
    echo "<script>
        alert('ID de reporte no proporcionado.');
        window.history.back();
        </script>";
    exit; 
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Reporte</title>
    <link rel="icon" href="../../../img/logologin.jpg">
    <link rel="stylesheet" href="../../../css/detalle_reporte.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        .bueno {
            background-color: rgb(0, 129, 84);
  color: white;
}

        .malo {
            background-color: rgb(161, 20, 13);
            color: white;
}

        .marca-x {
  font-weight: bold;
}
    </style>
</head>

<body>
    <div class="container">
        <h1>Detalle del Reporte</h1>

        <table>
            <tr>
                <th>No. de Reporte</th>
                <th>Fecha</th>
                <th>Semana</th>
                <th>Revisado Por</th>
                <th>Turno</th>
                <th>Máquina</th>
            </tr>

            <tr>
                <td><?php echo $data_consulta_individual['id_reporte']; ?></td>
                <td><?php echo $data_consulta_individual['fecha']; ?></td>
                <td><?php echo date('W', strtotime($data_consulta_individual['fecha'])); ?></td>
                <td><?php echo $data_consulta_individual['Revisado_Por']; ?></td>
                <td><?php echo $data_consulta_individual['Turno']; ?></td>
                <td><?php echo $data_consulta_individual['Nombre_Maquina']; ?></td>

            </tr>
        </table>

        <h1>Detalles de Evaluación</h1>

        <table>
            <tr>
                <th>Aspecto a Evaluar</th>
                <th>Bueno</th>
                <th>Malo</th>
                <th>Observaciones</th>
            </tr>

            <?php
            //CONSULTA PARA OBTENER LOS ASPECTOS A EVALUAR
            $aspectos_query = mysqli_query($conn, "SELECT 
                    Riel_Ruedas_Poleas_Tren,
                    Ruidos_Extranos_Motor,
                    Control_Botones,
                    Limpieza_Clavijas,
                    Limpieza_Motor,
                    Limpieza_Riel,
                    Inspeccion_General_Equipo,
                    Estado_Conexiones_Quitar,
                    Observaciones_Riel_Ruedas_Poleas_Tren,
                    Observaciones_Ruidos_Extranos_Motor,
                    Observaciones_Control_Botones,
                    Observaciones_Limpiar_Clavijas,
                    Observaciones_Motor,
                    Observaciones_Riel,
                    Observaciones_Inspeccion_General_Equipo,
                    Observaciones_Estado_Conexiones_Quitar,
                    AveriasEncontradasAlMomento
            FROM Cuadreador WHERE id_reporte = $id_reporte"); 

            //DEFINICION DE VARIABLES
            while ($aspecto = mysqli_fetch_assoc($aspectos_query)) {
                $p_Riel_Ruedas_Poleas_Tren = $aspecto['Riel_Ruedas_Poleas_Tren'];
                $p_Observaciones_Riel_Ruedas_Poleas_Tren = $aspecto['Observaciones_Riel_Ruedas_Poleas_Tren'];
               
                $p_Ruidos_Extranos_Motor = $aspecto['Ruidos_Extranos_Motor'];
                $p_Observaciones_Ruidos_Extranos_Motor = $aspecto['Observaciones_Ruidos_Extranos_Motor'];
                
                $p_Control_Botones = $aspecto['Control_Botones'];
                $p_Observaciones_Control_Botones = $aspecto['Observaciones_Control_Botones'];
                
                $p_Limpieza_Clavijas = $aspecto['Limpieza_Clavijas'];
                $p_Observaciones_Limpieza_Clavijas = $aspecto['Observaciones_Limpiar_Clavijas'];
                
                $p_Limpieza_Motor = $aspecto['Limpieza_Motor'];
                $p_Observaciones_Motor = $aspecto['Observaciones_Motor'];
                
                $p_Limpieza_Riel = $aspecto['Limpieza_Riel'];
                $p_Observaciones_Riel = $aspecto['Observaciones_Riel'];
                
                $p_Inspeccion_General_Equipo = $aspecto['Inspeccion_General_Equipo'];
                $p_Observaciones_Inspeccion_General_Equipo = $aspecto['Observaciones_Inspeccion_General_Equipo'];
                
                $p_Estado_Conexiones_Quitar = $aspecto['Estado_Conexiones_Quitar'];
                $p_Observaciones_Estado_Conexiones_Quitar = $aspecto['Observaciones_Estado_Conexiones_Quitar'];
                
                $p_Averias_al_momento = $aspecto['AveriasEncontradasAlMomento'];
            ?>
            <!--TABLAS DE ASPECTOS A EVALUAR-->
                <tr>
                    <td>Riel, Ruedas y Poleas de Tren</td>
                    <td <?php echo ($p_Riel_Ruedas_Poleas_Tren == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($p_Riel_Ruedas_Poleas_Tren == 'Bueno') ? '' : ''; ?></td>
                    <td <?php echo ($p_Riel_Ruedas_Poleas_Tren == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($p_Riel_Ruedas_Poleas_Tren == 'Malo') ? '' : ''; ?></td>
                    <td><?php echo $p_Observaciones_Riel_Ruedas_Poleas_Tren; ?></td>
                </tr>

                <tr>
                    <td>Ruidos Extraños en el Motor</td>
                    <td <?php echo ($p_Ruidos_Extranos_Motor == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($p_Ruidos_Extranos_Motor == 'Bueno') ? '' : ''; ?></td>
                    <td <?php echo ($p_Ruidos_Extranos_Motor == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($p_Ruidos_Extranos_Motor == 'Malo') ? '' : ''; ?></td>
                    <td><?php echo $p_Observaciones_Ruidos_Extranos_Motor; ?></td>
                </tr>

                <tr> 
                    <td>Control/Botones</td>
                    <td <?php echo ($p_Control_Botones == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($p_Control_Botones == 'Bueno') ? '' : ''; ?></td>
                    <td <?php echo ($p_Control_Botones == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($p_Control_Botones == 'Malo') ? '' : ''; ?></td>
                    <td><?php echo $p_Observaciones_Control_Botones; ?></td>
                </tr>
        </table>

        <h1>Aspectos a Limpiar</h1>
        <table>
            <tr>
                <th>Aspecto a Evaluar</th>
                <th>Sí</th>
                <th>No</th>
                <th>Observaciones</th>
            </tr>

                <tr>
                    <td>Limpieza de Clavijas</td>
                    <td <?php echo ($p_Limpieza_Clavijas == 'Sí') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($p_Limpieza_Clavijas == 'Sí') ? '' : ''; ?></td>
                    <td <?php echo ($p_Limpieza_Clavijas == 'No') ? 'class="marca-x malo"' : ''; ?>><?php echo ($p_Limpieza_Clavijas == 'No') ? '' : ''; ?></td>
                    <td><?php echo $p_Observaciones_Limpieza_Clavijas; ?></td>
                </tr>

                <tr>
                    <td>Limpieza de Motor</td>
                    <td <?php echo ($p_Limpieza_Motor == 'Sí') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($p_Limpieza_Motor == 'Sí') ? '' : ''; ?></td>
                    <td <?php echo ($p_Limpieza_Motor == 'No') ? 'class="marca-x malo"' : ''; ?>><?php echo ($p_Limpieza_Motor == 'No') ? '' : ''; ?></td>
                    <td><?php echo $p_Observaciones_Motor; ?></td>
                </tr>
                <tr>
                    <td>Limpieza de Riel</td>
                    <td <?php echo ($p_Limpieza_Riel == 'Sí') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($p_Limpieza_Riel == 'Sí') ? '' : ''; ?></td>
                    <td <?php echo ($p_Limpieza_Riel == 'No') ? 'class="marca-x malo"' : ''; ?>><?php echo ($p_Limpieza_Riel == 'No') ? '' : ''; ?></td>
                    <td><?php echo $p_Observaciones_Riel; ?></td>
                </tr>
        
        </table>

        <h1>Antes de Apagar</h1>
        <table>
        <tr>
                <th>Aspecto a Evaluar</th>
                <th>Bueno</th>
                <th>Malo</th>
                <th>Observaciones</th>
            </tr>
                <tr>
                    <td>Inspección General del Equipo</td>
                    <td <?php echo ($p_Inspeccion_General_Equipo == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($p_Inspeccion_General_Equipo == 'Bueno') ? '' : ''; ?></td>
                    <td <?php echo ($p_Inspeccion_General_Equipo == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($p_Inspeccion_General_Equipo == 'Malo') ? '' : ''; ?></td>
                    <td><?php echo $p_Observaciones_Inspeccion_General_Equipo; ?></td>
                </tr>
                <tr>
                    <td>Estado de Conexiones al Quitar</td>
                    <td <?php echo ($p_Estado_Conexiones_Quitar == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($p_Estado_Conexiones_Quitar == 'Bueno') ? '' : ''; ?></td>
                    <td <?php echo ($p_Estado_Conexiones_Quitar == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($p_Estado_Conexiones_Quitar == 'Malo') ? '' : ''; ?></td>
                    <td><?php echo $p_Observaciones_Estado_Conexiones_Quitar; ?></td>
                </tr>
                
               

        </table>

        <H1>Averías Encontradas al Momento</H1>
        <table>
            
            <tr>
                <td><?php echo $p_Averias_al_momento; ?></td>
            </tr>
        </table>
            

       

       
        <!--Si el reporte es de turno check , Incluir consultar_id_reporte_check.php-->
                
            <?php
             }
            if ($data_consulta_individual['Turno'] == 'Check') {
                
                include 'consultar_id_reporte_check.php';
            }
            ?>
        </table>

        <a href="../cuadreadores_principal.php" class="btn btn-secondary btn-lg"><i class="fas fa-arrow-left"></i> Volver</a>
    </div>

</body>

</html>
