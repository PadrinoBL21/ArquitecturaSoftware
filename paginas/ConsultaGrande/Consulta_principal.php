<?php
require_once('../../TCPDF-main/tcpdf.php'); // Ruta a tu archivo TCPDF
session_start();
include "../../Conexion.php";

// Configurar la localización en español
setlocale(LC_TIME, 'es_ES.UTF-8');

// Consulta a la base de datos para obtener los tipos de máquinas disponibles
$sql_tipos_maquinas = "SELECT DISTINCT tipo_nombre FROM tipomaquinas;";
try {
    $result_tipos_maquinas = $conn->query($sql_tipos_maquinas);
} catch (Exception $e) {
    echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un problema al consultar los tipos de máquinas. Por favor, intenta nuevamente.',
                confirmButtonText: 'Entendido'
            });
          </script>";
    $result_tipos_maquinas = false;
}

// Verificar si se obtuvieron resultados
if ($result_tipos_maquinas && $result_tipos_maquinas->num_rows > 0) {
    $tipos_maquinas = array();
    // Iterar sobre los resultados y almacenar en un array
    while ($row_tipo_maquina = $result_tipos_maquinas->fetch_assoc()) {
        $tipos_maquinas[] = $row_tipo_maquina["tipo_nombre"];
    }
} else {
    echo "No se encontraron tipos de máquinas en la base de datos";
}

// Meses del año en español
$meses = array(
    1 => 'Enero',
    2 => 'Febrero',
    3 => 'Marzo',
    4 => 'Abril',
    5 => 'Mayo',
    6 => 'Junio',
    7 => 'Julio',
    8 => 'Agosto',
    9 => 'Septiembre',
    10 => 'Octubre',
    11 => 'Noviembre',
    12 => 'Diciembre'
);

// Variables para almacenar los resultados de la consulta para la página
$resultado_html = ''; 
$mensaje_resultado = ''; 
$Turno = '';
$alerta = ''; 

// Variables para paginación
$page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

// Procesar el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST["turno"])) {
        $alerta = "<script>
                Swal.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: 'Por favor, selecciona un turno antes de realizar la consulta.',
                    confirmButtonText: 'Entendido'
                });
              </script>";
    } else {
        // Obtener los valores del formulario
        $mes = $_POST["mes"];
        $tipo_maquina = $_POST["tipo_maquina"];
        $turno = $_POST["turno"];
        $revisado_por = isset($_POST["revisado_por"]) ? $_POST["revisado_por"] : '';
        $_SESSION['Turno'] = $turno;
        $_SESSION['tipo_maquina'] = $tipo_maquina;
        $_SESSION['mes'] = $mes;

        // SQL base para la consulta
        $sql_base = "SELECT Nombre_Maquina, Fecha_Reporte, Turno, Estatus, Revisado_Por FROM $tipo_maquina WHERE MONTH(Fecha_Reporte) = '$mes'";

        if (!empty($revisado_por)) {
            $sql_base .= " AND Revisado_Por LIKE '%$revisado_por%'";
        }

        if ($turno == "Todos") {
            $sql_consulta_pagina = $sql_base . " AND Turno IN ('Matutino', 'Vespertino', 'Check')";
        } else {
            $sql_consulta_pagina = $sql_base . " AND Turno = '$turno'";
        }

        // Añadir límite y offset para la paginación
        $sql_consulta_pagina .= " LIMIT $limit OFFSET $offset;";
        try {
            $result_consulta_pagina = $conn->query($sql_consulta_pagina);
        } catch (Exception $e) {
            $result_consulta_pagina = false;
        }

        // Verificar si se obtuvieron resultados (para la página)
        if ($result_consulta_pagina && $result_consulta_pagina->num_rows > 0) {
            $column_names_pagina = array('Nombre Máquina', 'Fecha', 'Turno', 'Estatus', 'Revisado por');
            $data_rows_pagina = array();
            while ($row_pagina = $result_consulta_pagina->fetch_assoc()) {
                $data_rows_pagina[] = $row_pagina;
            }

            // Construir la tabla de resultados en HTML (para la página)
            $resultado_html .= "<div class='table-responsive'>";
            $resultado_html .= "<table class='table table-bordered'>";
            $resultado_html .= "<thead class='thead-dark'><tr>";
            foreach ($column_names_pagina as $column_name_pagina) {
                $resultado_html .= "<th>$column_name_pagina</th>";
            }
            $resultado_html .= "</tr></thead><tbody>";
            foreach ($data_rows_pagina as $row_pagina) {
                $resultado_html .= "<tr>";
                foreach ($row_pagina as $value_pagina) {
                    $resultado_html .= "<td>$value_pagina</td>";
                }
                $resultado_html .= "</tr>";
            }
            $resultado_html .= "</tbody></table></div>";

            // Obtener el número total de registros para calcular el total de páginas
            $sql_count = "SELECT COUNT(*) AS total FROM $tipo_maquina WHERE MONTH(Fecha_Reporte) = '$mes'";
            if ($turno != "Todos") {
                $sql_count .= " AND Turno = '$turno'";
            }
            if (!empty($revisado_por)) {
                $sql_count .= " AND Revisado_Por LIKE '%$revisado_por%'";
            }
            try {
                $result_count = $conn->query($sql_count);
            } catch (Exception $e) {
                $result_count = false;
            }
            if ($result_count) {
                $total_rows = $result_count->fetch_assoc()['total'];
                $total_pages = ceil($total_rows / $limit);

                // Crear botones de paginación
                $resultado_html .= "<div class='d-flex justify-content-center mt-3'>";
                for ($i = 1; $i <= $total_pages; $i++) {
                    $active_class = ($i == $page) ? 'btn-primary' : 'btn-secondary';
                    $resultado_html .= "<form method='post' style='display: inline-block; margin: 0 5px;'>
                                            <input type='hidden' name='page' value='$i'>
                                            <input type='hidden' name='mes' value='$mes'>
                                            <input type='hidden' name='tipo_maquina' value='$tipo_maquina'>
                                            <input type='hidden' name='turno' value='$turno'>
                                            <input type='hidden' name='revisado_por' value='$revisado_por'>
                                            <button type='submit' class='btn $active_class'>$i</button>
                                        </form>";
                }
                $resultado_html .= "</div>";
            }
        }

        // Mostrar alerta en caso de que no se obtuvieran resultados
        if (!$result_consulta_pagina || $result_consulta_pagina->num_rows == 0) {
            echo "<script>
                    Swal.fire({
                        icon: 'info',
                        title: 'Sin Resultados',
                        text: 'No se encontraron resultados para el tipo de máquina seleccionado en el mes y turno especificados.',
                        confirmButtonText: 'Entendido'
                    });
                  </script>";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/tablas.css">
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4/bootstrap-4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@sweetalert2@10"></script>
</head>
<body>
    <div class="container mt-5">
        <form method="post" class="bg-light p-4 rounded" id="consultaForm">
            <div class="form-group">
                <label for="tipo_maquina">Selecciona un tipo de máquina:</label>
                <select class="form-control" name="tipo_maquina" id="tipo_maquina">
                    <option value="">Selecciona un tipo de máquina</option>
                    <?php foreach ($tipos_maquinas as $tipo_maquina) : ?>
                        <option value="<?php echo $tipo_maquina; ?>" <?php echo (isset($_POST['tipo_maquina']) && $_POST['tipo_maquina'] == $tipo_maquina) ? 'selected' : ''; ?>><?php echo $tipo_maquina; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="mes">Selecciona un mes:</label>
                <select class="form-control" name="mes" id="mes">
                    <option value="">Selecciona un mes</option>
                    <?php foreach ($meses as $numero_mes => $nombre_mes) : ?>
                        <option value="<?php echo $numero_mes; ?>" <?php echo (isset($_POST['mes']) && $_POST['mes'] == $numero_mes) ? 'selected' : ''; ?>><?php echo $nombre_mes; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="Turno">Selecciona un turno:</label><br>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-secondary <?php echo (isset($_POST['turno']) && $_POST['turno'] == 'Matutino') ? 'active' : ''; ?>">
                        <input type="radio" name="turno" id="turnoMatutino" value="Matutino" <?php echo (isset($_POST['turno']) && $_POST['turno'] == 'Matutino') ? 'checked' : ''; ?>> Matutino
                    </label>
                    <label class="btn btn-secondary <?php echo (isset($_POST['turno']) && $_POST['turno'] == 'Vespertino') ? 'active' : ''; ?>">
                        <input type="radio" name="turno" id="turnoVespertino" value="Vespertino" <?php echo (isset($_POST['turno']) && $_POST['turno'] == 'Vespertino') ? 'checked' : ''; ?>> Vespertino
                    </label>
                    <label class="btn btn-secondary <?php echo (isset($_POST['turno']) && $_POST['turno'] == 'Check') ? 'active' : ''; ?>">
                        <input type="radio" name="turno" id="turnoCheck" value="Check" <?php echo (isset($_POST['turno']) && $_POST['turno'] == 'Check') ? 'checked' : ''; ?>> Check
                    </label>
                    <label class="btn btn-secondary <?php echo (isset($_POST['turno']) && $_POST['turno'] == 'Todos') ? 'active' : ''; ?>">
                        <input type="radio" name="turno" id="turnoTodos" value="Todos" <?php echo (isset($_POST['turno']) && $_POST['turno'] == 'Todos') ? 'checked' : ''; ?>> Todos
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label for="revisado_por">Buscar por nombre de operador:</label>
                <input type="text" class="form-control" name="revisado_por" id="revisado_por" value="<?php echo isset($_POST['revisado_por']) ? $_POST['revisado_por'] : ''; ?>">
            </div>

            <button type="submit" class="btn btn-primary">Consultar</button>
        </form>

        <!-- Aquí se muestra la tabla de resultados o el mensaje de no resultados -->
        <div class="mt-4">
            <?php
            if (!empty($resultado_html)) {
                echo $resultado_html;
            } elseif (!empty($mensaje_resultado)) {
                echo "<div class='alert alert-warning'>$mensaje_resultado</div>";
            }
            ?>
        </div>

        <a href="../../principal.php" class="btn btn-secondary mt-3">Volver</a>
    </div>
    <?php
    // Incluir la alerta si existe
    if (!empty($alerta)) {
        echo $alerta;
    }
    ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
