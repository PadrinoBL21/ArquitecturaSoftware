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
    <link rel="stylesheet" href="../../css/tablas.css">
    <style>
       
    </style>
</head>
<body>
    <div class="container">
    <h1 class="text-center">Tabla de Evaluación</h1>
        <h2 class="text-center">Check de Mantenimiento</h2>
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
                    
                     <td>Estado del Esqueleto</td>
                     <td><input type="radio" name="esqueleto" value="bueno" id="esqueleto_bueno"></td>
                     <td><input type="radio" name="esqueleto" value="malo" id="esqueleto_malo"></td>
                     <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesEsqueleto" name="observacionesEsqueleto" class="form-control"></textarea></td>
                </tr>

                <tr>
                    <td>Nivel Aceite de Motor</td>
                    <td><input type="radio" name="aceiteMotor" value="bueno"  id="aceiteMotor_bueno"></td>
                    <td><input type="radio" name="aceiteMotor" value="malo"  id="aceiteMotor_malo"></td>
                    <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesAceiteMotor" name="observacionesAceiteMotor"class="form-control"></textarea></td>
                </tr>

                <tr>
                    <td>Nivel Aceite Hidráulico</td>
                    <td><input type="radio" name="aceiteHidraulico" value="bueno"  id="aceiteHidraulico_bueno"></td>
                    <td><input type="radio" name="aceiteHidraulico" value="malo"  id="aceiteHidraulico_malo"></td>
                    <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesAceiteHidraulico" name="observacionesAceiteHidraulico" class="form-control"></textarea></td>
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
                    <td>Luces</td>
                    <td><input type="radio" name="Luces" value="bueno"  id="Luces_bueno"></td>
                    <td><input type="radio" name="Luces" value="malo"  id="Luces_malo"></td>
                    <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesLucesr" name="observacionesLuces" class="form-control"></textarea></td>
                </tr>
                <tr>
                    <td>Neumáticos Presión 75LB</td>
                    <td><input type="radio" name="NeumáticosPresión" value="bueno"  id="NeumáticosPresión_bueno"></td>
                    <td><input type="radio" name="NeumáticosPresión" value="malo"  id="NeumáticosPresión_malo"></td>
                    <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesAceiteMotor" name="observacionesNeumáticosPresión" class="form-control"></textarea></td>
                </tr>
                <tr>
                    <td>Banda de Alternador y Ventilador</td>
                    <td><input type="radio" name="bandaAlternadorVentilador" value="bueno"  id="bandaAlternadorVentilador_bueno"></td>
                    <td><input type="radio" name="bandaAlternadorVentilador" value="malo"  id="bandaAlternadorVentilador_malo"></td>
                    <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesbandaAlternadorVentilador" name="observacionesbandaAlternadorVentilador" class="form-control"></textarea></td>
                </tr>
               




                
            </tbody>
        </table>

        
        <H1>Máquina encendida</H1>
    
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
                    <td>Nivel Aceite Transmisión</td>
                    <td><input type="radio" name="aceiteMotorTransmision" value="bueno"  id="aceiteMotorTransmision_bueno"></td>
                    <td><input type="radio" name="aceiteMotorTransmision" value="malo"  id="aceiteMotorTransmision_malo"></td>
                    <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesaceiteMotorTransmision" name="observacionesaceiteMotorTransmision" class="form-control"></textarea></td>
             </tr>
             <tr>
                    <td>Fugas</td>
                    <td><input type="radio" name="FugasME" value="bueno"  id="FugasME_bueno"></td>
                    <td><input type="radio" name="FugasME" value="malo"  id="FugasME_malo"></td>
                    <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesFugasME" name="observacionesFugasME" class="form-control"></textarea></td>
                </tr>
            </tbody>
        </table>

        <h1>Máquina trabajando</h1>
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
                    <td>Frenos</td>
                    <td><input type="radio" name="FrenosMT" value="bueno"  id="FrenosMT_bueno"></td>
                    <td><input type="radio" name="FrenosMT" value="malo"  id="FrenosMT_malo"></td>
                    <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesFrenosMT" name="observacionesFrenosMT" class="form-control"></textarea></td>
                </tr>
                <tr>
                    <td>Presión de Motor 50 PSI</td>
                    <td><input type="radio" name="PresionMotorMT" value="bueno"  id="PresionMotorMT_bueno"></td>
                    <td><input type="radio" name="PresionMotorMT" value="malo"  id="PresionMotorMT_malo"></td>
                    <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesPresionMotorMT" name="observacionesPresionMotorMT" class="form-control"></textarea></td>
                </tr>
                <tr>
                    <td>Temperatura de Motor 100-180°C</td>
                    <td><input type="radio" name="TemperaturaMotorMT" value="bueno"  id="TemperaturaMotorMT_bueno"></td>
                    <td><input type="radio" name="TemperaturaMotorMT" value="malo"  id="TemperaturaMotorMT_malo"></td>
                    <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesTemperaturaMotorMT" name="observacionesTemperaturaMotorMT" class="form-control"></textarea></td>
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
                            <td><input type="number" name="horometroInicial" class="form-control"></td>
                            <td><textarea rows="2" placeholder="Escribe aquí" name="observacionesHorometroInicial" class="form-control"></textarea></td>
                        </tr>
                        <tr>
                            <td>Horómetro Final</td>
                            <td><input type="number" name="horometroFinal" class="form-control"></td>
                            <td><textarea rows="2" placeholder="Escribe aquí" name="observacionesHorometroFinal" class="form-control"></textarea></td>
                        </tr>
                    </tbody>
                </table>

                <h1>Observaciones Adicionales</h1>
                <table class="table table-bordered table-hover">
                    <tbody>
                        <tr>
                            <td><textarea rows="4" placeholder="Escribe aquí" name="observacionesAdicionales" class="form-control"></textarea></td>
                        </tr>
                    </tbody>
                </table>
        
        <h1 class="text-center">Check Servicio de Mantenimiento</h1>
        <h2 class="text-center">Maquina: <?php echo $nombre_maquina; ?></h2>
        
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
                <td>Engrasar Tazas, Pernos, Gatos</td>
                    <td><input type="radio" name="EngrasarTazas_Pernos_Gatos" value="Si"  id="EngrasarTazas_Pernos_Gatos_Si"></td>
                    <td><input type="radio" name="EngrasarTazas_Pernos_Gatos" value="No"  id="EngrasarTazas_Pernos_Gatos_no"></td>
                    <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesEngrasarTazas_Pernos_Gatos" name="observacionesEngrasarTazas_Pernos_Gatos" class="form-control"></textarea></td>
                </tr>
                <td>Revisar Sistema Eléctrico (Marcha)</td>
                    <td><input type="radio" name="RevisarSistemaElectrico_Marcha" value="Si"  id="RevisarSistemaElectrico_Marcha_Si"></td>
                    <td><input type="radio" name="RevisarSistemaElectrico_Marcha" value="No"  id="RevisarSistemaElectrico_Marcha_no"></td>
                    <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesRevisarSistemaElectrico_Marcha" name="observacionesRevisarSistemaElectrico_Marcha" class="form-control"></textarea></td>
                </tr>
                <td>Revisar Sistema de Avance</td>
                    <td><input type="radio" name="RevisarSistema_Avance" value="Si"  id="RevisarSistema_Avance_Si"></td>
                    <td><input type="radio" name="RevisarSistema_Avance" value="No"  id="RevisarSistema_Avance_no"></td>
                    <td><textarea rows="3" placeholder="Escribe aquí" id="observacionesRevisarSistema_Avance" name="observacionesRevisarSistema_Avance" class="form-control"></textarea></td>
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
        <td><textarea rows="4" placeholder="Escribe aquí" id="observacionesAveriasEncontradasMomento" name="observacionesAveriasEncontradasMomento" class="form-control"></textarea></td>
        </tr>
    </tbody>
</table>


<div class="text-center" style="margin-top: 20px; margin-bottom: 20px;">
    <a href="cargadores_principal.php" class="btn btn-secondary btn-custom" style="margin-top: 10px; margin-bottom: 10px;">
        <i class="fas fa-arrow-left icono-personalizado"></i> Volver
    </a>
    <button type="submit" class="btn btn-info btn-log" style="margin-top: 10px; margin-bottom: 10px;">
        <i class="fas fa-save icono-personalizado"></i> Guardar
    </button>
</div>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
    
</html>