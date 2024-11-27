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
                     <td><input type="radio" name="equipo" value="Bueno" id="equipo_bueno"></td>
                     <td><input type="radio" name="equipo" value="Malo" id="equipo_malo"></td>
                     <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesEquipo" name="observacionesEquipo" class="form-control"></textarea></td>
                </tr>

                <tr>
                    <td>Nivel Aceite De Centralina</td>
                    <td><input type="radio" name="NivelAceiteCentralina" value="Bueno"  id="NivelAceiteCentralina_bueno"></td>
                    <td><input type="radio" name="NivelAceiteCentralina" value="Malo"  id="NivelAceiteCentralina_malo"></td>
                    <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesNivelAceiteCentralina" name="observacionesNivelAceiteCentralina" class="form-control"></textarea></td>
                </tr>
                <tr>
                    <td>Revisar Conexiones</td>
                    <td><input type="radio" name="RevisarConexiones" value="Bueno"  id="RevisarConexiones_bueno"></td>
                    <td><input type="radio" name="RevisarConexiones" value="Malo"  id="RevisarConexiones_malo"></td>
                    <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesRevisarConexiones" name="observacionesRevisarConexiones" class="form-control"></textarea></td>
                </tr>
                
            </tbody>
        </table>

        <h1>Revisión Maquina Encendida</h1>
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
                    
                     <td>Arranque De Motor Centralina</td>
                     <td><input type="radio" name="ArranqueMotorCentralina" value="Bueno" id="ArranqueMotorCentralina_bueno"></td>
                     <td><input type="radio" name="ArranqueMotorCentralina" value="Malo" id="ArranqueMotorCentralina_malo"></td>
                     <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesArranqueMotorCentralina" name="observacionesArranqueMotorCentralina" class="form-control"></textarea></td>
                </tr>

                <tr>
                    <td>Revisión De Bomba Trabajando</td>
                    <td><input type="radio" name="BombaTrabajando" value="Bueno"  id="BombaTrabajando_bueno"></td>
                    <td><input type="radio" name="BombaTrabajando" value="Malo"  id="BombaTrabajando_malo"></td>
                    <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesBombaTrabajando" name="observacionesBombaTrabajando" class="form-control"></textarea></td>
                </tr>
                <tr>
                    <td>Revisión De Movimientos</td>
                    <td><input type="radio" name="RevisionMovimientos" value="Bueno"  id="RevisionMovimientos_bueno"></td>
                    <td><input type="radio" name="RevisionMovimientos" value="Malo"  id="RevisionMovimientos_malo"></td>
                    <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesRevisionMovimientos" name="observacionesRevisionMovimientos" class="form-control"></textarea></td>
                </tr>
                
            </tbody>
        </table>

        <h1>Revisión Antes De Apagar</h1>
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
                    
                     <td>Fugas</td>
                     <td><input type="radio" name="Fugas" value="Bueno" id="Fugas_bueno"></td>
                     <td><input type="radio" name="Fugas" value="Malo" id="Fugas_malo"></td>
                     <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesFugas" name="observacionesFugas" class="form-control"></textarea></td>
                </tr>

                <tr>
                    <td>Ruidos Extraños</td>
                    <td><input type="radio" name="RuidosExtraños" value="Bueno"  id="RuidosExtraños_bueno"></td>
                    <td><input type="radio" name="RuidosExtraños" value="Malo"  id="RuidosExtraños_malo"></td>
                    <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesRuidosExtraños" name="observacionesRuidosExtraños" class="form-control"></textarea></td>
                </tr>
                <tr>
                    <td>Inspección General De Equipo</td>
                    <td><input type="radio" name="InspeccionGeneralEquipo" value="Bueno"  id="InspeccionGeneralEquipo_bueno"></td>
                    <td><input type="radio" name="InspeccionGeneralEquipo" value="Malo"  id="InspeccionGeneralEquipo_malo"></td>
                    <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesInspeccionGeneralEquipo" name="observacionesInspeccionGeneralEquipo" class="form-control"></textarea></td>
                </tr>
                <tr>
                    <td>Movimiento De Motor De Regreso</td>
                    <td><input type="radio" name="MovimientoMotorRegreso" value="Bueno"  id="MovimientoMotorRegreso_bueno"></td>
                    <td><input type="radio" name="MovimientoMotorRegreso" value="Malo"  id="MovimientoMotorRegreso_malo"></td>
                    <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesMovimientoMotorRegreso" name="observacionesMovimientoMotorRegreso" class="form-control"></textarea></td>
                </tr>
                <tr>
                    <td>Estado De Conexiones Al Quitar</td>
                    <td><input type="radio" name="EstadoConexionesQuitar" value="Bueno"  id="EstadoConexionesQuitar_bueno"></td>
                    <td><input type="radio" name="EstadoConexionesQuitar" value="Malo"  id="EstadoConexionesQuitar_malo"></td>
                    <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesEstadoConexionesQuitar" name="observacionesEstadoConexionesQuitar" class="form-control"></textarea></td>
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
        <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesAdicionales" name="observacionesAdicionales" class="form-control"></textarea></td>
        </tr>
    </tbody>
</table>
<div class="text-center" style="margin-top: 20px; margin-bottom: 20px;">
    <a href="perforadoras_principal.php" class="btn btn-secondary btn-custom" style="margin-top: 10px; margin-bottom: 10px;">
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