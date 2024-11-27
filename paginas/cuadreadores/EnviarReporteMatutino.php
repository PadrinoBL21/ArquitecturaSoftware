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
    $estadoRielRuedas = isset($_POST['RielRuedasPoleas']) ? test_input($_POST['RielRuedasPoleas']) : '';
    $RuidosExtrañosMotor = isset($_POST['RuidosExtrañosMotor']) ? test_input($_POST['RuidosExtrañosMotor']) : '';
    $ControlBotonoes = isset($_POST['ControlBotonoes']) ? test_input($_POST['ControlBotonoes']) : '';
    $LimpiezaClavijas = isset($_POST['LimpiezaClavijas']) ? test_input($_POST['LimpiezaClavijas']) : '';
    $Motor = isset($_POST['Motor']) ? test_input($_POST['Motor']) : '';
    $Riel = isset($_POST['Riel']) ? test_input($_POST['Riel']) : '';
    //Maquina Encendida
    $InspeccionGeneralEquipo = isset($_POST["InspeccionGeneralEquipo"])? $_POST["InspeccionGeneralEquipo"]:'';
    // Horometro
    $EstadoConexionesAlQuitar = isset($_POST['EstadoConexionesAlQuitar']) ? test_input($_POST['EstadoConexionesAlQuitar']):'';
    //Observaciones
    $observacionesRielRuedasPoleas = isset($_POST['observacionesRielRuedasPoleas']) ? test_input($_POST['observacionesRielRuedasPoleas']) : '';
    $observacionesRuidosExtrañosMotor = isset($_POST['observacionesRuidosExtrañosMotor']) ? test_input($_POST['observacionesRuidosExtrañosMotor']) : '';
    $observacionesControlBotonoes = isset($_POST['observacionesControlBotonoes']) ? test_input($_POST['observacionesControlBotonoes']) : '';
    $observacionesLimpiezaClavijas = isset($_POST['observacionesLimpiezaClavijas']) ? test_input($_POST['observacionesLimpiezaClavijas']) : '';
    $observacionesMotor = isset($_POST['observacionesMotor']) ? test_input($_POST['observacionesMotor']) : '';
    $observacionesRiel = isset($_POST['observacionesRiel']) ? test_input($_POST['observacionesRiel']) : '';
    $observacionesInspeccionGeneralEquipo = isset($_POST['observacionesInspeccionGeneralEquipo']) ? test_input($_POST['observacionesInspeccionGeneralEquipo']) : '';
    $observacionesEstadoConexionesAlQuitar =isset($_POST['observacionesEstadoConexionesAlQuitar']) ? test_input($_POST['observacionesEstadoConexionesAlQuitar']) : '';

    $observacionesAveriasEncontradasMomento =isset($_POST['observacionesAveriasEncontradasMomento']) ? test_input($_POST['observacionesAveriasEncontradasMomento']) : '';
    $turno = 'Matutino';

    
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
if (empty($estadoRielRuedas) || empty($RuidosExtrañosMotor)|| empty($ControlBotonoes)
|| empty($LimpiezaClavijas)|| empty($Motor)|| empty($Riel)
|| empty($InspeccionGeneralEquipo)|| empty($EstadoConexionesAlQuitar)




) {
    echo '<script>alert("Todos los campos son obligatorios. Por favor, completa el formulario.");';
    echo 'window.location.href = "agregar_reporte_matutino.php";</script>';
} else {
    // Inserción de datos en la base de datos
    $sql = "CALL InsertarDatosCuadreador(
            '$nombre_maquina', 
            '$nombreUsuario',
            '$turno',
            '$estadoRielRuedas',
            '$RuidosExtrañosMotor',
            '$ControlBotonoes',
            '$LimpiezaClavijas',
            '$Motor',
            '$Riel',
            '$InspeccionGeneralEquipo',
            '$EstadoConexionesAlQuitar',
            '$observacionesRielRuedasPoleas',
            '$observacionesRuidosExtrañosMotor',
            '$observacionesControlBotonoes',
            '$observacionesLimpiezaClavijas',
            '$observacionesMotor',
            '$observacionesRiel',
            '$observacionesInspeccionGeneralEquipo',
            '$observacionesEstadoConexionesAlQuitar',
            '$observacionesAveriasEncontradasMomento',
            '$fechaActual',
            '$maquina_id'
              )";

        $sqlReportes="CALL InsertarDatosMatutinos(
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
                    window.location.href = "cuadreadores_principal.php";
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

