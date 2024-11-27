<?php
include '../../CONEXION.php';
require_once('C:\xampp\htdocs\Bitacoras\TCPDF-main\tcpdf.php');
session_start();
$maquina_id = isset($_SESSION['maquina_id']) ? $_SESSION['maquina_id'] : 'ID de la Máquina No Disponible';
$Turno = isset($_SESSION['Turno']) ? $_SESSION['Turno'] : 'ID de la Máquina No Disponible';
date_default_timezone_set('America/Mexico_City');
$fecha = date('Y-m-d');
$semana = date('W');

class PDF extends TCPDF {
    // Encabezado
    public function Header() {
        $logoPath = '../../../../img/logopdf.png'; 
        $this->Image($logoPath, 10, 10, 50, 0, 'PNG'); 
        $this-> Ln(3);
        // Arial bold 15
        $this->SetFont('helvetica', '', 10);
        // Título
        $this->Cell(0, 10, 'Reporte Semanal de Bitácora', 0, false, 'C', 0, '', 0, false, 'T', 'M');
        // Fecha y hora...
        $fecha = date('Y-m-d');
        $hora = date('H:i:s');
        $this->SetFont('helvetica', '', 10);
        $this->Cell(0, 2, 'Fecha: ' . $fecha, 0, false, 'R', 0, '', 0, false, 'T', 'M');
        $this->Ln();
    }
    // Pie de página
    public function Footer() {
        // Posición a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('helvetica', 'I', 8);
        // Número de página
        $this->Cell(0, 10, 'Página '.$this->PageNo(), 0, 'C');
    }
}

if (ob_get_contents()) {
    ob_end_clean();
}
// Crear instancia de PDF
$pdf = new PDF('P', 'mm', 'A4', true, 'UTF-8', false);

// Quitar header y footer
$pdf->setPrintHeader(true);
$pdf->setPrintFooter(true);

// Configuración del PDF
$pdf->SetMargins(10, 10, 10); // Márgenes del documento
$pdf->SetHeaderMargin(10);
$pdf->SetFooterMargin(10);

$pdf->SetAutoPageBreak(true, 20);

// Agregar página
$pdf->AddPage();

// Agregar un salto de línea para asegurar que los datos generales no se impriman encima del encabezado
$pdf->Ln(10);

$maquina_id = mysqli_real_escape_string($conn, $maquina_id);

// Llamar al procedimiento para obtener las columnas ENUM
$obtenerColumnnasEnum = "CALL GetEnumColumns('Cargador')";
$result = mysqli_query($conn, $obtenerColumnnasEnum);
$columns = array();
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $columns[] = $row['ColumnName'];
    }
    mysqli_free_result($result); // Liberar los resultados del primer procedimiento almacenado
}
if ($conn->more_results()) {
    $conn->next_result();
}

// Consultar datos de la máquina
$queryMV = "CALL ConsultaMaquinas('$Turno')";
$resultMV = mysqli_query($conn, $queryMV);

if (!$resultMV) {
    die('Error al obtener los datos de la bitácora: ' . mysqli_error($conn));
} else if ($resultMV && mysqli_num_rows($resultMV) > 0) {

    $pdf->Ln(4);
    $pdf->SetFont('helvetica', '', 10);

    // Ancho de la página disponible
    $pageWidth = $pdf->GetPageWidth();
    // Establecer el tipo de fuente y el tamaño de la fuente
    $pdf->SetFont('helvetica', '', 10);

    // Establecer el color de fondo para las celdas de la tabla
    $pdf->SetFillColor(220, 220, 220); // Gris claro

    // Establecer el color del texto para las celdas de la tabla
    $pdf->SetTextColor(0, 0, 0); // Negro

    // Establecer el color de la línea para las celdas de la tabla
    $pdf->SetDrawColor(0, 0, 0); // Negro

    // Establecer el grosor de la línea para las celdas de la tabla
    $pdf->SetLineWidth(0.2);

    // Ancho de las columnas
    $aspectosWidth = $pageWidth / 3;
    $condicionWidth = $pageWidth / 6;
    $observacionesWidth = $pageWidth - $aspectosWidth - $condicionWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'];

    // Restablecer el color de fondo y la fuente para las celdas de datos
    $pdf->SetFillColor(255, 255, 255); // Blanco
    $pdf->SetTextColor(0, 0, 0); // Negro
    $pdf->SetFont('', '', 10); // Tamaño de fuente normal

    $rowCount = 0;
    $rowsPerPage = 6; // Ajusta esto según cuántas filas deseas por página

    while ($row = mysqli_fetch_assoc($resultMV)) {

         /* $aspectos = array();
        foreach ($columns as $column) {
            $aspectos[] = $column;
        }
        $aspectosString = implode(', ', $aspectos);
        
        Aqui los aspectos si los obtiene con el formato de texto que se requiere pero en lugar de ser funcionale, en las casillas de estado imrime $row['Nombre de la columna']
        */
        $aspectos = array(
            $row['Estado_Esqueleto'], $row['Nivel_Aceite_Motor'], $row['Nivel_Aceite_Hidraulico'],
            $row['Nivel_Anticongelante'], $row['Baterias'], $row['Luces'], $row['Neumaticos_Presion_75LB'],
            $row['Banda_Alternador_Ventilador'], $row['Nivel_Aceite_Transmision_Maquina_Encendida'],
            $row['Fugas_Maquina_Encendida'], $row['Frenos_Maquina_Trabajando'],
            $row['Presion_Motor_50_PSI_Maquina_Trabajando'],
            $row['Temperatura_Motor_100_180_Maquina_Trabajando'],
            $row['Horometro_Inicial'], $row['Horometro_Final'],
            $row['CambiarFiltros'], $row['RevisarMangueras'], $row['EngrasarTazas_Pernos_Gatos'], $row['RevisarSistemaElectrico_Marcha'],
            $row['RevisarSistema_Avance'], $row['RevisarNivelesFluidoGeneral'],
            '' // Averías encontradas al momento del check
        );
        
       

        $datosGenerales = array(
            $row['id_reporte'],$row['Nombre_Maquina'] , $row['Fecha_Reporte'],$row['Turno'], $row['Revisado_Por']
        );

        $observaciones = array(
            isset($row['Observaciones_Estado_Esqueleto']) ? $row['Observaciones_Estado_Esqueleto'] : 'Sin observaciones',
            isset($row['Observaciones_Nivel_Aceite_Motor']) ? $row['Observaciones_Nivel_Aceite_Motor'] : 'Sin observaciones',
            isset($row['observaciones_Nivel_Aceite_Hidraulico']) ? $row['observaciones_Nivel_Aceite_Hidraulico'] : 'Sin observaciones',
            isset($row['Observaciones_Nivel_Anticongelante']) ? $row['Observaciones_Nivel_Anticongelante'] : 'Sin observaciones',   
            isset($row['Observaciones_Baterias']) ? $row['Observaciones_Baterias'] : 'Sin observaciones', 
            isset($row['Observaciones_Luces']) ? $row['Observaciones_Luces'] : 'Sin observaciones', 
            isset($row['Observaciones_Neumaticos_Presion_75LB']) ? $row['Observaciones_Neumaticos_Presion_75LB'] : 'Sin observaciones', 
            isset($row['observaciones_Banda_Alternador_Ventilador']) ? $row['observaciones_Banda_Alternador_Ventilador'] : 'Sin observaciones', 
            isset($row['Observaciones_Nivel_Aceite_Maquina_Encendida']) ? $row['Observaciones_Nivel_Aceite_Maquina_Encendida'] : 'Sin observaciones',   
            isset($row['Observaciones_Fugas_Maquina_Encendida']) ? $row['Observaciones_Fugas_Maquina_Encendida'] : 'Sin observaciones', 
            isset($row['Observaciones_Frenos_Maquina_Trabajando']) ? $row['Observaciones_Frenos_Maquina_Trabajando'] : 'Sin observaciones', 
            isset($row['Observaciones_Presion_Motor_50_PSI_Maquina_Trabajando']) ? $row['Observaciones_Presion_Motor_50_PSI_Maquina_Trabajando'] : 'Sin observaciones', 
            isset($row['Observaciones_Temperatura_Motor_100_180_Maquina_Trabajando']) ? $row['Observaciones_Temperatura_Motor_100_180_Maquina_Trabajando'] : 'Sin observaciones',   
            isset($row['Observaciones_Horometro_Inicial']) ? $row['Observaciones_Horometro_Inicial'] : 'Sin observaciones', 
            isset($row['Observaciones_Horometro_Final']) ? $row['Observaciones_Horometro_Final'] : 'Sin observaciones' ,
            isset($row['Observaciones_CambiarFiltros']) ? $row['Observaciones_CambiarFiltros'] : 'Sin observaciones',
        isset($row['Observaciones_RevisarMangueras']) ? $row['Observaciones_RevisarMangueras'] : 'Sin observaciones',
        isset($row['Observaciones_EngrasarTazasPernosGatos']) ? $row['Observaciones_EngrasarTazasPernosGatos'] : 'Sin observaciones',
        isset($row['Observaciones_RevisarSistemaElectrico']) ? $row['Observaciones_RevisarSistemaElectrico'] : 'Sin observaciones',
        isset($row['Observaciones_RevisarSistemaAvance']) ? $row['Observaciones_RevisarSistemaAvance'] : 'Sin observaciones',
        isset($row['Observaciones_RevisarNivelesFluidoGeneral']) ? $row['Observaciones_RevisarNivelesFluidoGeneral'] : 'Sin observaciones',
        isset($row['AveriasEncontradasMomento']) ? $row['AveriasEncontradasMomento'] : 'Sin observaciones'
        );

        // datos nombre de aspectos
        $aspectosDefault = array(
            'Estado del Esqueleto',
            'Nivel de Aceite del Motor',
            'Nivel de Aceite Hidráulico',
            'Nivel de Anticongelante',
            'Baterías',
            'Luces',
            'Neumáticos Presión 75LB',
            'Banda de Alternador del Ventilador',
            'Nivel de Aceite de Transmisión Maquina Encendida',
            'Fugas Maquina Encendida',
            'Frenos Maquina Trabajando',
            'Presión de Motor 50 PSI Maquina Trabajando',
            'Temperatura de Motor 100-180 Maquina Trabajando',
            'Horómetro Inicial (Horas)',
            'Horómetro Final (Horas)',
            'Cambiar Filtros',
    'Revisar Mangueras',
    'Engrasar Tazas, Pernos y Gatos',
    'Revisar Sistema Eléctrico (Marcha)',
    'Revisar Sistema De Avance',
    'Revisar Niveles De Fluido en General',
    'Averías Encontradas al Momento del Check'
        );

        // Configuración del PDF
        $pdf->SetMargins(10, 10, 10); // Márgenes del documento
        $pdf->SetHeaderMargin(10);
        $pdf->SetFooterMargin(10);

        $pdf->SetAutoPageBreak(true, 20);

        $pdf->Cell(0, 5, 'No. de Reporte: '.$datosGenerales[0], 0, 1, 'L', 0, '', 0, false, 'T', 'M');
        $pdf->Cell(0, 5, 'Nombre de la Máquina: '.$datosGenerales[1], 0, 1, 'L', 0, '', 0, false, 'T', 'M');
        $pdf->Cell(0, 5, 'Fecha: '.$datosGenerales[2], 0, 1, 'L', 0, '', 0, false, 'T', 'M');
        $pdf->cell (0,5,'Semana: '.$semana,0,1,'L',0,'',0,false,'T','M');
        $pdf->Cell(0, 5, 'Turno: '.$datosGenerales[3], 0, 1, 'L', 0, '', 0, false, 'T', 'M');
        $pdf->Cell(0, 5, 'Revisado por: '.$datosGenerales[4], 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $pdf->SetFillColor(220, 220, 220); // Gris claro
        $pdf->SetTextColor(0, 0, 0); // Negro
        $pdf->SetFont('helvetica', 'B', 12);

        $pdf->Cell(0, 10, 'Bitácora de mantenimiento', 0, false, 'C', 0, '', 0, false, 'T', 'M');
        $pdf->Ln();

        $pdf->Cell($aspectosWidth, 8, 'Aspectos', 1, 0, 'C', 0, '', 0, false, 'T', 'M');
        $pdf->Cell($condicionWidth, 8, 'Estado', 1, 0, 'C', 0, '', 0, false, 'T', 'M');
        $pdf->Cell($observacionesWidth, 8, 'Observaciones', 1, 0, 'C', 0, '', 0, false, 'T', 'M');
        $pdf->Ln();

        $pdf->SetFillColor(220, 220, 220); // Gris claro
        $pdf->SetTextColor(0, 0, 0); // Negro
        $pdf->SetDrawColor(0, 0, 0); // Negro
        $pdf->SetLineWidth(0.3);

        $pdf->SetFillColor(255, 255, 255); // Blanco
        $pdf->SetTextColor(0, 0, 0); // Negro
        $pdf->SetFont('', '', 10); // Tamaño de fuente normal

        foreach ($aspectos as $index => $aspecto) {
            $numLineasAspectos = $pdf->getNumLines($aspectosDefault[$index], $aspectosWidth);
            $numLineasObservaciones = $pdf->getNumLines($observaciones[$index], $observacionesWidth);
            $maxNumLineas = max($numLineasAspectos, $numLineasObservaciones);
            $alturaCelda = $maxNumLineas * 6; // Ajusta el valor según tus necesidades

            if ($pdf->GetY() + $alturaCelda > $pdf->getPageHeight() - $pdf->getBreakMargin()) {
                $pdf->AddPage();
                $pdf->Ln(15);
            }

            $pdf->SetFont('helvetica', 'B', 12);
            if ($index == 8) {
                $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Evaluación con Máquina Encendida', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
            } else if ($index == 10) {
                $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Evaluación con Máquina Trabajando', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
            } else if ($index == 13) {
                $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Hórometro', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
            }elseif ($index == 15) {
                $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Check de Mantenimiento', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
            }
            $pdf->SetFont('', '', 10);

            $pdf->MultiCell($aspectosWidth, $alturaCelda, $aspectosDefault[$index], 1, 'L', 0, 0, '', '', true, 0, false, true, $alturaCelda, 'T');

            if ($aspecto == 'Bueno') {
                $pdf->SetFillColor(0, 129, 84); // Verde pálido
            } else if ($aspecto == 'Malo') {
                $pdf->SetFillColor(161, 20, 13); // Rojo salmón claro
            }

            $pdf->Cell($condicionWidth, $alturaCelda, $aspecto, 1, 0, 'C', 1, '', 0, false, 'T', 'M');
            $pdf->SetFillColor(255, 255, 255);

            $pdf->MultiCell($observacionesWidth, $alturaCelda, $observaciones[$index], 1, 'C', 0, 1, '', '', true);
        }

        $pdf->AddPage();
        $pdf->Ln(20);
    }
}

mysqli_close($conn);

$pdf->Output('Reporte_Semanal_Bitacora.pdf', 'I');
?>
