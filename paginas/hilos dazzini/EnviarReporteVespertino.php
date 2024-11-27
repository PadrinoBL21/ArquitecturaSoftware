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
    $ControlBotones = isset($_POST['ControlBotonoes']) ? test_input($_POST['ControlBotonoes']) : '';
    $observacionesControlBotones = isset($_POST['observacionesControlBotonoes']) ? test_input($_POST['observacionesControlBotonoes']) : '';

    $RevisionMovimientosAvance = isset($_POST['RevisionMovimientosAvanze']) ? test_input($_POST['RevisionMovimientosAvanze']) : '';
    $observacionesRevisionMovimientosAvance = isset($_POST['observacionesRevisionMovimientosAvanze']) ? test_input($_POST['observacionesRevisionMovimientosAvanze']) : '';
    
    $RevisionGirosMotor = isset($_POST['RevisarGirosMotor']) ? test_input($_POST['RevisarGirosMotor']) : '';
    $observacionesRevisarGirosMotor = isset($_POST['observacionesRevisarGirosMotor']) ? test_input($_POST['observacionesRevisarGirosMotor']) : '';

    $RevisionMovimientosPolea = isset($_POST['RevivarMovimientosPolea']) ? test_input($_POST['RevivarMovimientosPolea']) : '';
    $observacionesRevisarMovimientosPolea = isset($_POST['observacionesRevivarMovimientosPolea']) ? test_input($_POST['observacionesRevivarMovimientosPolea']) : '';

    $LimpiezaClavijas = isset($_POST['LimpiezaClavijas']) ? test_input($_POST['LimpiezaClavijas']) : '';
    $observacionesLimpiezaClavijas = isset($_POST['observacionesLimpiezaClavijas']) ? test_input($_POST['observacionesLimpiezaClavijas']) : '';
   
    $InteriorExteriorCarro = isset($_POST['InteriorExteriorCarro']) ? test_input($_POST['InteriorExteriorCarro']) : '';
    $observacionesInteriorExteriorCarro = isset($_POST['observacionesInteriorExteriorCarro']) ? test_input($_POST['observacionesInteriorExteriorCarro']) : '';

    $EngrasarBastagos = isset($_POST['EngrasarBastagos']) ? test_input($_POST['EngrasarBastagos']) : '';
    $observacionesEngrasarBastagos = isset($_POST['observacionesEngrasarBastagos']) ? test_input($_POST['observacionesEngrasarBastagos']) : '';

    $InspeccionGeneralEquipo = isset($_POST['InspeccionGeneralEquipo']) ? test_input($_POST['InspeccionGeneralEquipo']) : '';
    $observacioesInspecionGeneral = isset($_POST['observacionesInspeccionGeneralEquipo']) ? test_input($_POST['observacionesInspeccionGeneralEquipo']) : '';

    $EstadoConexionesQuitar = isset($_POST['EstadoConexionesAlQuitar']) ? test_input($_POST['EstadoConexionesAlQuitar']) : '';
    $observacionesConexionesQuitar = isset($_POST['observacionesEstadoConexionesAlQuitar']) ? test_input($_POST['observacionesEstadoConexionesAlQuitar']) : '';

    $RuidosExtraños = isset($_POST['RuidosExtraños']) ? test_input($_POST['RuidosExtraños']) : '';
    $observacionesRuidosExtraños = isset($_POST['observacionesRuidosExtraños']) ? test_input($_POST['observacionesRuidosExtraños']) : '';


    $horometroInicial = isset($_POST['horometroInicial']) ? test_input($_POST['horometroInicial']):'';
    $observacionesHorometroInicial =isset($_POST['observacionesHorometroInicial']) ? test_input($_POST['observacionesHorometroInicial']) : '';

    $horometroFinal = isset($_POST['horometroFinal']) ? test_input($_POST['horometroFinal']):'';
    $observacionesHorometroFinal =isset($_POST['observacionesHorometroFinal']) ? test_input($_POST['observacionesHorometroFinal']) : '';
    
    $observacionesAdicionales =isset($_POST['observacionesAdicionales']) ? test_input($_POST['observacionesAdicionales']) : '';


    $turno = 'Vespertino';
    
    $fechaActual = date('Ymd');




// Verificar que los campos obligatorios no estén vacíos
if (empty($ControlBotones) || empty($RevisionMovimientosAvance)|| empty($RevisionGirosMotor)
|| empty($RevisionMovimientosPolea)|| empty($LimpiezaClavijas)|| empty($InteriorExteriorCarro)
|| empty($EngrasarBastagos)|| empty($InspeccionGeneralEquipo)|| empty($EstadoConexionesQuitar)
|| empty($RuidosExtraños)|| empty($horometroInicial)|| empty($horometroFinal)




) {
    echo '<script>alert("Todos los campos son obligatorios. Por favor, completa el formulario.");';
    echo 'window.location.href = "agregar_reporte_vespertino.php";</script>';
} else {
    // Inserción de datos en la base de datos
    $sql = "CALL InsertarHiloDazzini(
            '$nombre_maquina', 
            '$nombreUsuario',
            '$turno',
            '$ControlBotones',
            '$RevisionMovimientosAvance',
            '$RevisionMovimientosPolea',
            '$RevisionGirosMotor',
            '$LimpiezaClavijas',
            '$InteriorExteriorCarro',
            '$EngrasarBastagos',
            '$RuidosExtraños',
            '$InspeccionGeneralEquipo',
            '$EstadoConexionesQuitar',
            '$horometroInicial',
            '$horometroFinal',
            '$observacionesControlBotones',
            '$observacionesRevisionMovimientosAvance',
            '$observacionesRevisarMovimientosPolea',
            '$observacionesRevisarGirosMotor',
            '$observacionesLimpiezaClavijas',
            '$observacionesInteriorExteriorCarro',
            '$observacionesEngrasarBastagos',
            '$observacionesRuidosExtraños',
            '$observacioesInspecionGeneral',
            '$observacionesConexionesQuitar',
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
                    window.location.href = "hilos_dazzini_principal.php";
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

