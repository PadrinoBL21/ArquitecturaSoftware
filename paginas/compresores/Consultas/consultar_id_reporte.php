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

        <table class="table table-bordered table-hover">
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

        <table class="table table-bordered table-hover">
            <tr>
                <th>Aspecto a Evaluar</th>
                <th>Bueno</th>
                <th>Malo</th>
                <th>Observaciones</th>
            </tr>

            <?php
            //CONSULTA PARA OBTENER LOS ASPECTOS A EVALUAR
            $aspectos_query = mysqli_query($conn, "SELECT Estado_Equipo, Observaciones_Estado_Equipo, Nivel_Aceite_Motor, Observaciones_Nivel_Aceite_Motor
            , Nivel_Anticongelante, Observaciones_Nivel_Anticongelante
            , Bateria, Observaciones_Bateria, Nivel_Aceite_Unidad_Compresion, observaciones_Nivel_Aceite_Unidad_Compresion
            , Fugas, Observaciones_Fugas, Ruidos_Extranos, Observaciones_Ruidos_Extranos
            , Horometro_Inicial, Observaciones_Horometro_Inicial, Horometro_Final, Observaciones_Horometro_Final, Observaciones_Adicionales
            FROM Compresor WHERE id_reporte = $id_reporte"); 

            //DEFINICION DE VARIABLES
            while ($aspecto = mysqli_fetch_assoc($aspectos_query)) {
                $estado_equipo = $aspecto['Estado_Equipo'];
                $obserEstado_Equipo = $aspecto['Observaciones_Estado_Equipo'];

                $nivel_aceite_motor = $aspecto['Nivel_Aceite_Motor'];
                $observaciones_nivel_aceite_motor = $aspecto['Observaciones_Nivel_Aceite_Motor'];

                $nivel_anticongelante = $aspecto['Nivel_Anticongelante'];
                $observaciones_nivel_anticongelante = $aspecto['Observaciones_Nivel_Anticongelante'];

                $oestado_Nivel_Aceite_Unidad = $aspecto['Nivel_Aceite_Unidad_Compresion'];
                $observaciones_Nivel_Aceite_Unidad = $aspecto['observaciones_Nivel_Aceite_Unidad_Compresion'];

                $Fugas = $aspecto['Fugas'];
                $Observaciones_Fugas = $aspecto['Observaciones_Fugas'];

                $Ruidos_Extranos = $aspecto['Ruidos_Extranos'];
                $observaciones_Rudios_Extranos = $aspecto['Observaciones_Ruidos_Extranos'];

                $Bateria = $aspecto['Bateria'];
                $Observaciones_Bateria = $aspecto['Observaciones_Bateria'];
                
                $horometro_inicial = $aspecto['Horometro_Inicial'];
                $Observaciones_horometro_inicial = $aspecto['Observaciones_Horometro_Inicial'];

                $horometro_final = $aspecto['Horometro_Final'];
                $observaciones_horometro_final = $aspecto['Observaciones_Horometro_Final'];

                $observaciones_adicionales = $aspecto['Observaciones_Adicionales'];
            ?>
            <!--TABLAS DE ASPECTOS A EVALUAR-->
                <tr>
                    <td>Estado del Equipo</td>
                    <td <?php echo ($estado_equipo == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($estado_equipo == 'Bueno') ? '' : ''; ?></td>
                    <td <?php echo ($estado_equipo == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($estado_equipo == 'Malo') ? '' : ''; ?></td>
                    <td><?php echo $obserEstado_Equipo; ?></td>
                </tr>

                <tr>
                    <td>Nivel Aceite de Motor</td>
                    <td <?php echo ($nivel_aceite_motor == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($nivel_aceite_motor == 'Bueno') ? '' : ''; ?></td>
                    <td <?php echo ($nivel_aceite_motor == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($nivel_aceite_motor == 'Malo') ? '' : ''; ?></td>
                    <td><?php echo $observaciones_nivel_aceite_motor; ?></td>
                </tr>

                <tr> 
                    <td>Nivel Anticongelante</td>
                    <td <?php echo ($nivel_anticongelante == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($nivel_anticongelante == 'Bueno') ? '' : ''; ?></td>
                    <td <?php echo ($nivel_anticongelante == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($nivel_anticongelante == 'Malo') ? '' : ''; ?></td>
                    <td><?php echo $observaciones_nivel_anticongelante; ?></td>
                </tr>

                <tr>
                    <td>Nivel Aceite Unidad Compresion</td>
                    <td <?php echo ($oestado_Nivel_Aceite_Unidad == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($oestado_Nivel_Aceite_Unidad == 'Bueno') ? '' : ''; ?></td>
                    <td <?php echo ($oestado_Nivel_Aceite_Unidad == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($oestado_Nivel_Aceite_Unidad == 'Malo') ? '' : ''; ?></td>
                    <td><?php echo $observaciones_Nivel_Aceite_Unidad; ?></td>
                </tr>
                <tr>
                    <td>Fugas</td>
                    <td <?php echo ($Fugas == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($Fugas == 'Bueno') ? '' : ''; ?></td>
                    <td <?php echo ($Fugas == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($Fugas == 'Malo') ? '' : ''; ?></td>
                    <td><?php echo $Observaciones_Fugas; ?></td>
                </tr>
                <tr>
                    <td>Ruidos Extraños</td>
                    <td <?php echo ($Ruidos_Extranos == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($Ruidos_Extranos == 'Bueno') ? '' : ''; ?></td>
                    <td <?php echo ($Ruidos_Extranos == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($Ruidos_Extranos == 'Malo') ? '' : ''; ?></td>
                    <td><?php echo $observaciones_Rudios_Extranos; ?></td>
                </tr>


                <tr>
                    <td>Baterías</td>
                    <td <?php echo ($Bateria == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($Bateria == 'Bueno') ? '' : ''; ?></td>
                    <td <?php echo ($Bateria == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($Bateria == 'Malo') ? '' : ''; ?></td>
                    <td><?php echo $Observaciones_Bateria; ?></td>
                </tr>

               

        </table>

       

        <h1>Horómetro</h1>
        <table class="table table-bordered table-hover">
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

        <table class="table table-bordered table-hover">
            <h1>Observaciones Adicionales</h1>
            <tr>
                <td><?php echo $observaciones_adicionales; ?></td>
            </tr>
        </table>
        <!--Si el reporte es de turno check , Incluir las tablas de check de mantenimiento-->
                
            <?php
             }
            if ($data_consulta_individual['Turno'] == 'Check') {

                $query_consulta_individual = mysqli_query($conn, "SELECT 
            CambiarFiltros, Observaciones_CambiarFiltros, RevisarMangueras, Observaciones_RevisarMangueras,
            `RevisarSistemaElectrico(Marcha)`, `Observaciones_SistemaElectrico(Marcha)`,
            RevisarNivelesFluidoGeneral, Observaciones_RevisarNivelesFluidoGeneral, AveriasEncontradasMomentoServicio
            FROM CheckMantenimientoCompresores WHERE reporte_id = $id_reporte");

                
                //Definiciòn de variables

                while ($aspecto = mysqli_fetch_assoc($query_consulta_individual)) {
                    $CambiarFiltros = $aspecto['CambiarFiltros'];
                    $Observaciones_CambiarFiltros = $aspecto['Observaciones_CambiarFiltros']; // Corregido el nombre de la columna

                    $RevisarMangueras = $aspecto['RevisarMangueras'];
                    $Observaciones_RevisarMangueras = $aspecto['Observaciones_RevisarMangueras'];

                    $RevisarSistemaElectrico = $aspecto['RevisarSistemaElectrico(Marcha)'];
                    $Observaciones_SistemaElectrico = $aspecto['Observaciones_SistemaElectrico(Marcha)'];

                    $RevisarNivelesFluidoGeneral = $aspecto['RevisarNivelesFluidoGeneral'];
                    $Observaciones_RevisarNivelesFluidoGeneral = $aspecto['Observaciones_RevisarNivelesFluidoGeneral'];

                    $AveriasEncontradasMomentoServicio = $aspecto['AveriasEncontradasMomentoServicio'];
                ?>
                <h1>Check de Mantenimiento</h1>

                <table>
                    <tr>
                        <th>Aspecto a Evaluar</th>
                        <th>Sí</th>
                        <th>No</th>
                        <th>Observaciones</th>
                    </tr>

                    <tr>
                        <td>Cambiar Filtros</td>
                        <td <?php echo ($CambiarFiltros == 'Si') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($CambiarFiltros == 'Si') ? '' : ''; ?></td>
                        <td <?php echo ($CambiarFiltros == 'No') ? 'class="marca-x malo"' : ''; ?>><?php echo ($CambiarFiltros == 'No') ? '' : ''; ?></td>
                        <td><?php echo $Observaciones_CambiarFiltros; ?></td>
                    </tr>

                    <tr>
                        <td>Revisar Mangueras</td>
                        <td <?php echo ($RevisarMangueras == 'Si') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($RevisarMangueras == 'Si') ? '' : ''; ?></td>
                        <td <?php echo ($RevisarMangueras == 'No') ? 'class="marca-x malo"' : ''; ?>><?php echo ($RevisarMangueras == 'No') ? '' : ''; ?></td>
                        <td><?php echo $Observaciones_RevisarMangueras; ?></td>
                    </tr>

                    <tr>
                        <td>Revisar Sistema Eléctrico (Marcha)</td>
                        <td <?php echo ($RevisarSistemaElectrico == 'Si') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($RevisarSistemaElectrico == 'Si') ? '' : ''; ?></td>
                        <td <?php echo ($RevisarSistemaElectrico == 'No') ? 'class="marca-x malo"' : ''; ?>><?php echo ($RevisarSistemaElectrico == 'No') ? '' : ''; ?></td>
                        <td><?php echo $Observaciones_SistemaElectrico; ?></td>
                    </tr>

                    <tr>
                        <td>Revisar Niveles de Fluido General</td>
                        <td <?php echo ($RevisarNivelesFluidoGeneral == 'Si') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($RevisarNivelesFluidoGeneral == 'Si') ? '' : ''; ?></td>
                        <td <?php echo ($RevisarNivelesFluidoGeneral == 'No') ? 'class="marca-x malo"' : ''; ?>><?php echo ($RevisarNivelesFluidoGeneral == 'No') ? '' : ''; ?></td>
                        <td><?php echo $Observaciones_RevisarNivelesFluidoGeneral; ?></td>
                    </tr>
                </table>

                <table>
                    <h1>Averías Encontradas al Momento del Servicio</h1>
                    <tr>
                        <td><?php echo $AveriasEncontradasMomentoServicio; ?></td>
                    </tr>
                </table>
            <?php
                }
                
                
               //
            }
            ?>
        

        <a href="../compresores_principal.php" class="btn btn-secondary btn-lg"><i class="fas fa-arrow-left"></i> Volver</a>
    </div>

</body>

</html>
