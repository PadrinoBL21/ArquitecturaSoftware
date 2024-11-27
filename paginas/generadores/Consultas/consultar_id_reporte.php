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
            Estado_Equipo, Nivel_Aceite_Motor, Nivel_Anticongelante, Baterias, Ruidos_Extranos,
            Fugas, Horometro_Inicial, Horometro_Final,
            observaciones_Estado_Equipo, observaciones_Nivel_Aceite_Motor, observaciones_Nivel_Anticongelante, 
            observaciones_Baterias, observaciones_Ruidos_Extranos, observaciones_Fugas, 
            observaciones_Horometro_Inicial, observaciones_Horometro_Final, observaciones_Adicionales
            FROM Generador WHERE id_reporte = $id_reporte"); 

            //DEFINICION DE VARIABLES
            while ($aspecto = mysqli_fetch_assoc($aspectos_query)) {

                $estado_equipo = $aspecto['Estado_Equipo'];
                $observaciones_estado_equipo = $aspecto['observaciones_Estado_Equipo'];

                $nivel_aceite_motor = $aspecto['Nivel_Aceite_Motor'];
                $observaciones_nivel_aceite_motor = $aspecto['observaciones_Nivel_Aceite_Motor'];

                $nivel_anticongelante = $aspecto['Nivel_Anticongelante'];
                $observaciones_nivel_anticongelante = $aspecto['observaciones_Nivel_Anticongelante'];

                $Baterias = $aspecto['Baterias'];
                $Observaciones_Baterias = $aspecto['observaciones_Baterias'];

                $ruidos_extranos = $aspecto['Ruidos_Extranos'];
                $observaciones_ruidos_extranos = $aspecto['observaciones_Ruidos_Extranos'];

                $fugas = $aspecto['Fugas'];
                $observaciones_fugas = $aspecto['observaciones_Fugas'];

                $horometro_inicial = $aspecto['Horometro_Inicial'];
                $Observaciones_horometro_inicial = $aspecto['observaciones_Horometro_Inicial'];

                $horometro_final = $aspecto['Horometro_Final'];
                $observaciones_horometro_final = $aspecto['observaciones_Horometro_Final'];

                $ObservacionesAdicionales = $aspecto['observaciones_Adicionales'];


                
            ?>
            <!--TABLAS DE ASPECTOS A EVALUAR-->
            <tr>
                <td>Estado del equipo</td>
                <td <?php echo ($estado_equipo == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($estado_equipo == 'Bueno') ? '' : ''; ?></td>
                <td <?php echo ($estado_equipo == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($estado_equipo == 'Malo') ? '' : ''; ?></td>
                <td><?php echo $observaciones_estado_equipo; ?></td>
            </tr>

            <tr>
                <td>Nivel de aceite del motor</td>
                <td <?php echo ($nivel_aceite_motor == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($nivel_aceite_motor == 'Bueno') ? '' : ''; ?></td>
                <td <?php echo ($nivel_aceite_motor == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($nivel_aceite_motor == 'Malo') ? '' : ''; ?></td>
                <td><?php echo $observaciones_nivel_aceite_motor; ?></td>
            </tr>

            <tr>
                <td>Nivel de anticongelante</td>
                <td <?php echo ($nivel_anticongelante == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($nivel_anticongelante == 'Bueno') ? '' : ''; ?></td>
                <td <?php echo ($nivel_anticongelante == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($nivel_anticongelante == 'Malo') ? '' : ''; ?></td>
                <td><?php echo $observaciones_nivel_anticongelante; ?></td>
            </tr>

            <tr>
                <td>Baterias</td>
                <td <?php echo ($Baterias == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($Baterias == 'Bueno') ? '' : ''; ?></td>
                <td <?php echo ($Baterias == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($Baterias == 'Malo') ? '' : ''; ?></td>
                <td><?php echo $Observaciones_Baterias; ?></td>
            </tr>

            <tr>
                <td>Fugas</td>
                <td <?php echo ($fugas == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($fugas == 'Bueno') ? '' : ''; ?></td>
                <td <?php echo ($fugas == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($fugas == 'Malo') ? '' : ''; ?></td>
                <td><?php echo $observaciones_fugas; ?></td>
            </tr>

            <tr> 
                <td>Ruidos extraños</td>
                <td <?php echo ($ruidos_extranos == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($ruidos_extranos == 'Bueno') ? '' : ''; ?></td>
                <td <?php echo ($ruidos_extranos == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($ruidos_extranos == 'Malo') ? '' : ''; ?></td>
                <td><?php echo $observaciones_ruidos_extranos; ?></td>
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


        <!--Si el reporte es de turno check , Incluir las tablas de check de mantenimiento-->
                
            <?php
            }
            
               
            //Si el reporte es de turno check , Incluir las tablas de check de mantenimiento
            
            if ($data_consulta_individual['Turno'] == 'Check') {
                
                //consulta para obtener datos de la tabla CheckMantenimientoCompresores con el mismo id_reporte
                $query_consulta_individual = mysqli_query($conn, "SELECT 
                CambiarFiltros, Observaciones_CambiarFiltros, RevisarMangueras, Observaciones_RevisarMangueras,
                RevisarSistemaElectrico_Marcha, Observaciones_RevisarSistemaElectrico,
                RevisarNivelesFluidoGeneral, Observaciones_RevisarNivelesFluidoGeneral,
                AveriasEncontradasMomento
                FROM CheckMantenimientoGeneradores WHERE id_reporte = $id_reporte");
            

            

            //Definicion de variables
           
            while ($aspecto = mysqli_fetch_assoc($query_consulta_individual)) {
                $CambiarFiltros = $aspecto['CambiarFiltros'];
                $Observaciones_CambiarFiltros = $aspecto['Observaciones_CambiarFiltros'];

                $RevisarMangueras = $aspecto['RevisarMangueras'];
                $Observaciones_RevisarMangueras = $aspecto['Observaciones_RevisarMangueras'];

                $RevisarSistemaElectrico_Marcha = $aspecto['RevisarSistemaElectrico_Marcha'];
                $Observaciones_RevisarSistemaElectrico = $aspecto['Observaciones_RevisarSistemaElectrico'];

                $RevisarNivelesFluidoGeneral = $aspecto['RevisarNivelesFluidoGeneral'];
                $Observaciones_RevisarNivelesFluidoGeneral = $aspecto['Observaciones_RevisarNivelesFluidoGeneral'];

                $AveriasEncontradasMomento = $aspecto['AveriasEncontradasMomento'];
            

                ?>
                <h1>Check de mantenimiento</h1>
                
                <table> 
                    <tr>
                        <th>Aspecto a Evaluar</th>
                        <th>Sí</th>
                        <th>No</th>
                        <th>Observaciones</th>
                    </tr>

                    <tr>
                        <td>Cambiar filtros</td>
                        <td <?php echo ($CambiarFiltros == 'Si') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($CambiarFiltros == 'Si') ? '' : ''; ?></td>
                        <td <?php echo ($CambiarFiltros == 'No') ? 'class="marca-x malo"' : ''; ?>><?php echo ($CambiarFiltros == 'No') ? '' : ''; ?></td>
                        <td><?php echo $Observaciones_CambiarFiltros; ?></td>
                    </tr>

                    <tr>
                        <td>Revisar mangueras</td>
                        <td <?php echo ($RevisarMangueras == 'Si') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($RevisarMangueras == 'Si') ? '' : ''; ?></td>
                        <td <?php echo ($RevisarMangueras == 'No') ? 'class="marca-x malo"' : ''; ?>><?php echo ($RevisarMangueras == 'No') ? '' : ''; ?></td>
                        <td><?php echo $Observaciones_RevisarMangueras; ?></td>
                    </tr>

                    <tr>
                        <td>Revisar sistema eléctrico (Marcha)</td>
                        <td <?php echo ($RevisarSistemaElectrico_Marcha == 'Si') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($RevisarSistemaElectrico_Marcha == 'Si') ? '' : ''; ?></td>
                        <td <?php echo ($RevisarSistemaElectrico_Marcha == 'No') ? 'class="marca-x malo"' : ''; ?>><?php echo ($RevisarSistemaElectrico_Marcha == 'No') ? '' : ''; ?></td>
                        <td><?php echo $Observaciones_RevisarSistemaElectrico; ?></td>
                    </tr>

                    <tr>
                        <td>Revisar niveles de fluido en general</td>
                        <td <?php echo ($RevisarNivelesFluidoGeneral == 'Si') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($RevisarNivelesFluidoGeneral == 'Si') ? '' : ''; ?></td>
                        <td <?php echo ($RevisarNivelesFluidoGeneral == 'No') ? 'class="marca-x malo"' : ''; ?>><?php echo ($RevisarNivelesFluidoGeneral == 'No') ? '' : ''; ?></td>
                        <td><?php echo $Observaciones_RevisarNivelesFluidoGeneral; ?></td>
                    </tr>

                    

                    <?php
                     }
                    ?> 
                </table>

                <h1>Averías encontradas en el momento</h1>
                <table>                    
                    <tr>
                        <td><?php echo $AveriasEncontradasMomento; ?></td>
                    </tr>
                </table>

          
                <?php 
            }
        ?>
    </table>

        <a href="../generadores_principal.php" class="btn btn-secondary btn-lg"><i class="fas fa-arrow-left"></i> Volver</a>
    </div>

</body>

</html>
