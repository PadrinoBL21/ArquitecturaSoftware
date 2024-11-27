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
    $estadoEquipo = isset($_POST['equipo']) ? test_input($_POST['equipo']) : '';
    $estadoAceiteMotor = isset($_POST['aceiteMotor']) ? test_input($_POST['aceiteMotor']) : '';
    $estadoAnticongelante = isset($_POST['anticongelante']) ? test_input($_POST['anticongelante']) : '';
    $estadoBaterías = isset($_POST['Baterías']) ? test_input($_POST['Baterías']) : '';
    $estadoNivelAceitaUnidadCompresion = isset($_POST['aceiteCompresion']) ? test_input($_POST['aceiteCompresion']) : '';
    $estadoFugas = isset($_POST['Fugas']) ? test_input($_POST['Fugas']) : '';
    //Maquina Encendida
    $estadoRuidosExtraños = isset($_POST["RudosExtraños"])? $_POST["RudosExtraños"]:'';
    // Horometro
    $horometroInicial = isset($_POST['horometroInicial']) ? test_input($_POST['horometroInicial']):'';
    $horometroFinal = isset($_POST['horometroFinal']) ? test_input($_POST['horometroFinal']):'';
    //Observaciones
    $observacionesEquipo = isset($_POST['observacionesEquipo']) ? test_input($_POST['observacionesEquipo']) : '';
    $observacionesAceiteMotor = isset($_POST['observacionesAceiteMotor']) ? test_input($_POST['observacionesAceiteMotor']) : '';
    $observacionesAnticongelante = isset($_POST['observacionesanticongelante']) ? test_input($_POST['observacionesanticongelante']) : '';
    $observacionesBaterías = isset($_POST['observacionesBaterías']) ? test_input($_POST['observacionesBaterías']) : '';
    $observacionesNivelAceitaUnidadCompresion = isset($_POST['observacionesaceiteCompresion']) ? test_input($_POST['observacionesaceiteCompresion']) : '';
    $observacionesFugas = isset($_POST['observacionesFugas']) ? test_input($_POST['observacionesFugas']) : '';
    $observacionesRuidosExtraños = isset($_POST['observacionesRudosExtraños']) ? test_input($_POST['observacionesRudosExtraños']) : '';
    //Horometro
    $observacionesAdicionales =isset($_POST['observacionesAdicionales']) ? test_input($_POST['observacionesAdicionales']) : '';
    $observacionesHorometroInicial =isset($_POST['observacionesHorometroInicial']) ? test_input($_POST['observacionesHorometroInicial']) : '';
    $observacionesHorometroFinal =isset($_POST['observacionesHorometroFinal']) ? test_input($_POST['observacionesHorometroFinal']) : '';
    $turno = 'Vespertino';
    /*
    $CambiarFiltros = isset($_POST['CambiarFiltros']) ? test_input($_POST['CambiarFiltros']) : '';
    $RevisarMangueras = isset($_POST['RevisarMangueras']) ? test_input($_POST['RevisarMangueras']) : '';
    $EngrasarTazas_Pernos_Gatos = isset($_POST['EngrasarTazas_Pernos_Gatos']) ? test_input($_POST['EngrasarTazas_Pernos_Gatos']) : '';
    $RevisarSistemaElectrico_Marcha = isset($_POST['RevisarSistemaElectrico_Marcha']) ? test_input($_POST['RevisarSistemaElectrico_Marcha']) : '';
    $RevisarSistema_Avance = isset($_POST['RevisarSistema_Avance']) ? test_input($_POST['RevisarSistema_Avance']) : '';
    $RevisarNivelesFluidoGeneral = isset($_POST['RevisarNivelesFluidoGeneral']) ? test_input($_POST['RevisarNivelesFluidoGeneral']) : '';
        //ObservacionesUltimaTabla
    $observacionesCambiarFiltros =isset($_POST['observacionesCambiarFiltros']) ? test_input($_POST['observacionesCambiarFiltros']) : '';
    $observacionesRevisarMangueras =isset($_POST['observacionesRevisarMangueras']) ? test_input($_POST['observacionesRevisarMangueras']) : '';
    $observacionesEngrasarTazas_Pernos_Gatos =isset($_POST['observacionesEngrasarTazas_Pernos_Gatos']) ? test_input($_POST['observacionesEngrasarTazas_Pernos_Gatos']) : '';
    $observacionesRevisarSistemaElectrico_Marcha =isset($_POST['observacionesRevisarSistemaElectrico_Marcha']) ? test_input($_POST['observacionesRevisarSistemaElectrico_Marcha']) : '';
    $observacionesRevisarSistema_Avance =isset($_POST['observacionesRevisarSistema_Avance']) ? test_input($_POST['observacionesRevisarSistema_Avance']) : '';
    $observacionesRevisarNivelesFluidoGeneral =isset($_POST['observacionesRevisarNivelesFluidoGeneral']) ? test_input($_POST['observacionesRevisarNivelesFluidoGeneral']) : '';
    $AveriasMomentoSistema = isset($_POST['observacionesAveriasEncontradasMomento']) ? test_input($_POST['observacionesAveriasEncontradasMomento']) : '';*/
    $fechaActual = date('Ymd');




// Verificar que los campos obligatorios no estén vacíos
if (empty($estadoEquipo) || empty($estadoAceiteMotor)|| empty($estadoAnticongelante)
|| empty($estadoBaterías)|| empty($estadoNivelAceitaUnidadCompresion)|| empty($estadoFugas)
|| empty($estadoRuidosExtraños)|| empty($horometroInicial)|| empty($horometroFinal)




) {
    echo '<script>alert("Todos los campos son obligatorios. Por favor, completa el formulario.");';
    echo 'window.location.href = "agregar_reporte_vespertino.php";</script>';
} else {
    // Inserción de datos en la base de datos
    $sql = "CALL InsertarDatosCompresor(
            '$nombre_maquina', 
            '$nombreUsuario',
            '$turno',
            '$estadoEquipo',
            '$estadoAceiteMotor',
            '$estadoAnticongelante',
            '$estadoNivelAceitaUnidadCompresion',
            '$estadoFugas',
            '$estadoRuidosExtraños',
            '$estadoBaterías',
            '$horometroInicial',
            '$horometroFinal',
            '$observacionesEquipo',
            '$observacionesAceiteMotor',
            '$observacionesAnticongelante',
            '$observacionesNivelAceitaUnidadCompresion',
            '$observacionesFugas',
            '$observacionesRuidosExtraños',
            '$observacionesBaterías',
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
                    window.location.href = "compresores_principal.php";
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

