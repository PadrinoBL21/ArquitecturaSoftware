<?php
// Inicia la sesión
session_start();

// Accede al nombre de la máquina
$nombre_maquina = isset($_SESSION['nombre_maquina']) ? $_SESSION['nombre_maquina'] : 'Nombre de la Máquina No Disponible';
$maquina_id = isset($_SESSION['maquina_id']) ? $_SESSION['maquina_id'] : 'ID de la Máquina No Disponible';

// Verifica si al menos una opción de la tabla de CHECK Servicio de Mantenimiento está marcada
$check_mantenimiento = (
    isset($_POST['CambiarFiltros']) && ($_POST['CambiarFiltros'] == 'Si' || $_POST['CambiarFiltros'] == 'No') &&
    isset($_POST['RevisarMangueras']) && ($_POST['RevisarMangueras'] == 'Si' || $_POST['RevisarMangueras'] == 'No') 
    // ... Agrega todas las opciones de la tabla CHECK aquí ...
);

if ($check_mantenimiento) {
    // El formulario solo se procesará si al menos una opción de la tabla CHECK está marcada
    // Resto del código de procesamiento del formulario
}

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Evaluación</title>
    <link rel="icon" href="../../img/logologin.jpg">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../../css/tablas.css" />


    <style>

    </style>

</head>


<body>
    <div class="container">
    <h1 class="text-center">Tabla de Evaluación</h1>
        <h2 class="text-center">Turno Vespertino</h2>
        <h2 class="text-center"><?php echo $nombre_maquina; ?></h2>

        <form action="EnviarReporteVespertino.php" method="post">
            <div class="table-responsive">
            <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Aspecto a Evaluar</th>
                    <th>Bueno</th>
                    <th>Malo</th>
                    <th class="observaciones">Observaciones</th>
                </tr>
            </thead>
            <tbody>
                 <tr>
                    
                     <td>Estado del Equipo</td>
                     <td><input type="radio" name="equipo" value="bueno" id="equipo_bueno"></td>
                     <td><input type="radio" name="equipo" value="malo" id="equipo_malo"></td>
                     <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesEquipo" name="observacionesEquipo" class="form-control"></textarea></td>
                </tr>

                <tr>
                    <td>Nivel Aceite de Motor</td>
                    <td><input type="radio" name="aceiteMotor" value="bueno"  id="aceiteMotor_bueno"></td>
                    <td><input type="radio" name="aceiteMotor" value="malo"  id="aceiteMotor_malo"></td>
                    <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesAceiteMotor" name="observacionesAceiteMotor" class="form-control"></textarea></td>
                </tr>

                <tr>
                    <td>Nivel de Anticongelante</td>
                    <td><input type="radio" name="anticongelante" value="bueno"  id="anticongelante_bueno"></td>
                    <td><input type="radio" name="anticongelante" value="malo"  id="anticongelante_malo"></td>
                    <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesanticongelante" name="observacionesanticongelante" class="form-control"></textarea></td>
                </tr>
                <tr>
                    <td>Baterías</td>
                    <td><input type="radio" name="Baterías" value="bueno"  id="Baterías_bueno"></td>
                    <td><input type="radio" name="Baterías" value="malo"  id="Baterías_malo"></td>
                    <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesBaterías" name="observacionesBaterías" class="form-control"></textarea></td>
                </tr>   
                <tr>
                    <td>Fugas</td>
                    <td><input type="radio" name="Fugas" value="bueno"  id="Fugas_bueno"></td>
                    <td><input type="radio" name="Fugas" value="malo"  id="Fugas_malo"></td>
                    <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesFugas" name="observacionesFugas" class="form-control"></textarea></td>
                </tr>

                <tr>
                    <td>Ruidos extraños</td>
                    <td><input type="radio" name="RudosExtraños" value="bueno"  id="RudosExtraños_bueno"></td>
                    <td><input type="radio" name="RudosExtraños" value="malo"  id="RudosExtraños_malo"></td>
                    <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesRudosExtraños" name="observacionesRudosExtraños" class="form-control"></textarea></td>
                </tr>
           
            </tbody>
        </table>

        <h1>Horómetro</h1>

        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Aspecto a Evaluar</th>
                    <th>Horómetro</th>
                    <th class="observaciones">Observaciones</th>
                </tr>
            </thead>
            <tbody>
        
                <tr>
                    <td>Horómetro Inicial</td>
                    <td><input type="number" name="horometroInicial" value="" id="horometroInicial"></td>
                    <td><textarea rows="2" placeholder="Escribe aquí" id="observacionesHorometroInicial" name="observacionesHorometroInicial" class="form-control"></textarea></td>
                </tr>
                <tr>
                    <td>Horómetro Final</td>
                    <td><input type="number" name="horometroFinal" value="" id="horometroFinal"></td>
                    <td><textarea rows="2" placeholder="Escribe aquí" id="observacionesHorometroFinal" name="observacionesHorometroFinal" class="form-control"></textarea></td>
                </tr>
            </tbody>
        </table>
    


        <h1>Observaciones Adicionales</h1>
        <table class="table table-bordered table-hover">
        <tbody>
        <tr>
        <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesAveriasEncontradasMomento" name="observacionesAveriasEncontradasMomento" class="form-control"></textarea></td>
        </tr>
    </tbody>
</table>
<div class="text-center" style="margin-top: 20px; margin-bottom: 20px;">
    <a href="generadores_principal.php" class="btn btn-secondary btn-custom" style="margin-top: 10px; margin-bottom: 10px;">
        <i class="fas fa-arrow-left icono-personalizado"></i> Volver
    </a>
    <button type="submit" class="btn btn-info btn-log" style="margin-top: 10px; margin-bottom: 10px;">
        <i class="fas fa-save icono-personalizado"></i> Guardar
    </button>
</div>
        </div>
</form>
    </div>

    </body>
    
</html>