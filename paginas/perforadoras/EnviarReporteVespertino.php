<?php
include "../../Conexion.php";

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
session_start();
if (!isset($_SESSION['username'])) {
    echo '<script>alert("Sesión expirada. Por favor, inicia sesión de nuevo para continuar.");';
    echo 'window.location.href = "../../index.html";</script>';
    exit();
}
if (isset($_SESSION['username'])) {
    $idUsuario = $_SESSION['username'];

    $nombreUsuarioQuery = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($nombreUsuarioQuery);
    $stmt->bind_param("s", $idUsuario); 
    $stmt->execute();

    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
        $nombreUsuario = $row["nombre"];
    } else {
        echo "No se encontró un usuario con el ID proporcionado.";
    }
} else {
    echo "No se proporcionó un ID de usuario.";
}

    $nombre_maquina = isset($_SESSION['nombre_maquina']) ? $_SESSION['nombre_maquina'] : 'Nombre de la Máquina No Disponible';
    $maquina_id = isset($_SESSION['maquina_id']) ? $_SESSION['maquina_id'] : 'ID de la Máquina No Disponible';

    //echo "<p>Nombre de la máquina: $nombre_maquina</p>";
    //Estados y demas
    $EstadoEquipo = isset($_POST['equipo']) ? test_input($_POST['equipo']) : '';
    $Observaciones_EstadoEquipo = isset($_POST['observacionesEquipo']) ? test_input($_POST['observacionesEquipo']) : '';

    $Nivel_Aceite_Centralina = isset($_POST['NivelAceiteCentralina']) ? test_input($_POST['NivelAceiteCentralina']) : '';
    $Observaciones_Nivel_Aceite_Centralina = isset($_POST['observacionesNivelAceiteCentralina']) ? test_input($_POST['observacionesNivelAceiteCentralina']) : '';
    
    $Revisar_Conexiones = isset($_POST['RevisarConexiones']) ? test_input($_POST['RevisarConexiones']) : '';
    $Observaciones_Revisar_Conexiones = isset($_POST['observacionesRevisarConexiones']) ? test_input($_POST['observacionesRevisarConexiones']) : '';

    $Arranque_Motor_Centralina = isset($_POST['ArranqueMotorCentralina']) ? test_input($_POST['ArranqueMotorCentralina']) : '';
    $Observaciones_Arranque_Motor_Centralina = isset($_POST['observacionesArranqueMotorCentralina']) ? test_input($_POST['observacionesArranqueMotorCentralina']) : '';

    $Revision_Bomba_Trabajando = isset($_POST['BombaTrabajando']) ? test_input($_POST['BombaTrabajando']) : '';
    $Observaciones_Revision_Bomba_Trabajando = isset($_POST['observacionesBombaTrabajando']) ? test_input($_POST['observacionesBombaTrabajando']) : '';
   
    $Revision_Movimientos = isset($_POST['RevisionMovimientos']) ? test_input($_POST['RevisionMovimientos']) : '';
    $Observaciones_Revision_Movimientos = isset($_POST['observacionesRevisionMovimientos']) ? test_input($_POST['observacionesRevisionMovimientos']) : '';

    $Fugas = isset($_POST['Fugas']) ? test_input($_POST['Fugas']) : '';
    $Observaciones_Fugas = isset($_POST['observacionesFugas']) ? test_input($_POST['observacionesFugas']) : '';

    $Ruidos_Extraños = isset($_POST['RuidosExtraños']) ? test_input($_POST['RuidosExtraños']) : '';
    $Observaciones_Ruidos_Extraños = isset($_POST['observacionesRuidosExtraños']) ? test_input($_POST['observacionesRuidosExtraños']) : '';

    $Inspeccion_General_Equipo = isset($_POST['InspeccionGeneralEquipo']) ? test_input($_POST['InspeccionGeneralEquipo']) : '';
    $Observaciones_Inspeccion_General_Equipo = isset($_POST['observacionesInspeccionGeneralEquipo']) ? test_input($_POST['observacionesInspeccionGeneralEquipo']) : '';

    $Movimiento_Motor_Regreso = isset($_POST['MovimientoMotorRegreso']) ? test_input($_POST['MovimientoMotorRegreso']) : '';
    $Observaciones_Movimiento_Motor_Regreso = isset($_POST['observacionesMovimientoMotorRegreso']) ? test_input($_POST['observacionesMovimientoMotorRegreso']) : '';

    $Estado_Conexiones_Quitar = isset($_POST['EstadoConexionesQuitar']) ? test_input($_POST['EstadoConexionesQuitar']) : '';
    $Observaciones_Estado_Conexiones_Quitar = isset($_POST['observacionesEstadoConexionesQuitar']) ? test_input($_POST['observacionesEstadoConexionesQuitar']) : '';

    $horometroInicial = isset($_POST['horometroInicial']) ? test_input($_POST['horometroInicial']):'';
    $observacionesHorometroInicial =isset($_POST['observacionesHorometroInicial']) ? test_input($_POST['observacionesHorometroInicial']) : '';

    $horometroFinal = isset($_POST['horometroFinal']) ? test_input($_POST['horometroFinal']):'';
    $observacionesHorometroFinal =isset($_POST['observacionesHorometroFinal']) ? test_input($_POST['observacionesHorometroFinal']) : '';
    
    $observacionesAdicionales =isset($_POST['observacionesAdicionales']) ? test_input($_POST['observacionesAdicionales']) : '';

    $turno = 'Vespertino';
    
    $fechaActual = date('Ymd');




// Verificar que los campos obligatorios no estén vacíos
if (empty($EstadoEquipo) || empty($Nivel_Aceite_Centralina)|| empty($Revisar_Conexiones)
|| empty($Arranque_Motor_Centralina)|| empty($Revision_Bomba_Trabajando)|| empty($Revision_Movimientos)
|| empty($Fugas)|| empty($Ruidos_Extraños)|| empty($Inspeccion_General_Equipo)
|| empty($Movimiento_Motor_Regreso)|| empty($Estado_Conexiones_Quitar)
|| empty($horometroInicial)|| empty($horometroFinal)




) {
    echo '<script>alert("Todos los campos son obligatorios. Por favor, completa el formulario.");';
    echo 'window.location.href = "agregar_reporte_Vespertino.php";</script>';
} else {
    // Inserción de datos en la base de datos
    $sql = "CALL InsertarDatosPerforadora(
            '$nombre_maquina', 
            '$nombreUsuario',
            '$turno',
            '$EstadoEquipo',
            '$Nivel_Aceite_Centralina',
            '$Revisar_Conexiones',
            '$Arranque_Motor_Centralina',
            '$Revision_Bomba_Trabajando',
            '$Revision_Movimientos',
            '$Fugas',
            '$Ruidos_Extraños',
            '$Inspeccion_General_Equipo',
            '$Movimiento_Motor_Regreso',
            '$Estado_Conexiones_Quitar',
            '$horometroInicial',
            '$horometroFinal',
            '$Observaciones_EstadoEquipo',
            '$Observaciones_Nivel_Aceite_Centralina',
            '$Observaciones_Revisar_Conexiones',
            '$Observaciones_Arranque_Motor_Centralina',
            '$Observaciones_Revision_Bomba_Trabajando',
            '$Observaciones_Revision_Movimientos',
            '$Observaciones_Fugas',
            '$Observaciones_Ruidos_Extraños',
            '$Observaciones_Inspeccion_General_Equipo',
            '$Observaciones_Movimiento_Motor_Regreso',
            '$Observaciones_Estado_Conexiones_Quitar',
            '$observacionesHorometroInicial',
            '$observacionesHorometroFinal',
            '$observacionesAdicionales',
            '$fechaActual',
            '$maquina_id'
              )";

        $sqlReportes="CALL InsertarDatosVespertinos(
            '$maquina_id',
            '$nombreUsuario',
            '$fechaActual',
            '$turno'
        )";




        try {
            // Ejecutar la primera consulta
            if ($conn->query($sql) === TRUE) {
                // Ejecutar la segunda consulta
                if ($conn->query($sqlReportes) === TRUE) {
                    echo '<script>
                    alert("Registro guardado correctamente.");
                    window.location.href = "perforadoras_principal.php";
                  </script>';
                } else {
                    // Manejar errores en la segunda consulta
                    echo "Error: " . $conn->error . "<br>";
                }
            } else {
                // Manejar errores en la primera consulta
                echo "Error:  " . $conn->error . "<br>";
            }
        } catch (Exception $e) {
            // Manejar errores generales
            echo "Error En Consultar: " . $e->getMessage() . "<br>";
            echo "Error Code: " . $e->getCode() . "<br>";
        }
        
}





// Cerrar conexión
$conn->close();
?>
