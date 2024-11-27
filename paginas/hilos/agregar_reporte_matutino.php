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
        <h2 class="text-center">Turno Matutino</h2>
        <h2 class="text-center"><?php echo $nombre_maquina; ?></h2>

        <form action="EnviarReporteMatutino.php" method="post">
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
                    <td>Control/Botones</td>
                    <td><input type="radio" name="ControlBotonoes" value="bueno"  id="ControlBotonoes_bueno"></td>
                    <td><input type="radio" name="ControlBotonoes" value="malo"  id="ControlBotonoes_malo"></td>
                    <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesControlBotonoes" name="observacionesControlBotonoes" class="form-control"></textarea></td>
                </tr>
                <tr>
                     <td>Revisión de Movimientos De Avance</td>
                     <td><input type="radio" name="RevisionMovimientosAvanze" value="bueno" id="RevisionMovimientosAvanze_bueno"></td>
                     <td><input type="radio" name="RevisionMovimientosAvanze" value="malo" id="RevisionMovimientosAvanze_malo"></td>
                     <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesRevisionMovimientosAvanze" name="observacionesRevisionMovimientosAvanze" class="form-control"></textarea></td>
                </tr>

                <tr>
                    <td>Revisar Giros Del Motor</td>
                    <td><input type="radio" name="RevisarGirosMotor" value="bueno"  id="RevisarGirosMotor_bueno"></td>
                    <td><input type="radio" name="RevisarGirosMotor" value="malo"  id="RevisarGirosMotor_malo"></td>
                    <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesRevisarGirosMotor" name="observacionesRevisarGirosMotor" class="form-control"></textarea></td>
                </tr>
                <tr>
                    <td>Revisar Movimientos De Polea</td>
                    <td><input type="radio" name="RevivarMovimientosPolea" value="bueno"  id="RevivarMovimientosPolea_bueno"></td>
                    <td><input type="radio" name="RevivarMovimientosPolea" value="malo"  id="RevivarMovimientosPolea_malo"></td>
                    <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesRevivarMovimientosPolea" name="observacionesRevivarMovimientosPolea" class="form-control"></textarea></td>
                </tr>

                
                
           
            </tbody>
        </table>


        
        <h1>Aspectos a limpiar</h1>
        <table class="table table-bordered table-hover">
        <thead class="thead-dark">
        <tr>
            <th>Acciones a Realizar</th>
            <th>Sí</th>
            <th>No</th>
            <th class="observaciones">Observaciones</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Limpieza de clavijas</td>
            <td><input type="radio" name="LimpiezaClavijas" value="Si"  id="LimpiezaClavijas_Si"></td>
            <td><input type="radio" name="LimpiezaClavijas" value="No"  id="LimpiezaClavijas_No"></td>
            <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesLimpiezaClavijas" name="observacionesLimpiezaClavijas" class="form-control"></textarea></td>
        </tr>
        <tr>
            <td>Interior Y Exterior De Carro</td>
            <td><input type="radio" name="InteriorExteriorCarro" value="Si"  id="InteriorExteriorCarro_Si"></td>
            <td><input type="radio" name="InteriorExteriorCarro" value="No"  id="InteriorExteriorCarro_No"></td>
            <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesInteriorExteriorCarro" name="observacionesInteriorExteriorCarro" class="form-control"></textarea></td>
        </tr>
        <tr>
            <td>Engrasar Bastagos</td>
            <td><input type="radio" name="EngrasarBastagos" value="Si"  id="EngrasarBastagos_Si"></td>
            <td><input type="radio" name="EngrasarBastagos" value="No"  id="EngrasarBastagos_no"></td>
            <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesEngrasarBastagos" name="observacionesEngrasarBastagos" class="form-control"></textarea></td>
        </tr>
        
    </tbody>
</table>


<h1>Antes de apagar</h1>
<table class="table table-bordered table-hover">
            <thead class="thead-dark">
        <tr>
            <th>Acciones a Realizar</th>
            <th>Bueno</th>
            <th>Malo</th>
            <th class="observaciones">Observaciones</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Inspección General de Equipo</td>
            <td><input type="radio" name="InspeccionGeneralEquipo" value="Si"  id="InspeccionGeneralEquipo_Si"></td>
            <td><input type="radio" name="InspeccionGeneralEquipo" value="No"  id="InspeccionGeneralEquipo_No"></td>
            <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesInspeccionGeneralEquipo" name="observacionesInspeccionGeneralEquipo" class="form-control"></textarea></td>
        </tr>
        <tr>
            <td>Estado De Conexiones Al Quitar</td>
            <td><input type="radio" name="EstadoConexionesAlQuitar" value="Bueno"  id="EstadoConexionesAlQuitar_Bueno"></td>
            <td><input type="radio" name="EstadoConexionesAlQuitar" value="Malo"  id="EstadoConexionesAlQuitar_Malo"></td>
            <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesEstadoConexionesAlQuitar" name="observacionesEstadoConexionesAlQuitar" class="form-control"></textarea></td>
        </tr>
        <tr>
            <td>Ruidos Extraños</td>
            <td><input type="radio" name="RuidosExtraños" value="Si"  id="RuidosExtraños_Si"></td>
            <td><input type="radio" name="RuidosExtraños" value="No"  id="RuidosExtraños_No"></td>
            <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesRuidosExtraños" name="observacionesRuidosExtraños" class="form-control"></textarea></td>
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
    <a href="hilos_principal.php" class="btn btn-secondary btn-custom" style="margin-top: 10px; margin-bottom: 10px;">
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