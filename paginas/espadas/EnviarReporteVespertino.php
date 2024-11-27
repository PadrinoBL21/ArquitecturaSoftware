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
    $Ajuste_Hoja = isset($_POST['AjusteHoja']) ? test_input($_POST['AjusteHoja']) : '';
    $Observaciones_Ajuste_Hoja= isset($_POST['observacionesAjusteHoja']) ? test_input($_POST['observacionesAjusteHoja']) : '';

    $Ajuste_Wideas = isset($_POST['AjusteWideas']) ? test_input($_POST['AjusteWideas']) : '';
    $Observaciones_Ajuste_Wideas = isset($_POST['observacionesAjusteWideas']) ? test_input($_POST['observacionesAjusteWideas']) : '';
    
    $Estado_Control_Botones = isset($_POST['EstadoControlBotones']) ? test_input($_POST['EstadoControlBotones']) : '';
    $Observaciones_Estado_Control_Botones = isset($_POST['observacionesEstadoControlBotones']) ? test_input($_POST['observacionesEstadoControlBotones']) : '';

    $Engrasar_Tren_Avance = isset($_POST['EngrasarTrenAvance']) ? test_input($_POST['EngrasarTrenAvance']) : '';
    $Observaciones_Engrasar_Tren_Avance = isset($_POST['observacionesEngrasarTrenAvance']) ? test_input($_POST['observacionesEngrasarTrenAvance']) : '';

    $Revision_Nivel_Aceite = isset($_POST['RevisionNivelAceite']) ? test_input($_POST['RevisionNivelAceite']) : '';
    $Observaciones_Revision_Nivel_Aceite = isset($_POST['observacionesRevisionNivelAceite']) ? test_input($_POST['observacionesRevisionNivelAceite']) : '';
   
    $Ruidos_Extraños_Encender = isset($_POST['RudosExtraños']) ? test_input($_POST['RudosExtraños']) : '';
    $Observaciones_Ruidos_Extraños_Encender = isset($_POST['observacionesRudosExtraños']) ? test_input($_POST['observacionesRudosExtraños']) : '';

    $Movimientos_Espada = isset($_POST['MoviminetosEspada']) ? test_input($_POST['MoviminetosEspada']) : '';
    $Observaciones_Movimientos_Espada = isset($_POST['observacionesMoviminetosEspada']) ? test_input($_POST['observacionesMoviminetosEspada']) : '';

    $Ruidos_Extraños_Antes_Apagar = isset($_POST['RudosExtrañosApagar']) ? test_input($_POST['RudosExtrañosApagar']) : '';
    $Observaciones_Ruidos_Extraños_Antes_Apagar = isset($_POST['observacionesRudosExtrañosApagar']) ? test_input($_POST['observacionesRudosExtrañosApagar']) : '';

    $InspeccionGeneralEquipo = isset($_POST['InspeccionGeneralEquipo']) ? test_input($_POST['InspeccionGeneralEquipo']) : '';
    $Observaciones_InspeccionGeneralEquipo = isset($_POST['observacionesInspeccionGeneralEquipo']) ? test_input($_POST['observacionesInspeccionGeneralEquipo']) : '';

    $Limpiar_Cadena = isset($_POST['LimpiarCadena']) ? test_input($_POST['LimpiarCadena']) : '';
    $Observaciones_Limpiar_Cadena = isset($_POST['observacionesLimpiarCadena']) ? test_input($_POST['observacionesLimpiarCadena']) : '';

    $Enfriamiento_Motor = isset($_POST['EnfriamientoMotor']) ? test_input($_POST['EnfriamientoMotor']) : '';
    $Observaciones_Enfriamiento_Motor = isset($_POST['observacionesEnfriamientoMotor']) ? test_input($_POST['observacionesEnfriamientoMotor']) : '';

    $Limpieza_Exterior_Equipo = isset($_POST['LimpiezaExteriorEquipo']) ? test_input($_POST['LimpiezaExteriorEquipo']) : '';
    $Observaciones_Limpieza_Exterior_Equipo = isset($_POST['observacionesLimpiezaExteriorEquipo']) ? test_input($_POST['observacionesLimpiezaExteriorEquipo']) : '';

    $horometroInicial = isset($_POST['horometroInicial']) ? test_input($_POST['horometroInicial']):'';
    $observacionesHorometroInicial =isset($_POST['observacionesHorometroInicial']) ? test_input($_POST['observacionesHorometroInicial']) : '';

    $horometroFinal = isset($_POST['horometroFinal']) ? test_input($_POST['horometroFinal']):'';
    $observacionesHorometroFinal =isset($_POST['observacionesHorometroFinal']) ? test_input($_POST['observacionesHorometroFinal']) : '';
    
    $observacionesAdicionales =isset($_POST['observacionesAveriasEncontradasMomento']) ? test_input($_POST['observacionesAveriasEncontradasMomento']) : '';

    $turno = 'Vespertino';
    
    $fechaActual = date('Ymd');




// Verificar que los campos obligatorios no estén vacíos
if (empty($Ajuste_Hoja) || empty($Ajuste_Wideas)|| empty($Estado_Control_Botones)
|| empty($Engrasar_Tren_Avance)|| empty($Revision_Nivel_Aceite)|| empty($Ruidos_Extraños_Encender)
|| empty($Movimientos_Espada)|| empty($Ruidos_Extraños_Antes_Apagar)|| empty($InspeccionGeneralEquipo)
|| empty($Limpiar_Cadena)|| empty($Enfriamiento_Motor)|| empty($Limpieza_Exterior_Equipo)
|| empty($horometroInicial)|| empty($horometroFinal)




) {
    echo '<script>alert("Todos los campos son obligatorios. Por favor, completa el formulario.");';
    echo 'window.location.href = "agregar_reporte_vespertino.php";</script>';
} else {
    // Inserción de datos en la base de datos
    $sql = "CALL InsertarEspada(
            '$nombre_maquina', 
            '$nombreUsuario',
            '$turno',
            '$Ajuste_Hoja',
            '$Ajuste_Wideas',
            '$Estado_Control_Botones',
            '$Engrasar_Tren_Avance',
            '$Revision_Nivel_Aceite',
            '$Ruidos_Extraños_Encender',
            '$Movimientos_Espada',
            '$Ruidos_Extraños_Antes_Apagar',
            '$InspeccionGeneralEquipo',
            '$Limpiar_Cadena',
            '$Enfriamiento_Motor',
            '$Limpieza_Exterior_Equipo',
            '$horometroInicial',
            '$horometroFinal',
            
            '$Observaciones_Ajuste_Hoja',
            '$Observaciones_Ajuste_Wideas',
            '$Observaciones_Estado_Control_Botones',
            '$Observaciones_Engrasar_Tren_Avance',
            '$Observaciones_Revision_Nivel_Aceite',
            '$Observaciones_Ruidos_Extraños_Encender',
            '$Observaciones_Movimientos_Espada',
            '$Observaciones_Ruidos_Extraños_Antes_Apagar',
            '$Observaciones_InspeccionGeneralEquipo',
            '$Observaciones_Limpiar_Cadena',
            '$Observaciones_Enfriamiento_Motor',
            '$Observaciones_Limpieza_Exterior_Equipo',
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
                    window.location.href = "espadas_principal.php";
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

