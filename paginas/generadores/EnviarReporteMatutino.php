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
    $NivelAceiteMotor = isset($_POST['aceiteMotor']) ? test_input($_POST['aceiteMotor']) : '';
    $NivelAnticongelante = isset($_POST['anticongelante']) ? test_input($_POST['anticongelante']) : '';
    $Baterias = isset($_POST['Baterías']) ? test_input($_POST['Baterías']) : '';
    $Fugas = isset($_POST['Fugas']) ? test_input($_POST['Fugas']) : '';
    $RuidosExtraños = isset($_POST['RudosExtraños']) ? test_input($_POST['RudosExtraños']) : '';
    $horometroFinal = isset($_POST['horometroFinal']) ? test_input($_POST['horometroFinal']) : '';
    $horometroInicial = isset($_POST['horometroInicial']) ? test_input($_POST['horometroInicial']) : '';


    //Observaciones
    $ObservacinesEstadoEquipo = isset($_POST['observacionesEquipo']) ? test_input($_POST['observacionesEquipo']) : '';
    $ObservacionesNivelAceiteMotor = isset($_POST['observacionesAceiteMotor']) ? test_input($_POST['observacionesAceiteMotor']) : '';
    $ObservacionesNivelAnticongelante = isset($_POST['observacionesanticongelante']) ? test_input($_POST['observacionesanticongelante']) : '';
    $ObservacionesBaterias = isset($_POST['observacionesBaterías']) ? test_input($_POST['observacionesBaterías']) : '';
    $ObservacionesFugas = isset($_POST['observacionesFugas']) ? test_input($_POST['observacionesFugas']) : '';
    $ObservacionesRuidosExtraños = isset($_POST['observacionesRudosExtraños']) ? test_input($_POST['observacionesRudosExtraños']) : '';
    $ObservacionesHorometroInicial =isset($_POST['observacionesHorometroInicial']) ? test_input($_POST['observacionesHorometroInicial']) : '';
    $ObservacionesHorometroFinal =isset($_POST['observacionesHorometroFinal']) ? test_input($_POST['observacionesHorometroFinal']) : '';
    $ObservacionesAdicionales =isset($_POST['observacionesAveriasEncontradasMomento']) ? test_input($_POST['observacionesAveriasEncontradasMomento']) : '';

    
    $turno = 'Matutino';
    $fechaActual = date('Ymd');




// Verificar que los campos obligatorios no estén vacíos
if (empty($estadoEquipo) 
|| empty($NivelAceiteMotor)|| empty($NivelAnticongelante)
|| empty($Baterias)|| empty($Fugas)|| empty($RuidosExtraños)
|| empty($horometroFinal)|| empty($horometroInicial)



) {
    echo '<script>alert("Todos los campos son obligatorios. Por favor, completa el formulario.");';
    echo 'window.location.href = "agregar_reporte_matutino.php";</script>';
} else {
    // Inserción de datos en la base de datos
    $sql = "CALL insercionDatosGenerador(
            '$nombre_maquina', 
            '$nombreUsuario',
            '$turno',
            '$estadoEquipo',
            '$NivelAceiteMotor',
            '$NivelAnticongelante', 
            '$Baterias', 
            '$RuidosExtraños', 
            '$Fugas', 
            '$horometroInicial', 
            '$horometroFinal',
            '$ObservacinesEstadoEquipo',
            '$ObservacionesNivelAceiteMotor',
            '$ObservacionesNivelAnticongelante',
            '$ObservacionesBaterias',
            '$ObservacionesRuidosExtraños',
            '$ObservacionesFugas',
            '$ObservacionesHorometroInicial',
            '$ObservacionesHorometroFinal',
            '$ObservacionesAdicionales',
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
                    window.location.href = "generadores_principal.php";
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

