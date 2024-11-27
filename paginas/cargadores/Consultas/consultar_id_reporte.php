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
            $aspectos_query = mysqli_query($conn, "SELECT Estado_Esqueleto, observaciones_estado_esqueleto, Nivel_Aceite_Motor, Observaciones_Nivel_Aceite_Motor
            , Nivel_Aceite_Hidraulico, Observaciones_Nivel_Aceite_Hidraulico, Nivel_Anticongelante, Observaciones_Nivel_Anticongelante
            , Baterias, Observaciones_Baterias, luces, observaciones_luces, Neumaticos_Presion_75LB, Observaciones_Neumaticos_Presion_75LB
            , Banda_Alternador_Ventilador, Observaciones_Banda_Alternador_Ventilador, Nivel_Aceite_Transmision_Maquina_Encendida, Observaciones_Nivel_Aceite_Maquina_Encendida
            , Fugas_Maquina_Encendida, Observaciones_Fugas_Maquina_Encendida, Frenos_Maquina_Trabajando, Observaciones_Frenos_Maquina_Trabajando
            , Presion_Motor_50_PSI_Maquina_Trabajando, Observaciones_Presion_Motor_50_PSI_Maquina_Trabajando, Temperatura_Motor_100_180_Maquina_Trabajando, Observaciones_Temperatura_Motor_100_180_Maquina_Trabajando
            , horometro_inicial, Observaciones_horometro_inicial, horometro_final, observaciones_horometro_final, ObservacionesAdicionales
            FROM Cargador WHERE id_reporte = $id_reporte"); 

            //DEFINICION DE VARIABLES
            while ($aspecto = mysqli_fetch_assoc($aspectos_query)) {
                $estado_esqueleto = $aspecto['Estado_Esqueleto'];
                $obserestado_esqueleto = $aspecto['observaciones_estado_esqueleto'];

                $nivel_aceite_motor = $aspecto['Nivel_Aceite_Motor'];
                $observaciones_nivel_aceite_motor = $aspecto['Observaciones_Nivel_Aceite_Motor'];

                $nivel_aceite_hidraulico = $aspecto['Nivel_Aceite_Hidraulico'];
                $observaciones_nivel_aceite_hidraulico = $aspecto['Observaciones_Nivel_Aceite_Hidraulico'];

                $nivel_anticongelante = $aspecto['Nivel_Anticongelante'];
                $observaciones_nivel_anticongelante = $aspecto['Observaciones_Nivel_Anticongelante'];

                $Baterias = $aspecto['Baterias'];
                $Observaciones_Baterias = $aspecto['Observaciones_Baterias'];

                $luces = $aspecto['luces'];
                $observaciones_luces = $aspecto['observaciones_luces'];

                $Neumaticos_Presion_75LB = $aspecto['Neumaticos_Presion_75LB'];
                $Observaciones_Neumaticos_Presion_75LB = $aspecto['Observaciones_Neumaticos_Presion_75LB'];

                $Banda_Alternador_Ventilador = $aspecto['Banda_Alternador_Ventilador'];
                $Observaciones_Banda_Alternador_Ventilador = $aspecto['Observaciones_Banda_Alternador_Ventilador'];

                $Nivel_Aceite_Transmision_Maquina_Encendida = $aspecto['Nivel_Aceite_Transmision_Maquina_Encendida'];
                $Observaciones_Nivel_Aceite_Transmision_Maquina_Encendida = $aspecto['Observaciones_Nivel_Aceite_Maquina_Encendida'];

                $Fugas_Maquina_Encendida = $aspecto['Fugas_Maquina_Encendida'];
                $Observaciones_Fugas_Maquina_Encendida = $aspecto['Observaciones_Fugas_Maquina_Encendida'];

                $Frenos_Maquina_Trabajando = $aspecto['Frenos_Maquina_Trabajando'];
                $Observaciones_Frenos_Maquina_Trabajando = $aspecto['Observaciones_Frenos_Maquina_Trabajando'];
                
                $Presion_Motor_50_PSI_Maquina_Trabajando = $aspecto['Presion_Motor_50_PSI_Maquina_Trabajando'];
                $Observaciones_Presion_Motor_50_PSI_Maquina_Trabajando = $aspecto['Observaciones_Presion_Motor_50_PSI_Maquina_Trabajando'];

                $Temperatura_Motor_100_180_Maquina_Trabajando = $aspecto['Temperatura_Motor_100_180_Maquina_Trabajando'];
                $Observaciones_Temperatura_Motor_100_180_Maquina_Trabajando = $aspecto['Observaciones_Temperatura_Motor_100_180_Maquina_Trabajando'];

                $horometro_inicial = $aspecto['horometro_inicial'];
                $Observaciones_horometro_inicial = $aspecto['Observaciones_horometro_inicial'];
                
                $horometro_final = $aspecto['horometro_final'];
                $observaciones_horometro_final = $aspecto['observaciones_horometro_final'];

                $ObservacionesAdicionales = $aspecto['ObservacionesAdicionales'];
            ?>
            <!--TABLAS DE ASPECTOS A EVALUAR-->
                <tr>
                    <td>Estado del esqueleto</td>
                    <td <?php echo ($estado_esqueleto == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($estado_esqueleto == 'Bueno') ? '' : ''; ?></td>
                    <td <?php echo ($estado_esqueleto == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($estado_esqueleto == 'Malo') ? '' : ''; ?></td>
                    <td><?php echo $obserestado_esqueleto; ?></td>
                </tr>

                <tr>
                    <td>Nivel Aceite de Motor</td>
                    <td <?php echo ($nivel_aceite_motor == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($nivel_aceite_motor == 'Bueno') ? '' : ''; ?></td>
                    <td <?php echo ($nivel_aceite_motor == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($nivel_aceite_motor == 'Malo') ? '' : ''; ?></td>
                    <td><?php echo $observaciones_nivel_aceite_motor; ?></td>
                </tr>

                <tr> 
                    <td>Nivel Aceite hidráulico</td>
                    <td <?php echo ($nivel_aceite_hidraulico == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($nivel_aceite_hidraulico == 'Bueno') ? '' : ''; ?></td>
                    <td <?php echo ($nivel_aceite_hidraulico == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($nivel_aceite_hidraulico == 'Malo') ? '' : ''; ?></td>
                    <td><?php echo $observaciones_nivel_aceite_hidraulico; ?></td>
                </tr>

                <tr>
                    <td>Nivel Anticongelante</td>
                    <td <?php echo ($nivel_anticongelante == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($nivel_anticongelante == 'Bueno') ? '' : ''; ?></td>
                    <td <?php echo ($nivel_anticongelante == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($nivel_anticongelante == 'Malo') ? '' : ''; ?></td>
                    <td><?php echo $observaciones_nivel_anticongelante; ?></td>
                </tr>

                <tr>
                    <td>Baterías</td>
                    <td <?php echo ($Baterias == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($Baterias == 'Bueno') ? '' : ''; ?></td>
                    <td <?php echo ($Baterias == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($Baterias == 'Malo') ? '' : ''; ?></td>
                    <td><?php echo $Observaciones_Baterias; ?></td>
                </tr>

                <tr>
                    <td>Luces</td>
                    <td <?php echo ($luces == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($luces == 'Bueno') ? '' : ''; ?></td>
                    <td <?php echo ($luces == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($luces == 'Malo') ? '' : ''; ?></td>
                    <td><?php echo $observaciones_luces; ?></td>
                </tr>

                <tr>
                    <td>Neumáticos Presión 75LB</td>
                    <td <?php echo ($Neumaticos_Presion_75LB == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($Neumaticos_Presion_75LB == 'Bueno') ? '' : ''; ?></td>
                    <td <?php echo ($Neumaticos_Presion_75LB == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($Neumaticos_Presion_75LB == 'Malo') ? '' : ''; ?></td>
                    <td><?php echo $Observaciones_Neumaticos_Presion_75LB; ?></td>
                </tr>

                <tr>
                    <td>Banda de Alternador y Ventilador</td>
                    <td <?php echo ($Banda_Alternador_Ventilador == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($Banda_Alternador_Ventilador == 'Bueno') ? '' : ''; ?></td>
                    <td <?php echo ($Banda_Alternador_Ventilador == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($Banda_Alternador_Ventilador == 'Malo') ? '' : ''; ?></td>
                    <td><?php echo $Observaciones_Banda_Alternador_Ventilador; ?></td>
                </tr>

        </table>

                
        <h1>Evaluación con Máquina Encendida</h1>
        <table>
                <tr>
                    <th>Aspecto a Evaluar</th>
                    <th>Bueno</th>
                    <th>Malo</th>
                    <th>Observaciones</th>
                </tr>   

                <tr>
                    <td>Nivel Aceite Transmision</td>
                    <td <?php echo ($Nivel_Aceite_Transmision_Maquina_Encendida == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($Nivel_Aceite_Transmision_Maquina_Encendida == 'Bueno') ? '' : ''; ?></td>
                    <td <?php echo ($Nivel_Aceite_Transmision_Maquina_Encendida == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($Nivel_Aceite_Transmision_Maquina_Encendida == 'Malo') ? '' : ''; ?></td>
                    <td><?php echo $Observaciones_Nivel_Aceite_Transmision_Maquina_Encendida; ?></td>
                </tr>
                
                <tr>
                    <td>Fugas Máquina Trabajando</td>
                    <td <?php echo ($Fugas_Maquina_Encendida == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($Fugas_Maquina_Encendida == 'Bueno') ? '' : ''; ?></td>
                    <td <?php echo ($Fugas_Maquina_Encendida == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($Fugas_Maquina_Encendida == 'Malo') ? '' : ''; ?></td>
                    <td><?php echo $Observaciones_Fugas_Maquina_Encendida; ?></td>
                </tr>

        </table>

        <h1>Evaluación con Máquina Trabajando</h1>

        <table>
                <tr>
                    <th>Aspecto a Evaluar</th>
                    <th>Bueno</th>
                    <th>Malo</th>
                    <th>Observaciones</th>
                </tr>

                <tr>
                    <td>Frenos Máquina Trabajando</td>
                    <td <?php echo ($Frenos_Maquina_Trabajando == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($Frenos_Maquina_Trabajando == 'Bueno') ? '' : ''; ?></td>
                    <td <?php echo ($Frenos_Maquina_Trabajando == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($Frenos_Maquina_Trabajando == 'Malo') ? '' : ''; ?></td>
                    <td><?php echo $Observaciones_Frenos_Maquina_Trabajando; ?></td>
                </tr>

                <tr>
                    <td>Presión Motor 50 PSI Maquina Trabajando</td>
                    <td <?php echo ($Presion_Motor_50_PSI_Maquina_Trabajando == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($Presion_Motor_50_PSI_Maquina_Trabajando == 'Bueno') ? '' : ''; ?></td>
                    <td <?php echo ($Presion_Motor_50_PSI_Maquina_Trabajando == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($Presion_Motor_50_PSI_Maquina_Trabajando == 'Malo') ? '' : ''; ?></td>
                    <td><?php echo $Observaciones_Presion_Motor_50_PSI_Maquina_Trabajando; ?></td>
                </tr>

                <tr>
                    <td>Temperatura de Motor 100-180°C</td>
                    <td <?php echo ($Temperatura_Motor_100_180_Maquina_Trabajando == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($Temperatura_Motor_100_180_Maquina_Trabajando == 'Bueno') ? '' : ''; ?></td>
                    <td <?php echo ($Temperatura_Motor_100_180_Maquina_Trabajando == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($Temperatura_Motor_100_180_Maquina_Trabajando == 'Malo') ? '' : ''; ?></td>
                    <td><?php echo $Observaciones_Temperatura_Motor_100_180_Maquina_Trabajando; ?></td>
                </tr>
        </table>

        <h1>Horómetro</h1>
        <table>
            <tr>
                <th>Horómetro</th>
                <th>Horas</th>
                <th>Observaciones</th>

                

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
                `EngrasarTazas_Pernos_Gatos`, Observaciones_EngrasarTazasPernosGatos, RevisarSistemaElectrico_Marcha, Observaciones_RevisarSistemaElectrico,
                RevisarSistema_Avance, Observaciones_RevisarSistemaAvance, RevisarNivelesFluidoGeneral, Observaciones_RevisarNivelesFluidoGeneral,
                AveriasEncontradasMomento
                FROM CheckMantenimientoCargadores WHERE reporte_id = $id_reporte");
            

            

            //Definicion de variables
           
            while ($aspecto = mysqli_fetch_assoc($query_consulta_individual)) {
                $CambiarFiltros = $aspecto['CambiarFiltros'];
                $Observaciones_CambiarFiltros = $aspecto['Observaciones_CambiarFiltros'];

                $RevisarMangueras = $aspecto['RevisarMangueras'];
                $Observaciones_RevisarMangueras = $aspecto['Observaciones_RevisarMangueras'];

                $EngrasarTazas_Pernos_Gatos = $aspecto['EngrasarTazas_Pernos_Gatos'];
                $Observaciones_EngrasarTazasPernosGatos = $aspecto['Observaciones_EngrasarTazasPernosGatos'];

                $RevisarSistemaElectrico_Marcha = $aspecto['RevisarSistemaElectrico_Marcha'];
                $Observaciones_RevisarSistemaElectrico = $aspecto['Observaciones_RevisarSistemaElectrico'];

                $RevisarSistema_Avance = $aspecto['RevisarSistema_Avance'];
                $Observaciones_RevisarSistemaAvance = $aspecto['Observaciones_RevisarSistemaAvance'];

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
                        <td>Engrasar tazas, pernos y gatos</td>
                        <td <?php echo ($EngrasarTazas_Pernos_Gatos == 'Si') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($EngrasarTazas_Pernos_Gatos == 'Si') ? '' : ''; ?></td>
                        <td <?php echo ($EngrasarTazas_Pernos_Gatos == 'No') ? 'class="marca-x malo"' : ''; ?>><?php echo ($EngrasarTazas_Pernos_Gatos == 'No') ? '' : ''; ?></td>
                        <td><?php echo $Observaciones_EngrasarTazasPernosGatos; ?></td>
                    </tr>

                    <tr>
                        <td>Revisar sistema eléctrico (Marcha)</td>
                        <td <?php echo ($RevisarSistemaElectrico_Marcha == 'Si') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($RevisarSistemaElectrico_Marcha == 'Si') ? '' : ''; ?></td>
                        <td <?php echo ($RevisarSistemaElectrico_Marcha == 'No') ? 'class="marca-x malo"' : ''; ?>><?php echo ($RevisarSistemaElectrico_Marcha == 'No') ? '' : ''; ?></td>
                        <td><?php echo $Observaciones_RevisarSistemaElectrico; ?></td>
                    </tr>

                    <tr>
                        <td>Revisar sistema de avance</td>
                        <td <?php echo ($RevisarSistema_Avance == 'Si') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($RevisarSistema_Avance == 'Si') ? '' : ''; ?></td>
                        <td <?php echo ($RevisarSistema_Avance == 'No') ? 'class="marca-x malo"' : ''; ?>><?php echo ($RevisarSistema_Avance == 'No') ? '' : ''; ?></td>
                        <td><?php echo $Observaciones_RevisarSistemaAvance; ?></td>
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

                <h1>Averias encontradas en el momento</h1>
                <table>                    
                    <tr>
                        <td><?php echo $AveriasEncontradasMomento; ?></td>
                    </tr>
                </table>

          
                <?php 
            }
        ?>
    

        <a href="../cargadores_principal.php" class="btn btn-secondary btn-lg"><i class="fas fa-arrow-left"></i> Volver</a>
    </div>

</body>

</html>
