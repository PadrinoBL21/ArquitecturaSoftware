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
            Ajuste_Hoja, Ajuste_Wideas, Estado_Control_Botones, Engrasar_Tren_Avance, Revision_Nivel_Aceite,
            Ruidos_Extranos_Encender, Movimientos_Espada_Encender, Movimientos_Espada_Encender, Ruidos_Extraños_Antes_Apagar, Inspeccion_General_Equipo,
            Limpiar_Cadena, Enfriamiento_Motor, Limpieza_Exterior_Equipo,
            Horometro_Inicial, Horometro_Final, Averias_Encontradas,
            Observaciones_Ajuste_Hoja, Observaciones_Nivel_Ajuste_Wideas, Observaciones_Estado_Control_Botones, Observaciones_Engrasar_Tren_Avance,
            Observaciones_Revision_Nivel_Aceite, Observaciones_Ruidos_Extranos_Encender, Observaciones_Movimientos_Espada,
            Observaciones_Ruidos_Extranos_Antes_Apagar, Observaciones_Inspeccion_General_Equipo, Observaciones_Limpiar_Cadena,
            Observaciones_Enfriamiento_Motor, Observaciones_Limpieza_Equipo_Exterior, Observaciones_Horometro_Inicial,
            Observaciones_Horometro_Final 
            FROM Espada WHERE id_reporte = $id_reporte"); 

            //DEFINICION DE VARIABLES
            while ($aspecto = mysqli_fetch_assoc($aspectos_query)) {
                $Ajuste_Hoja = $aspecto['Ajuste_Hoja'];
                $Observaciones_Ajuste_Hoja = $aspecto['Observaciones_Ajuste_Hoja'];

                $Ajuste_Wideas = $aspecto['Ajuste_Wideas'];
                $Observaciones_Nivel_Ajuste_Wideas = $aspecto['Observaciones_Nivel_Ajuste_Wideas'];

                $Estado_Control_Botones = $aspecto['Estado_Control_Botones'];
                $Observaciones_Estado_Control_Botones = $aspecto['Observaciones_Estado_Control_Botones'];

                $Engrasar_Tren_Avance = $aspecto['Engrasar_Tren_Avance'];
                $Observaciones_Engrasar_Tren_Avance = $aspecto['Observaciones_Engrasar_Tren_Avance'];

                $Revision_Nivel_Aceite = $aspecto['Revision_Nivel_Aceite'];
                $Observaciones_Revision_Nivel_Aceite = $aspecto['Observaciones_Revision_Nivel_Aceite'];

                $Ruidos_Extranos_Encender = $aspecto['Ruidos_Extranos_Encender'];
                $Observaciones_Ruidos_Extranos_Encender = $aspecto['Observaciones_Ruidos_Extranos_Encender'];

                $Movimientos_Espada_Encender = $aspecto['Movimientos_Espada_Encender'];
                $Observaciones_Movimientos_Espada = $aspecto['Observaciones_Movimientos_Espada'];

                $Ruidos_Extraños_Antes_Apagar = $aspecto['Ruidos_Extraños_Antes_Apagar'];
                $Observaciones_Ruidos_Extranos_Antes_Apagar = $aspecto['Observaciones_Ruidos_Extranos_Antes_Apagar'];

                $Inspeccion_General_Equipo = $aspecto['Inspeccion_General_Equipo'];
                $Observaciones_Inspeccion_General_Equipo = $aspecto['Observaciones_Inspeccion_General_Equipo'];

                $Limpiar_Cadena = $aspecto['Limpiar_Cadena'];
                $Observaciones_Limpiar_Cadena = $aspecto['Observaciones_Limpiar_Cadena'];

                $Enfriamiento_Motor = $aspecto['Enfriamiento_Motor'];
                $Observaciones_Enfriamiento_Motor = $aspecto['Observaciones_Enfriamiento_Motor'];

                $Limpieza_Exterior_Equipo = $aspecto['Limpieza_Exterior_Equipo'];
                $Observaciones_Limpieza_Equipo_Exterior = $aspecto['Observaciones_Limpieza_Equipo_Exterior'];

                $Horometro_Inicial = $aspecto['Horometro_Inicial'];
                $Observaciones_Horometro_Inicial = $aspecto['Observaciones_Horometro_Inicial'];

                $Horometro_Final = $aspecto['Horometro_Final'];
                $Observaciones_Horometro_Final = $aspecto['Observaciones_Horometro_Final'];

                $Averias_Encontradas = $aspecto['Averias_Encontradas'];

                
                
            ?>
            <!--TABLAS DE ASPECTOS A EVALUAR-->
                <tr>
                    <td>Ajuste de hoja</td>
                    <td <?php echo ($Ajuste_Hoja == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($Ajuste_Hoja == 'Bueno') ? '' : ''; ?></td>
                    <td <?php echo ($Ajuste_Hoja == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($Ajuste_Hoja == 'Malo') ? '' : ''; ?></td>
                    <td><?php echo $Observaciones_Ajuste_Hoja; ?></td>
                </tr>
                
                <tr>
                    <td>Ajuste de widias</td>
                    <td <?php echo ($Ajuste_Wideas == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($Ajuste_Wideas == 'Bueno') ? '' : ''; ?></td>
                    <td <?php echo ($Ajuste_Wideas == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($Ajuste_Wideas == 'Malo') ? '' : ''; ?></td>
                    <td><?php echo $Observaciones_Nivel_Ajuste_Wideas; ?></td>
                </tr>

                <tr>
                    <td>Estado de control y botones</td>
                    <td <?php echo ($Estado_Control_Botones == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($Estado_Control_Botones == 'Bueno') ? '' : ''; ?></td>
                    <td <?php echo ($Estado_Control_Botones == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($Estado_Control_Botones == 'Malo') ? '' : ''; ?></td>
                    <td><?php echo $Observaciones_Estado_Control_Botones; ?></td>
                </tr>

                <tr>
                    <td>Engrasar tren de avance</td>
                    <td <?php echo ($Engrasar_Tren_Avance == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($Engrasar_Tren_Avance == 'Bueno') ? '' : ''; ?></td>
                    <td <?php echo ($Engrasar_Tren_Avance == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($Engrasar_Tren_Avance == 'Malo') ? '' : ''; ?></td>
                    <td><?php echo $Observaciones_Engrasar_Tren_Avance; ?></td>
                </tr>

                <tr>
                    <td>Revisión de nivel de aceite</td>
                    <td <?php echo ($Revision_Nivel_Aceite == 'Bueno') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($Revision_Nivel_Aceite == 'Bueno') ? '' : ''; ?></td>
                    <td <?php echo ($Revision_Nivel_Aceite == 'Malo') ? 'class="marca-x malo"' : ''; ?>><?php echo ($Revision_Nivel_Aceite == 'Malo') ? '' : ''; ?></td>
                    <td><?php echo $Observaciones_Revision_Nivel_Aceite; ?></td>
                </tr>

        </table>

                
        <h1>Revisión al Encender</h1>
        <table>
                <tr>
                    <th>Revisión</th>
                    <th>Bueno</th>
                    <th>Malo</th>
                    <th>Observaciones</th>
                </tr>   

                <tr> 
                    <td>Ruidos extraños</td>
                    <td <?php echo ($Ruidos_Extranos_Encender == 'Si') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($Ruidos_Extranos_Encender == 'Si') ? '' : ''; ?></td>
                    <td <?php echo ($Ruidos_Extranos_Encender == 'No') ? 'class="marca-x malo"' : ''; ?>><?php echo ($Ruidos_Extranos_Encender == 'No') ? '' : ''; ?></td>
                    <td><?php echo $Observaciones_Ruidos_Extranos_Encender; ?></td>
                </tr>

                <tr>
                    <td>Movimientos de espada</td>
                    <td <?php echo ($Movimientos_Espada_Encender == 'Si') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($Movimientos_Espada_Encender == 'Si') ? '' : ''; ?></td>
                    <td <?php echo ($Movimientos_Espada_Encender == 'No') ? 'class="marca-x malo"' : ''; ?>><?php echo ($Movimientos_Espada_Encender == 'No') ? '' : ''; ?></td>
                    <td><?php echo $Observaciones_Movimientos_Espada; ?></td>
                </tr>
        </table>

        <h1>Revisión Antes de Apagar</h1>

        <table>
                <tr>
                    <th>Revisión</th>
                    <th>Bueno</th>
                    <th>Malo</th>
                    <th>Observaciones</th>
                </tr>

                
                <tr>
                    <td>Ruidos extraños</td>
                    <td <?php echo ($Ruidos_Extraños_Antes_Apagar == 'Si') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($Ruidos_Extraños_Antes_Apagar == 'Si') ? '' : ''; ?></td>
                    <td <?php echo ($Ruidos_Extraños_Antes_Apagar == 'No') ? 'class="marca-x malo"' : ''; ?>><?php echo ($Ruidos_Extraños_Antes_Apagar == 'No') ? '' : ''; ?></td>
                    <td><?php echo $Observaciones_Ruidos_Extranos_Antes_Apagar; ?></td>
                </tr>

                <tr>
                    <td>Inspección general del equipo</td>
                    <td <?php echo ($Inspeccion_General_Equipo == 'Si') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($Inspeccion_General_Equipo == 'Si') ? '' : ''; ?></td>
                    <td <?php echo ($Inspeccion_General_Equipo == 'No') ? 'class="marca-x malo"' : ''; ?>><?php echo ($Inspeccion_General_Equipo == 'No') ? '' : ''; ?></td>
                    <td><?php echo $Observaciones_Inspeccion_General_Equipo; ?></td>

                </tr>

                <tr>
                    <td>Limpiar cadena</td>
                    <td <?php echo ($Limpiar_Cadena == 'Si') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($Limpiar_Cadena == 'Si') ? '' : ''; ?></td>
                    <td <?php echo ($Limpiar_Cadena == 'No') ? 'class="marca-x malo"' : ''; ?>><?php echo ($Limpiar_Cadena == 'No') ? '' : ''; ?></td>
                    <td><?php echo $Observaciones_Limpiar_Cadena; ?></td>
                </tr>

                <tr>
                    <td>Enfriamiento del motor</td>
                    <td <?php echo ($Enfriamiento_Motor == 'Si') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($Enfriamiento_Motor == 'Si') ? '' : ''; ?></td>
                    <td <?php echo ($Enfriamiento_Motor == 'No') ? 'class="marca-x malo"' : ''; ?>><?php echo ($Enfriamiento_Motor == 'No') ? '' : ''; ?></td>
                    <td><?php echo $Observaciones_Enfriamiento_Motor; ?></td>
                </tr>

                <tr>
                    <td>Limpieza exterior del equipo</td>
                    <td <?php echo ($Limpieza_Exterior_Equipo == 'Si') ? 'class="marca-x bueno"' : ''; ?>><?php echo ($Limpieza_Exterior_Equipo == 'Si') ? '' : ''; ?></td>
                    <td <?php echo ($Limpieza_Exterior_Equipo == 'No') ? 'class="marca-x malo"' : ''; ?>><?php echo ($Limpieza_Exterior_Equipo == 'No') ? '' : ''; ?></td>
                    <td><?php echo $Observaciones_Limpieza_Equipo_Exterior; ?></td>
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

        <h1>Observaciones adicionales</h1>

        <table>
            <tr>
                <td><?php echo $Averias_Encontradas; ?></td>
            </tr>


        </table>                
            <?php
            }
            
            ?>
               
        <a href="../espadas_principal.php"  class="btn btn-secondary btn-lg"><i class="fas fa-arrow-left"></i> Volver</a>
    </div>

</body>

</html>
