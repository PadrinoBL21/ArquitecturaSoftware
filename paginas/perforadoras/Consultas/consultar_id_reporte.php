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
            Estado_Equipo, Nivel_Aceite_Centralina, Revisar_Conexiones, Arranque_Motor_Centralina,
            Revision_Bomba_Trabajando, Revision_Movimientos, Fugas, Ruidos_Extraños, Inspeccion_General_Equipo,
            Movimiento_Motor_Regreso, Estados_Conexiones_Quitar, Horometro_Inicial, Horometro_Final,

            Observaciones_Estado_Equipo, Observaciones_Nivel_Aceite_Centralina, Observaciones_Revisar_Conexiones,
            Observaciones_Arranque_Motor, Observaciones_Revision_Bomba, Observaciones_Revision_Movimientos, Observaciones_Fugas,
            Observaciones_Ruidos_Extraños, Observaciones_Inspeccion_General_Equipo, Observaciones_Movimiento_Motor_Regreso,
            Observaciones_Estado_Conexiones_Quitar, Observaciones_Horometro_Inicial, Observaciones_Horometro_Final, Observaciones_Adicionales
            FROM Perforadora WHERE id_reporte = $id_reporte"); 

            //DEFINICION DE VARIABLES
            while ($aspecto = mysqli_fetch_assoc($aspectos_query)) {

                $estado_equipo = $aspecto['Estado_Equipo'];
                $Observaciones_estado_equipo = $aspecto['Observaciones_Estado_Equipo'];

                $nivel_aceite_centralina = $aspecto['Nivel_Aceite_Centralina'];
                $Observaciones_nivel_aceite_centralina = $aspecto['Observaciones_Nivel_Aceite_Centralina'];

                $revisar_conexiones = $aspecto['Revisar_Conexiones'];
                $Observaciones_revisar_conexiones = $aspecto['Observaciones_Revisar_Conexiones'];

                $arranque_motor_centralina = $aspecto['Arranque_Motor_Centralina'];
                $Observaciones_arranque_motor_centralina = $aspecto['Observaciones_Arranque_Motor'];

                $revision_bomba_trabajando = $aspecto['Revision_Bomba_Trabajando'];
                $Observaciones_revision_bomba_trabajando = $aspecto['Observaciones_Revision_Bomba'];

                $revision_movimientos = $aspecto['Revision_Movimientos'];
                $Observaciones_revision_movimientos = $aspecto['Observaciones_Revision_Movimientos'];

                $fugas = $aspecto['Fugas'];
                $Observaciones_fugas = $aspecto['Observaciones_Fugas'];

                $ruidos_extraños = $aspecto['Ruidos_Extraños'];
                $Observaciones_ruidos_extraños = $aspecto['Observaciones_Ruidos_Extraños'];

                $inspeccion_general_equipo = $aspecto['Inspeccion_General_Equipo'];
                $Observaciones_inspeccion_general_equipo = $aspecto['Observaciones_Inspeccion_General_Equipo'];

                $movimiento_motor_regreso = $aspecto['Movimiento_Motor_Regreso'];
                $Observaciones_movimiento_motor_regreso = $aspecto['Observaciones_Movimiento_Motor_Regreso'];

                $estados_conexiones_quitar = $aspecto['Estados_Conexiones_Quitar'];
                $Observaciones_estados_conexiones_quitar = $aspecto['Observaciones_Estado_Conexiones_Quitar'];

                $horometro_inicial = $aspecto['Horometro_Inicial'];
                $Observaciones_horometro_inicial = $aspecto['Observaciones_Horometro_Inicial'];

                $horometro_final = $aspecto['Horometro_Final'];
                $observaciones_horometro_final = $aspecto['Observaciones_Horometro_Final'];

                $ObservacionesAdicionales = $aspecto['Observaciones_Adicionales'];


               
            ?>
            <!--TABLAS DE ASPECTOS A EVALUAR-->


            <tr>
                <td>Estado del equipo</td>
                <td <?php echo ($estado_equipo == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($estado_equipo == 'Bueno') ? '' : ''; ?></td>
                <td <?php echo ($estado_equipo == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($estado_equipo == 'Malo') ? '' : ''; ?></td>
                <td> <?php echo $Observaciones_estado_equipo; ?></td>
            </tr> 

            <tr>
                <td>Nivel Aceite De Centralina</td>
                <td <?php echo ($nivel_aceite_centralina == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($nivel_aceite_centralina == 'Bueno') ? '' : ''; ?></td>
                <td <?php echo ($nivel_aceite_centralina == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($nivel_aceite_centralina == 'Malo') ? '' : ''; ?></td>
                <td> <?php echo $Observaciones_nivel_aceite_centralina; ?></td>
            </tr> 

            <tr>
                <td>Revisar Conexiones</td>
                <td <?php echo ($revisar_conexiones == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($revisar_conexiones == 'Bueno') ? '' : ''; ?></td>
                <td <?php echo ($revisar_conexiones == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($revisar_conexiones == 'Malo') ? '' : ''; ?></td>
                <td> <?php echo $Observaciones_revisar_conexiones; ?></td>
            </tr> 
           

        </table>

                
        <h1>Revisión Máquina Encendida</h1>
        <table>
            <tr>
                    <th>Aspecto a Evaluar</th>
                    <th>Bueno</th>
                    <th>Malo</th>
                    <th>Observaciones</th>
            </tr>   

            <tr>
                <td>Arranque De Motor Centralina</td>
                <td <?php echo ($revisar_conexiones == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($revisar_conexiones == 'Bueno') ? '' : ''; ?></td>
                <td <?php echo ($revisar_conexiones == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($revisar_conexiones == 'Malo') ? '' : ''; ?></td>
                <td> <?php echo $Observaciones_revisar_conexiones; ?></td>
            </tr> 

            <tr>
                <td>Revision Bomba Trabajando</td>
                <td <?php echo ($revision_bomba_trabajando == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($revision_bomba_trabajando == 'Bueno') ? '' : ''; ?></td>
                <td <?php echo ($revision_bomba_trabajando == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($revision_bomba_trabajando == 'Malo') ? '' : ''; ?></td>
                <td> <?php echo $Observaciones_revision_bomba_trabajando; ?></td>
            </tr>

            <tr>
                <td>Revision Movimientos</td>
                <td <?php echo ($revision_movimientos == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($revision_movimientos == 'Bueno') ? '' : ''; ?></td>
                <td <?php echo ($revision_movimientos == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($revision_movimientos == 'Malo') ? '' : ''; ?></td>
                <td> <?php echo $Observaciones_revision_movimientos; ?></td>
            </tr>

                    

        </table>

        <h1>Revisión Antes De Apagar</h1>

        <table>
            <tr>
                    <th>Aspecto a Evaluar</th>
                    <th>Bueno</th>
                    <th>Malo</th>
                    <th>Observaciones</th>
            </tr>

            <tr>
                <td>Fugas</td>
                <td <?php echo ($fugas == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($fugas == 'Bueno') ? '' : ''; ?></td>
                <td <?php echo ($fugas == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($fugas == 'Malo') ? '' : ''; ?></td>
                <td> <?php echo $Observaciones_fugas; ?></td>
            </tr>

            <tr>
                <td>Ruidos Extraños</td>
                <td <?php echo ($ruidos_extraños == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($ruidos_extraños == 'Bueno') ? '' : ''; ?></td>
                <td <?php echo ($ruidos_extraños == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($ruidos_extraños == 'Malo') ? '' : ''; ?></td>
                <td> <?php echo $Observaciones_ruidos_extraños; ?></td>
            </tr>

            <tr>
                <td>Inspeccion General Equipo</td>
                <td <?php echo ($inspeccion_general_equipo == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($inspeccion_general_equipo == 'Bueno') ? '' : ''; ?></td>
                <td <?php echo ($inspeccion_general_equipo == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($inspeccion_general_equipo == 'Malo') ? '' : ''; ?></td>
                <td> <?php echo $Observaciones_inspeccion_general_equipo; ?></td>
            </tr>

            <tr>
                <td>Movimiento Motor Regreso</td>
                <td <?php echo ($movimiento_motor_regreso == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($movimiento_motor_regreso == 'Bueno') ? '' : ''; ?></td>
                <td <?php echo ($movimiento_motor_regreso == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($movimiento_motor_regreso == 'Malo') ? '' : ''; ?></td>
                <td> <?php echo $Observaciones_movimiento_motor_regreso; ?></td>
            </tr>

            <tr>
                <td>Estados Conexiones Quitar</td>
                <td <?php echo ($estados_conexiones_quitar == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($estados_conexiones_quitar == 'Bueno') ? '' : ''; ?></td>
                <td <?php echo ($estados_conexiones_quitar == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($estados_conexiones_quitar == 'Malo') ? '' : ''; ?></td>
                <td> <?php echo $Observaciones_estados_conexiones_quitar; ?></td>
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
    

        <a href="../perforadoras_principal.php" class="btn btn-secondary btn-lg"><i class="fas fa-arrow-left"></i> Volver</a>
    </div>

</body>

</html>
