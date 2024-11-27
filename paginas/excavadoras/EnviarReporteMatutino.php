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
    $estadoEsqueleto = isset($_POST['esqueleto']) ? test_input($_POST['esqueleto']) : '';
    $estadoAceiteMotor = isset($_POST['aceiteMotor']) ? test_input($_POST['aceiteMotor']) : '';
    $estadoAceiteHidraulico = isset($_POST['aceiteHidraulico']) ? test_input($_POST['aceiteHidraulico']) : '';
    $estadoAnticongelante = isset($_POST['anticongelante']) ? test_input($_POST['anticongelante']) : '';
    $estadoBaterías = isset($_POST['Baterías']) ? test_input($_POST['Baterías']) : '';
    $estadoLuces = isset($_POST['Luces']) ? test_input($_POST['Luces']) : '';
    $CadenaAvance = isset($_POST['CadenaAvance']) ? test_input($_POST['CadenaAvance']) : '';
    $estadoBandaAlternadorVentilador = isset($_POST['bandaAlternadorVentilador']) ? test_input($_POST['bandaAlternadorVentilador']) : '';
    //Maquina Encendida
    $estadoFugasME = isset($_POST["FugasME"])? $_POST["FugasME"]:'';
    //Maquina Trabajando
    $MovimientosVelocidad = isset($_POST['Movimientos_Velocidad']) ? test_input($_POST['Movimientos_Velocidad']) : '';
    $estadoPresionMotorMT = isset($_POST['PresionMotorMT']) ? test_input($_POST['PresionMotorMT']) : '';
    $estadoTemperaturaMotorMT = isset($_POST['TemperaturaMotorMT']) ? test_input($_POST['TemperaturaMotorMT']) : '';
    // Horometro
    $horometroInicial = isset($_POST['horometroInicial']) ? test_input($_POST['horometroInicial']):'';
    $horometroFinal = isset($_POST['horometroFinal']) ? test_input($_POST['horometroFinal']):'';
    //Observaciones
    $observacionesEsqueleto = isset($_POST['observacionesEsqueleto']) ? test_input($_POST['observacionesEsqueleto']) : '';
    $observacionesAceiteMotor = isset($_POST['observacionesAceiteMotor']) ? test_input($_POST['observacionesAceiteMotor']) : '';
    $observacionesAceiteHidraulico = isset($_POST['observacionesAceiteHidraulico']) ? test_input($_POST['observacionesAceiteHidraulico']) : '';
    $observacionesAnticongelante = isset($_POST['observacionesanticongelante']) ? test_input($_POST['observacionesanticongelante']) : '';
    $observacionesBaterías = isset($_POST['observacionesBaterías']) ? test_input($_POST['observacionesBaterías']) : '';
    $observacionesLuces = isset($_POST['observacionesLuces']) ? test_input($_POST['observacionesLuces']) : '';
    $observacionesCadenaAvance = isset($_POST['observacionesCadenaAvance']) ? test_input($_POST['observacionesCadenaAvance']) : '';
    $observacionesBandaAlternadorVentilador = isset($_POST['observacionesbandaAlternadorVentilador']) ? test_input($_POST['observacionesbandaAlternadorVentilador']) : '';
    //Maquina Encendida
    $observacionesFugasME = isset($_POST['observacionesFugasME']) ? test_input($_POST['observacionesFugasME']) : '';

    //Maquina Trabajando
    $observaciones_Movimientos_Velocidad = isset($_POST['observacionesMovimientos_Velocidad']) ? test_input($_POST['observacionesMovimientos_Velocidad']) : '';
    $observacionesPresionMotorMT = isset($_POST['observacionesPresionMotorMT']) ? test_input($_POST['observacionesPresionMotorMT']) : '';
    $observacionesTemperaturaMotorMT = isset($_POST['observacionesTemperaturaMotorMT']) ? test_input($_POST['observacionesTemperaturaMotorMT']) : '';


    //Horometro
    $observacionesHorometroInicial =isset($_POST['observacionesHorometroInicial']) ? test_input($_POST['observacionesHorometroInicial']) : '';
    $observacionesHorometroFinal =isset($_POST['observacionesHorometroFinal']) ? test_input($_POST['observacionesHorometroFinal']) : '';
    $observacionesAdicionales =isset($_POST['observacionesAdicionales']) ? test_input($_POST['observacionesAdicionales']) : '';

    
    $turno = 'Matutino';
    $fechaActual = date('Ymd');




// Verificar que los campos obligatorios no estén vacíos
if (empty($estadoEsqueleto) 
|| empty($estadoAceiteMotor)|| empty($estadoAceiteHidraulico)
|| empty($estadoAnticongelante)|| empty($estadoBaterías)|| empty($estadoLuces)
|| empty($CadenaAvance)|| empty($estadoBandaAlternadorVentilador)
|| empty($estadoFugasME)|| empty($MovimientosVelocidad)
|| empty($estadoPresionMotorMT)|| empty($estadoTemperaturaMotorMT)|| empty($horometroInicial)
|| empty($horometroFinal) 



) {
    echo '<script>alert("Todos los campos son obligatorios. Por favor, completa el formulario.");';
    echo 'window.location.href = "agregar_reporte_matutino.php";</script>';
} else {
    // Inserción de datos en la base de datos
    $sql = "CALL InsertarDatosExcavadora(
            '$nombre_maquina', 
            '$nombreUsuario',
            '$turno',
            '$estadoEsqueleto',
            '$estadoAceiteMotor',
            '$estadoAceiteHidraulico', 
            '$estadoAnticongelante', 
            '$estadoBaterías', 
            '$estadoLuces', 
            '$CadenaAvance', 
            '$estadoBandaAlternadorVentilador',
            '$estadoFugasME',
            '$MovimientosVelocidad',
            '$estadoPresionMotorMT',
            '$estadoTemperaturaMotorMT',
            '$observacionesEsqueleto',
            '$observacionesAceiteMotor',
            '$observacionesAceiteHidraulico',
            '$observacionesAnticongelante',
            '$observacionesBaterías',
            '$observacionesLuces',
            '$observacionesCadenaAvance',
            '$observacionesBandaAlternadorVentilador',
            
            '$observacionesFugasME',
            '$observaciones_Movimientos_Velocidad',
            
            '$observacionesPresionMotorMT',
            '$observacionesTemperaturaMotorMT',
            '$horometroInicial',
            '$horometroFinal',
            '$observacionesHorometroInicial',
            '$observacionesHorometroFinal',
            '$observacionesAdicionales',
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
                        window.location.href = "excavadoras_principal.php";
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
