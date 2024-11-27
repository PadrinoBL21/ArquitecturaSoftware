<?php
session_start();

$nombre_maquina = isset($_SESSION['nombre_maquina']) ? $_SESSION['nombre_maquina'] : 'Nombre de la Máquina No Disponible';
$maquina_id = isset($_SESSION['maquina_id']) ? $_SESSION['maquina_id'] : 'ID de la Máquina No Disponible';


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

        <form action="EnviarCheckMantenimiento.php" method="post">
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
                    <td>Nivel Aceite En Unidad de Compresión</td>
                    <td><input type="radio" name="aceiteCompresion" value="bueno"  id="aceiteCompresion_bueno"></td>
                    <td><input type="radio" name="aceiteCompresion" value="malo"  id="aceiteCompresion_malo"></td>
                    <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesaceiteCompresion" name="observacionesaceiteCompresion" class="form-control"></textarea></td>
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
                <tr>
                    <td>Baterías</td>
                    <td><input type="radio" name="Baterías" value="bueno"  id="Baterías_bueno"></td>
                    <td><input type="radio" name="Baterías" value="malo"  id="Baterías_malo"></td>
                    <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesBaterías" name="observacionesBaterías" class="form-control"></textarea></td>
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

            <h1>Check de mantenimiento</h1>
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
                <td>Cambiar Filtros</td>
                    <td><input type="radio" name="CambiarFiltros" value="Si"  id="cambiarFiltros_Si"></td>
                    <td><input type="radio" name="CambiarFiltros" value="No"  id="cambiarFiltros_no"></td>
                    <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesCambiarFiltros" name="observacionesCambiarFiltros" class="form-control"></textarea></td>
                </tr>
                <td>Revisar Mangueras</td>
                    <td><input type="radio" name="RevisarMangueras" value="Si"  id="RevisarMangueras_Si"></td>
                    <td><input type="radio" name="RevisarMangueras" value="No"  id="RevisarMangueras_no"></td>
                    <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesRevisarMangueras" name="observacionesRevisarMangueras" class="form-control"></textarea></td>
                </tr>
                <td>Revisar Sistema Eléctrico (Marcha)</td>
                    <td><input type="radio" name="RevisarSistemaElectrico_Marcha" value="Si"  id="RevisarSistemaElectrico_Marcha_Si"></td>
                    <td><input type="radio" name="RevisarSistemaElectrico_Marcha" value="No"  id="RevisarSistemaElectrico_Marcha_no"></td>
                    <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesRevisarSistemaElectrico_Marcha" name="observacionesRevisarSistemaElectrico_Marcha" class="form-control"></textarea></td>
                </tr>
                <td>Revisar Niveles de Fluido en General</td>
                    <td><input type="radio" name="RevisarNivelesFluidoGeneral" value="Si"  id="RevisarNivelesFluidoGeneral_Si"></td>
                    <td><input type="radio" name="RevisarNivelesFluidoGeneral" value="No"  id="RevisarNivelesFluidoGeneral_no"></td>
                    <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesRevisarNivelesFluidoGeneral" name="observacionesRevisarNivelesFluidoGeneral" class="form-control"></textarea></td>
                </tr>
               
                
            </tbody>
        </table>

        <h1>Averías Encontradas al Momento del Servicio</h1>
        <table class="table table-bordered table-hover">
    <tbody>
        <tr>
        <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesAveriasEncontradasMomento" name="observacionesAveriasEncontradasMomento" class="form-control"></textarea></td>
        </tr>
    </tbody>
</table>


<div class="text-center" style="margin-top: 20px; margin-bottom: 20px;">
    <a href="compresores_principal.php" class="btn btn-secondary btn-custom" style="margin-top: 10px; margin-bottom: 10px;">
        <i class="fas fa-arrow-left icono-personalizado"></i> Volver
    </a>
    <button type="submit" class="btn btn-info btn-log" style="margin-top: 10px; margin-bottom: 10px;">
        <i class="fas fa-save icono-personalizado"></i> Guardar
    </button>
</div>
</form>
    </div>

    </body>
    
</html>