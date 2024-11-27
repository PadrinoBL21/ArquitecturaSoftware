<?php
session_start();

$nombre_maquina = isset($_SESSION['nombre_maquina']) ? $_SESSION['nombre_maquina'] : 'Nombre de la Máquina No Disponible';
$maquina_id = isset($_SESSION['maquina_id']) ? $_SESSION['maquina_id'] : 'ID de la Máquina No Disponible';

$check_mantenimiento = (
    isset($_POST['CambiarFiltros']) && ($_POST['CambiarFiltros'] == 'Si' || $_POST['CambiarFiltros'] == 'No') &&
    isset($_POST['RevisarMangueras']) && ($_POST['RevisarMangueras'] == 'Si' || $_POST['RevisarMangueras'] == 'No') 
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
                    
                     <td>Ajuste de hoja</td>
                     <td><input type="radio" name="AjusteHoja" value="Bueno" id="AjusteHoja_bueno"></td>
                     <td><input type="radio" name="AjusteHoja" value="Malo" id="AjusteHoja_malo"></td>
                     <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesAjusteHoja" name="observacionesAjusteHoja" class="form-control"></textarea></td>
                </tr>

                <tr>
                    <td>Ajuste Wideas</td>
                    <td><input type="radio" name="AjusteWideas" value="Bueno"  id="AjusteWideas_bueno"></td>
                    <td><input type="radio" name="AjusteWideas" value="Malo"  id="AjusteWideas_malo"></td>
                    <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesAjusteWideas" name="observacionesAjusteWideas" class="form-control"></textarea></td>
                </tr>

                <tr>
                    <td>Estado De Control/Botones</td>
                    <td><input type="radio" name="EstadoControlBotones" value="Bueno"  id="EstadoControlBotones_bueno"></td>
                    <td><input type="radio" name="EstadoControlBotones" value="Malo"  id="EstadoControlBotones_malo"></td>
                    <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesEstadoControlBotones" name="observacionesEstadoControlBotones" class="form-control"></textarea></td>
                </tr>
                <tr>
                    <td>Engrasar Tren De Avance</td>
                    <td><input type="radio" name="EngrasarTrenAvance" value="Bueno"  id="EngrasarTrenAvance_bueno"></td>
                    <td><input type="radio" name="EngrasarTrenAvance" value="Malo"  id="EngrasarTrenAvance_malo"></td>
                    <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesEngrasarTrenAvance" name="observacionesEngrasarTrenAvance" class="form-control"></textarea></td>
                </tr>
                <tr>
                    <td>Revisión Del Nivel De Aceite</td>
                    <td><input type="radio" name="RevisionNivelAceite" value="Bueno"  id="RevisionNivelAceite_bueno"></td>
                    <td><input type="radio" name="RevisionNivelAceite" value="Malo"  id="RevisionNivelAceite_malo"></td>
                    <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesRevisionNivelAceite" name="observacionesRevisionNivelAceite" class="form-control"></textarea></td>
                </tr>
                
           
            </tbody>
        </table>

        <h1>Revisión Al Encender</h1>
        <table class="table table-bordered table-hover">
        <thead class="thead-dark">
        <tr>
            <th>Revisión</th>
            <th>Sí</th>
            <th>No</th>
            <th class="observaciones">Observaciones</th>
        </tr>
    </thead>
    <tbody>

        <tr>
                <td>Ruidos extraños</td>
                <td><input type="radio" name="RudosExtraños" value="Si"  id="RudosExtraños_Si"></td>
                <td><input type="radio" name="RudosExtraños" value="No"  id="RudosExtraños_No"></td>
                <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesRudosExtraños" name="observacionesRudosExtraños" class="form-control"></textarea></td>
        </tr>
        <tr>
                <td>Movimientos De La Espada</td>
                <td><input type="radio" name="MoviminetosEspada" value="Si"  id="MoviminetosEspada_Si"></td>
                <td><input type="radio" name="MoviminetosEspada" value="No"  id="MoviminetosEspada_No"></td>
                <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesMoviminetosEspada" name="observacionesMoviminetosEspada" class="form-control"></textarea></td>
        </tr>
    </tbody>
</table>

        <h1>Revisión Antes De Apagar</h1>
        <table class="table table-bordered table-hover">
        <thead class="thead-dark">
        <tr>
            <th>Revisión</th>
            <th>Sí</th>
            <th>No</th>
            <th class="observaciones">Observaciones</th>
        </tr>
    </thead>
    <tbody>

        <tr>
                <td>Ruidos extraños</td>
                <td><input type="radio" name="RudosExtrañosApagar" value="Si"  id="RudosExtrañosApagar_Si"></td>
                <td><input type="radio" name="RudosExtrañosApagar" value="No"  id="RudosExtrañosApagar_No"></td>
                <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesRudosExtrañosApagar" name="observacionesRudosExtrañosApagar" class="form-control"></textarea></td>
        </tr>
        <tr>
                <td>Inspección General De Equipo</td>
                <td><input type="radio" name="InspeccionGeneralEquipo" value="Si"  id="InspeccionGeneralEquipo_Si"></td>
                <td><input type="radio" name="InspeccionGeneralEquipo" value="No"  id="InspeccionGeneralEquipo_No"></td>
                <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesInspeccionGeneralEquipo" name="observacionesInspeccionGeneralEquipo" class="form-control"></textarea></td>
        </tr>
        <tr>
                <td>Limpiar Cadena</td>
                <td><input type="radio" name="LimpiarCadena" value="Si"  id="LimpiarCadena_Si"></td>
                <td><input type="radio" name="LimpiarCadena" value="No"  id="LimpiarCadena_No"></td>
                <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesLimpiarCadena" name="observacionesLimpiarCadena" class="form-control"></textarea></td>
        </tr>
        <tr>
                <td>Enfriamiento de motor</td>
                <td><input type="radio" name="EnfriamientoMotor" value="Si"  id="EnfriamientoMotor_Si"></td>
                <td><input type="radio" name="EnfriamientoMotor" value="No"  id="EnfriamientoMotor_No"></td>
                <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesEnfriamientoMotor" name="observacionesEnfriamientoMotor" class="form-control"></textarea></td>
        </tr>
        <tr>
                <td>Limpieza Del Exterior De Equipo</td>
                <td><input type="radio" name="LimpiezaExteriorEquipo" value="Si"  id="LimpiezaExteriorEquipo_Si"></td>
                <td><input type="radio" name="LimpiezaExteriorEquipo" value="No"  id="LimpiezaExteriorEquipo_No"></td>
                <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesLimpiezaExteriorEquipo" name="observacionesLimpiezaExteriorEquipo" class="form-control"></textarea></td>
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
</table><div class="text-center" style="margin-top: 20px; margin-bottom: 20px;">
    <a href="espadas_principal.php" class="btn btn-secondary btn-custom" style="margin-top: 10px; margin-bottom: 10px;">
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