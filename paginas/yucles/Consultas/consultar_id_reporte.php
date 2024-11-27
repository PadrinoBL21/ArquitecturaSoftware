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
            Estado_Esqueleto, Nivel_Aceite_Motor, Nivel_Aceite_Hidraulico, Nivel_Anticongelante, Baterias, Luces,
            Neumaticos_Presion_70LB, Banda_Alternador_Ventilador, Nivel_Aceite_Transmision, Fugas, Frenos,
            Temperatura_Motor_100_180, Presion_Motor_50_PSI, Horometro_Inicial, Horometro_Final, 
            Observaciones_Estado_Esqueleto, Observaciones_Nivel_Aceite_Motor, Observaciones_Nivel_Aceite_Hidraulico,
            Observaciones_Nivel_Anticongelante, Observaciones_Baterias, Observaciones_Luces,
            Observaciones_Neumaticos_Presion_70LB, Observaciones_Banda_Alternador_Ventilador, Observaciones_Nivel_Aceite_Transmision,
            Observaciones_Fugas, Observaciones_Frenos, Observaciones_Presion_Motor_50_PSI, Observaciones_Temperatura_Motor_100_180,
            Observaciones_Horometro_Inicial, Observaciones_Horometro_Final, Observaciones_Adicionales
            FROM Yucle WHERE id_reporte = $id_reporte"); 

            //DEFINICION DE VARIABLES
            while ($aspecto = mysqli_fetch_assoc($aspectos_query)) {
               $Estado_Esqueleto = $aspecto['Estado_Esqueleto'];
               $Observaciones_Estado_Esqueleto = $aspecto['Observaciones_Estado_Esqueleto'];

                $Nivel_Aceite_Motor = $aspecto['Nivel_Aceite_Motor'];
                $Observaciones_Nivel_Aceite_Motor = $aspecto['Observaciones_Nivel_Aceite_Motor'];

                $Nivel_Aceite_Hidraulico = $aspecto['Nivel_Aceite_Hidraulico'];
                $Observaciones_Nivel_Aceite_Hidraulico = $aspecto['Observaciones_Nivel_Aceite_Hidraulico'];

                $Nivel_Anticongelante = $aspecto['Nivel_Anticongelante'];
                $Observaciones_Nivel_Anticongelante = $aspecto['Observaciones_Nivel_Anticongelante'];

                $Baterias = $aspecto['Baterias'];
                $Observaciones_Baterias = $aspecto['Observaciones_Baterias'];

                $Luces = $aspecto['Luces'];
                $Observaciones_Luces = $aspecto['Observaciones_Luces'];

                $Neumaticos_Presion_70LB = $aspecto['Neumaticos_Presion_70LB'];
                $Observaciones_Neumaticos_Presion_70LB = $aspecto['Observaciones_Neumaticos_Presion_70LB'];

                $Banda_Alternador_Ventilador = $aspecto['Banda_Alternador_Ventilador'];
                $Observaciones_Banda_Alternador_Ventilador =  $aspecto['Observaciones_Banda_Alternador_Ventilador'];

                $Nivel_Aceite_Transmision = $aspecto['Nivel_Aceite_Transmision'];
                $Observaciones_Nivel_Aceite_Transmision = $aspecto['Observaciones_Nivel_Aceite_Transmision'];

                $Fugas = $aspecto['Fugas'];
                $Observaciones_Fugas = $aspecto['Observaciones_Fugas'];

                $Frenos = $aspecto['Frenos'];
                $Observaciones_Frenos = $aspecto['Observaciones_Frenos'];

                $Presion_Motor_50_PSI = $aspecto['Presion_Motor_50_PSI'];
                $Observaciones_Presion_Motor_50_PSI = $aspecto['Observaciones_Presion_Motor_50_PSI'];

                $Temperatura_Motor_100_180 = $aspecto['Temperatura_Motor_100_180'];
                $Observaciones_Temperatura_Motor_100_180 = $aspecto['Observaciones_Temperatura_Motor_100_180'];

                $Horometro_Inicial = $aspecto['Horometro_Inicial'];
                $Observaciones_Horometro_Inicial = $aspecto['Observaciones_Horometro_Inicial'];

                $Horometro_Final = $aspecto['Horometro_Final'];
                $Observaciones_Horometro_Final = $aspecto['Observaciones_Horometro_Final'];

                $Averias_Encontradas = $aspecto['Observaciones_Adicionales'];
      
            ?>
            <!--TABLAS DE ASPECTOS A EVALUAR-->
            <tr>
                <td>Estado del Esqueleto</td>
                <td <?php echo ($aspecto['Estado_Esqueleto'] == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($aspecto['Estado_Esqueleto'] == 'Bueno') ? '' : ''; ?></td>
                <td <?php echo ($aspecto['Estado_Esqueleto'] == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($aspecto['Estado_Esqueleto'] == 'Malo') ? '' : ''; ?></td>
                <td><?php echo $aspecto['Observaciones_Estado_Esqueleto']; ?></td>
            </tr>

            <tr>
                <td>Nivel Aceite de Motor</td>
                <td <?php echo ($aspecto['Nivel_Aceite_Motor'] == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($aspecto['Nivel_Aceite_Motor'] == 'Bueno') ? '' : ''; ?></td>
                <td <?php echo ($aspecto['Nivel_Aceite_Motor'] == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($aspecto['Nivel_Aceite_Motor'] == 'Malo') ? '' : ''; ?></td>
                <td><?php echo $aspecto['Observaciones_Nivel_Aceite_Motor']; ?></td>
            </tr>

            <tr>
                <td>Nivel Aceite Hidráulico</td>
                <td <?php echo ($aspecto['Nivel_Aceite_Hidraulico'] == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($aspecto['Nivel_Aceite_Hidraulico'] == 'Bueno') ? '' : ''; ?></td>
                <td <?php echo ($aspecto['Nivel_Aceite_Hidraulico'] == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($aspecto['Nivel_Aceite_Hidraulico'] == 'Malo') ? '' : ''; ?></td>
                <td><?php echo $aspecto['Observaciones_Nivel_Aceite_Hidraulico']; ?></td>
            </tr>

            <tr>
                <td>Nivel de Anticongelante</td>
                <td <?php echo ($aspecto['Nivel_Anticongelante'] == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($aspecto['Nivel_Anticongelante'] == 'Bueno') ? '' : ''; ?></td>
                <td <?php echo ($aspecto['Nivel_Anticongelante'] == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($aspecto['Nivel_Anticongelante'] == 'Malo') ? '' : ''; ?></td>
                <td><?php echo $aspecto['Observaciones_Nivel_Anticongelante']; ?></td>
            </tr>

            <tr>
                <td>Baterías</td>
                <td <?php echo ($aspecto['Baterias'] == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($aspecto['Baterias'] == 'Bueno') ? '' : ''; ?></td>
                <td <?php echo ($aspecto['Baterias'] == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($aspecto['Baterias'] == 'Malo') ? '' : ''; ?></td>
                <td><?php echo $aspecto['Observaciones_Baterias']; ?></td>
            </tr>

            <tr>
                <td>Luces</td>
                <td <?php echo ($aspecto['Luces'] == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($aspecto['Luces'] == 'Bueno') ? '' : ''; ?></td>
                <td <?php echo ($aspecto['Luces'] == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($aspecto['Luces'] == 'Malo') ? '' : ''; ?></td>
                <td><?php echo $aspecto['Observaciones_Luces']; ?></td>
            </tr>

            <tr>
                <td>Neumáticos Presión 70LB</td>
                <td <?php echo ($aspecto['Neumaticos_Presion_70LB'] == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($aspecto['Neumaticos_Presion_70LB'] == 'Bueno') ? '' : ''; ?></td>
                <td <?php echo ($aspecto['Neumaticos_Presion_70LB'] == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($aspecto['Neumaticos_Presion_70LB'] == 'Malo') ? '' : ''; ?></td>
                <td><?php echo $aspecto['Observaciones_Neumaticos_Presion_70LB']; ?></td>
            </tr>

            <tr>
                <td>Banda Alternador Ventilador</td>
                <td <?php echo ($aspecto['Banda_Alternador_Ventilador'] == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($aspecto['Banda_Alternador_Ventilador'] == 'Bueno') ? '' : ''; ?></td>
                <td <?php echo ($aspecto['Banda_Alternador_Ventilador'] == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($aspecto['Banda_Alternador_Ventilador'] == 'Malo') ? '' : ''; ?></td>
                <td><?php echo $aspecto['Observaciones_Banda_Alternador_Ventilador']; ?></td>
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
                    <td>Nivel Aceite Transmisión</td>
                    <td <?php echo ($aspecto['Nivel_Aceite_Transmision'] == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($aspecto['Nivel_Aceite_Transmision'] == 'Bueno') ? '' : ''; ?></td>
                    <td <?php echo ($aspecto['Nivel_Aceite_Transmision'] == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($aspecto['Nivel_Aceite_Transmision'] == 'Malo') ? '' : ''; ?></td>
                    <td><?php echo $aspecto['Observaciones_Nivel_Aceite_Transmision']; ?></td>
                </tr>

                <tr>
                    <td>Fugas</td>
                    <td <?php echo ($aspecto['Fugas'] == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($aspecto['Fugas'] == 'Bueno') ? '' : ''; ?></td>
                    <td <?php echo ($aspecto['Fugas'] == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($aspecto['Fugas'] == 'Malo') ? '' : ''; ?></td>
                    <td><?php echo $aspecto['Observaciones_Fugas']; ?></td>
                </tr>

        </table>

        <h1>Revisión Máquina trabajando</h1>

        <table>
                <tr>
                    <th>Aspecto a Evaluar</th>
                    <th>Bueno</th>
                    <th>Malo</th>
                    <th>Observaciones</th>
                </tr>

                
                <tr>
                    <td>Frenos</td>
                    <td <?php echo ($aspecto['Frenos'] == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($aspecto['Frenos'] == 'Bueno') ? '' : ''; ?></td>
                    <td <?php echo ($aspecto['Frenos'] == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($aspecto['Frenos'] == 'Malo') ? '' : ''; ?></td>
                    <td><?php echo $aspecto['Observaciones_Frenos']; ?></td>
                </tr>
 
                <tr>
                    <td>Presión Motor 50 PSI</td>
                    <td <?php echo ($aspecto['Presion_Motor_50_PSI'] == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($aspecto['Presion_Motor_50_PSI'] == 'Bueno') ? '' : ''; ?></td>
                    <td <?php echo ($aspecto['Presion_Motor_50_PSI'] == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($aspecto['Presion_Motor_50_PSI'] == 'Malo') ? '' : ''; ?></td>
                    <td><?php echo $aspecto['Observaciones_Presion_Motor_50_PSI']; ?></td>
                </tr>

                <tr>
                    <td>Temperatura Motor 100-180</td>
                    <td <?php echo ($aspecto['Temperatura_Motor_100_180'] == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($aspecto['Temperatura_Motor_100_180'] == 'Bueno') ? '' : ''; ?></td>
                    <td <?php echo ($aspecto['Temperatura_Motor_100_180'] == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($aspecto['Temperatura_Motor_100_180'] == 'Malo') ? '' : ''; ?></td>
                    <td><?php echo $aspecto['Observaciones_Temperatura_Motor_100_180']; ?></td>
                </tr>

               


        </table>

        <h1>Horómetro</h1>
        <table>
            <tr>
                <th>Horómetro</th>
                <th>Horas</th>
                <th>Observaciones</th>
            </tr>

            <tr>
                <td>Horómetro inicial</td>
                <td><?php echo $Horometro_Inicial; ?></td>
                <td><?php echo $Observaciones_Horometro_Inicial; ?></td>
            </tr>

            <tr>
                <td>Horómetro final</td>
                <td><?php echo $Horometro_Final; ?></td>
                <td><?php echo $Observaciones_Horometro_Final; ?></td>
            </tr>

        </table>

        <h1>Averías encontradas</h1>

        <table>
            <tr>
                <td><?php echo $Averias_Encontradas; ?></td>
            </tr>
        </table>    

            <?php
            }
            
            ?>



            <?php
            //check
            if ($data_consulta_individual['Turno'] == 'Check') {

    $query_consulta_individual = mysqli_query($conn, "SELECT * FROM CheckMantenimientoYucle WHERE reporte_id = $id_reporte");

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

            <h1>Check de Mantenimiento</h1>

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
    
            </table>

            <h1>Averias encontradas en el momento del servicio</h1>
                <table>                    
                    <tr>
                        <td><?php echo $AveriasEncontradasMomento; ?></td>
                    </tr>
                </table>

            <?php
            }
            }
            ?>
             
               
        <a href="../yucles_principal.php" class="btn btn-secondary btn-lg"><i class="fas fa-arrow-left"></i> Volver</a>
    </div>

</body>

</html>

