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
            Control_Botones, Revision_Movimientos_Avance, Revisar_Movimientos_Polea, Revisar_Giros_Motor,
            Limpieza_Clavijas, Interior_Exterior_Carro, Engrasar_Bastagos, Ruidos_Extranos,
            Inspeccion_General_Equipo, Estado_Conexiones_Quitar, Horometro_Inicial, Horometro_Final,
            Observaciones_Control_Botones, Observaciones_Revision_Movimientos_Avance, Observaciones_Revisar_Movimientos_Polea,
            Observaciones_Revisar_Giros_Motor, Observaciones_Limpieza_Clavijas, Observaciones_InteriorExteriorCarro,
            Observaciones_Engrasar_Bastagos, Observaciones_Ruidos_Extranos, Observaciones_Inspeccion_General_Equipo,
            Observaciones_Estado_Conexiones_Quitar, Observaciones_Horometro_Inicial, Observaciones_Horometro_Final,
            Observaciones_Adicionales
            FROM Hilo_Dazzini WHERE id_reporte = $id_reporte"); 

            //DEFINICION DE VARIABLES
            while ($aspecto = mysqli_fetch_assoc($aspectos_query)) {
                $ControlBotones = $aspecto['Control_Botones'];
                $Observaciones_Control_Botones = $aspecto['Observaciones_Control_Botones'];

                $RevisionMovimientosAvance = $aspecto['Revision_Movimientos_Avance'];
                $Observaciones_Revision_Movimientos_Avance = $aspecto['Observaciones_Revision_Movimientos_Avance'];

                $RevisarMovimientosPolea = $aspecto['Revisar_Movimientos_Polea'];
                $Observaciones_Revisar_Movimientos_Polea = $aspecto['Observaciones_Revisar_Movimientos_Polea'];

                $RevisarGirosMotor = $aspecto['Revisar_Giros_Motor'];
                $Observaciones_Revisar_Giros_Motor = $aspecto['Observaciones_Revisar_Giros_Motor'];

                $LimpiezaClavijas = $aspecto['Limpieza_Clavijas'];
                $Observaciones_Limpieza_Clavijas = $aspecto['Observaciones_Limpieza_Clavijas'];

                $InteriorExteriorCarro = $aspecto['Interior_Exterior_Carro'];
                $Observaciones_InteriorExteriorCarro = $aspecto['Observaciones_InteriorExteriorCarro'];

                $EngrasarBastagos = $aspecto['Engrasar_Bastagos'];
                $Observaciones_Engrasar_Bastagos = $aspecto['Observaciones_Engrasar_Bastagos'];

                $RuidosExtranos = $aspecto['Ruidos_Extranos'];
                $Observaciones_Ruidos_Extranos = $aspecto['Observaciones_Ruidos_Extranos'];

                $InspeccionGeneralEquipo = $aspecto['Inspeccion_General_Equipo'];
                $Observaciones_Inspeccion_General_Equipo = $aspecto['Observaciones_Inspeccion_General_Equipo'];

                $EstadoConexionesQuitar = $aspecto['Estado_Conexiones_Quitar'];
                $Observaciones_Estado_Conexiones_Quitar = $aspecto['Observaciones_Estado_Conexiones_Quitar'];

                $horometro_inicial = $aspecto['Horometro_Inicial'];
                $Observaciones_horometro_inicial = $aspecto['Observaciones_Horometro_Inicial'];

                $horometro_final = $aspecto['Horometro_Final'];
                $observaciones_horometro_final = $aspecto['Observaciones_Horometro_Final'];

                $ObservacionesAdicionales = $aspecto['Observaciones_Adicionales'];
            

            ?>
            <!--TABLAS DE ASPECTOS A EVALUAR-->
                <tr>
                    <td>Controles/Botones</td>
                    <td <?php echo ($ControlBotones == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($ControlBotones == 'Bueno') ? '' : ''; ?></td>
                    <td <?php echo ($ControlBotones == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($ControlBotones == 'Malo') ? '' : ''; ?></td>
                    <td><?php echo $Observaciones_Control_Botones; ?></td>
                </tr> 

                <tr>
                    <td>Revisión Movimientos Avance</td>
                    <td <?php echo ($RevisionMovimientosAvance == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($RevisionMovimientosAvance == 'Bueno') ? '' : ''; ?></td>
                    <td <?php echo ($RevisionMovimientosAvance == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($RevisionMovimientosAvance == 'Malo') ? '' : ''; ?></td>
                    <td><?php echo $Observaciones_Revision_Movimientos_Avance; ?></td>
                </tr>
                
                <tr>
                    <td>Revisar Giros Motor</td>
                    <td <?php echo ($RevisarGirosMotor == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($RevisarGirosMotor == 'Bueno') ? '' : ''; ?></td>
                    <td <?php echo ($RevisarGirosMotor == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($RevisarGirosMotor == 'Malo') ? '' : ''; ?></td>
                    <td><?php echo $Observaciones_Revisar_Giros_Motor; ?></td>
                </tr>

                <tr>
                    <td>Revisar Movimientos Polea</td>
                    <td <?php echo ($RevisarMovimientosPolea == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($RevisarMovimientosPolea == 'Bueno') ? '' : ''; ?></td>
                    <td <?php echo ($RevisarMovimientosPolea == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($RevisarMovimientosPolea == 'Malo') ? '' : ''; ?></td>
                    <td><?php echo $Observaciones_Revisar_Movimientos_Polea; ?></td>
                </tr>

        </table>

                
        <h1>Aspectos a limpiar</h1>
        <table>
                <tr>
                    <th>Acciones a realizar</th>
                    <th>Sí</th>
                    <th>No</th>
                    <th>Observaciones</th>
                </tr>   

                <tr>
                    <td>Limpieza Clavijas</td>
                    <td <?php echo ($LimpiezaClavijas == 'Sí') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($LimpiezaClavijas == 'Sí') ? '' : ''; ?></td>
                    <td <?php echo ($LimpiezaClavijas == 'No') ? 'class="marca-x malo"' : ''; ?>><?php echo ($LimpiezaClavijas == 'No') ? '' : ''; ?></td>
                    <td><?php echo $Observaciones_Limpieza_Clavijas; ?></td>
                </tr>

                <tr>
                    <td>Interior/Exterior Carro</td>
                    <td <?php echo ($InteriorExteriorCarro == 'Sí') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($InteriorExteriorCarro == 'Sí') ? '' : ''; ?></td>
                    <td <?php echo ($InteriorExteriorCarro == 'No') ? 'class="marca-x malo"' : ''; ?>><?php echo ($InteriorExteriorCarro == 'No') ? '' : ''; ?></td>
                    <td><?php echo $Observaciones_InteriorExteriorCarro; ?></td>
                </tr>

                <tr>
                    <td>Engrasar Bastagos</td>
                    <td <?php echo ($EngrasarBastagos == 'Sí') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($EngrasarBastagos == 'Sí') ? '' : ''; ?></td>
                    <td <?php echo ($EngrasarBastagos == 'No') ? 'class="marca-x malo"' : ''; ?>><?php echo ($EngrasarBastagos == 'No') ? '' : ''; ?></td>
                    <td><?php echo $Observaciones_Engrasar_Bastagos; ?></td>
                </tr>

        </table>

        <h1>Antes de apagar</h1>

        <table>
                <tr>
                    <th>Acciones a realizar</th>
                    <th>Bueno</th>
                    <th>Malo</th>
                    <th>Observaciones</th>
                </tr>

                <tr>
                    <td>Inspección General de Equipo</td>
                    <td <?php echo ($InspeccionGeneralEquipo == 'Si') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($InspeccionGeneralEquipo == 'Si') ? '' : ''; ?></td>
                    <td <?php echo ($InspeccionGeneralEquipo == 'No') ? 'class="marca-x malo"' : ''; ?>><?php echo ($InspeccionGeneralEquipo == 'No') ? '' : ''; ?></td>
                    <td><?php echo $Observaciones_Inspeccion_General_Equipo; ?></td>
                </tr>

                <tr>
                    <td>Estado Conexiones Quitar</td>
                    <td <?php echo ($EstadoConexionesQuitar == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($EstadoConexionesQuitar == 'Bueno') ? '' : ''; ?></td>
                    <td <?php echo ($EstadoConexionesQuitar == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($EstadoConexionesQuitar == 'Malo') ? '' : ''; ?></td>
                    <td><?php echo $Observaciones_Estado_Conexiones_Quitar; ?></td>
                </tr>

                <tr>
                    <td>Ruidos Extraños</td>
                    <td <?php echo ($RuidosExtranos == 'Si') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($RuidosExtranos == 'Si') ? '' : ''; ?></td>
                    <td <?php echo ($RuidosExtranos == 'No') ? 'class="marca-x malo"' : ''; ?>><?php echo ($RuidosExtranos == 'No') ? '' : ''; ?></td>
                    <td><?php echo $Observaciones_Ruidos_Extranos; ?></td>
                </tr>

        </table>

        <h1>Horómetro</h1>
        <table>
            <tr>
                <th>Horómetro</th>
                <th>Horas</th>
                <th>Observaciones</th>

                <tr>
                    <td>Inicial</td>
                    <td><?php echo $horometro_inicial; ?></td>
                    <td><?php echo $Observaciones_horometro_inicial; ?></td>
                
                </tr>

                <tr>
                    <td>Final</td>
                    <td><?php echo $horometro_final; ?></td>
                    <td><?php echo $observaciones_horometro_final; ?></td>
                </tr>

            </tr>
        </table>

        <h1>Observaciones Adicionales</h1>

        <table>
            <tr>
                <td><?php echo $ObservacionesAdicionales; ?></td>
            </tr>
        </table>

            <?php
            }
            
        ?>
    

        <a href="../hilos_dazzini_principal.php" class="btn btn-secondary btn-lg"><i class="fas fa-arrow-left"></i> Volver</a>
    </div>

</body>

</html>
