<?php
include '../../../../CONEXION.php';
require_once('C:\xampp\htdocs\Bitacoras\TCPDF-main\tcpdf.php');
session_start();
$maquina_id = isset($_SESSION['maquina_id']) ? $_SESSION['maquina_id'] : 'ID de la Máquina No Disponible';
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

$query = "SELECT 
Nombre_Maquina, id_reporte, Maquina_ID, Fecha_Reporte, Turno, Revisado_Por,
Ajuste_Hoja, Ajuste_Wideas, Estado_Control_Botones, Engrasar_Tren_Avance, Revision_Nivel_Aceite,
Ruidos_Extranos_Encender, Movimientos_Espada_Encender, Movimientos_Espada_Encender, Ruidos_Extraños_Antes_Apagar, Inspeccion_General_Equipo,
Limpiar_Cadena, Enfriamiento_Motor, Limpieza_Exterior_Equipo,
Horometro_Inicial, Horometro_Final, Averias_Encontradas,
Observaciones_Ajuste_Hoja, Observaciones_Nivel_Ajuste_Wideas, Observaciones_Estado_Control_Botones, Observaciones_Engrasar_Tren_Avance,
Observaciones_Revision_Nivel_Aceite, Observaciones_Ruidos_Extranos_Encender, Observaciones_Movimientos_Espada,
Observaciones_Ruidos_Extranos_Antes_Apagar, Observaciones_Inspeccion_General_Equipo, Observaciones_Limpiar_Cadena,
Observaciones_Enfriamiento_Motor, Observaciones_Limpieza_Equipo_Exterior, Observaciones_Horometro_Inicial,
Observaciones_Horometro_Final
FROM Espada 
WHERE (Maquina_ID = '9' OR Maquina_ID = '10') AND Turno = 'Matutino'
ORDER BY id_reporte DESC";

$result = mysqli_query($conn, $query);

if (!$result) {
    die('Error al obtener los datos de la bitácora: ' . mysqli_error($conn));
}

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


 

while ($row = mysqli_fetch_assoc($result)) {
    $aspectos = array(
        $row['Ajuste_Hoja'], $row['Ajuste_Wideas'], $row['Estado_Control_Botones'],
        $row['Engrasar_Tren_Avance'], $row['Revision_Nivel_Aceite'], $row['Ruidos_Extranos_Encender'], $row['Movimientos_Espada_Encender'],
        $row['Ruidos_Extraños_Antes_Apagar'],
        $row['Inspeccion_General_Equipo'], $row['Limpiar_Cadena'],
        $row['Enfriamiento_Motor'], $row['Limpieza_Exterior_Equipo'],
        $row['Horometro_Inicial'], $row['Horometro_Final'],
        ''
    );

    //DATOS GENERALES
    $datosGenerales = array(
       $row['id_reporte'],$row['Nombre_Maquina'] , $row['Fecha_Reporte'],$row['Turno'], $row['Revisado_Por']
    );

    $observaciones = array(
        isset($row['Observaciones_Ajuste_Hoja']) ? $row['Observaciones_Ajuste_Hoja'] : 'Sin observaciones',
        isset($row['Observaciones_Nivel_Ajuste_Wideas']) ? $row['Observaciones_Nivel_Ajuste_Wideas'] : 'Sin observaciones',
        isset($row['Observaciones_Estado_Control_Botones']) ? $row['Observaciones_Estado_Control_Botones'] : 'Sin observaciones',
        isset($row['Observaciones_Engrasar_Tren_Avance']) ? $row['Observaciones_Engrasar_Tren_Avance'] : 'Sin observaciones',
        isset($row['Observaciones_Revision_Nivel_Aceite']) ? $row['Observaciones_Revision_Nivel_Aceite'] : 'Sin observaciones',
        isset($row['Observaciones_Ruidos_Extranos_Encender']) ? $row['Observaciones_Ruidos_Extranos_Encender'] : 'Sin observaciones',
        isset($row['Observaciones_Movimientos_Espada']) ? $row['Observaciones_Movimientos_Espada'] : 'Sin observaciones',
        isset($row['Observaciones_Ruidos_Extranos_Antes_Apagar']) ? $row['Observaciones_Ruidos_Extranos_Antes_Apagar'] : 'Sin observaciones',
        isset($row['Observaciones_Inspeccion_General_Equipo']) ? $row['Observaciones_Inspeccion_General_Equipo'] : 'Sin observaciones',
        isset($row['Observaciones_Limpiar_Cadena']) ? $row['Observaciones_Limpiar_Cadena'] : 'Sin observaciones',
        isset($row['Observaciones_Enfriamiento_Motor']) ? $row['Observaciones_Enfriamiento_Motor'] : 'Sin observaciones',
        isset($row['Observaciones_Limpieza_Equipo_Exterior']) ? $row['Observaciones_Limpieza_Equipo_Exterior'] : 'Sin observaciones',
        isset($row['Observaciones_Horometro_Inicial']) ? $row['Observaciones_Horometro_Inicial'] : 'Sin observaciones',
        isset($row['Observaciones_Horometro_Final']) ? $row['Observaciones_Horometro_Final'] : 'Sin observaciones',
        isset($row['Averias_Encontradas']) ? $row['Averias_Encontradas'] : 'Sin observaciones'
        
    );
//datos nombre de aspectos
 $aspectosDefault = array(
        'Ajuste de hoja', 
        'Ajuste de wideas', 
        'Estado de control y botones',
        'Engrasar tren de avance', 
        'Revisión de nivel de aceite', 
        'Ruidos extraños al encender',
        'Movimientos de espada al encender', 
        'Ruidos extraños antes de apagar', 
        'Inspección general de equipo',
        'Limpiar cadena', 
        'Enfriamiento de motor', 
        'Limpieza de equipo exterior',
        'Horómetro inicial', 
        'Horómetro final', 
        'Averías encontradas'
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



// Establecer el color de fondo y la fuente para las celdas de encabezado
$pdf->SetFillColor(220, 220, 220); // Gris claro
$pdf->SetTextColor(0, 0, 0); // Blanco
$pdf->SetFont('', 'B', 12); // Negrita

// Establecer el color de fondo para las celdas de la tabla
$pdf->SetFillColor(220, 220, 220); // Gris claro

// Establecer el color del texto para las celdas de la tabla
$pdf->SetTextColor(0, 0, 0); // Negro

// Establecer el color de la línea para las celdas de la tabla
$pdf->SetDrawColor(0, 0, 0); // Negro

// Establecer el grosor de la línea para las celdas de la tabla
$pdf->SetLineWidth(0.25);


$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(0, 10, 'Bitácora de mantenimiento', 0, false, 'C', 0, '', 0, false, 'T', 'M');

$pdf->Ln();


$pdf->Cell($aspectosWidth, 8, 'Aspectos', 1, 0, 'C', 0, '', 0, false, 'T', 'M');
$pdf->Cell($condicionWidth, 8, 'Estado', 1, 0, 'C', 0, '', 0, false, 'T', 'M');
$pdf->Cell($observacionesWidth, 8, 'Observaciones', 1, 0, 'C', 0, '', 0, false, 'T', 'M');
$pdf->Ln();

// Establecer el color de fondo para las celdas de la tabla
$pdf->SetFillColor(220, 220, 220); // Gris claro

// Establecer el color del texto para las celdas de la tabla
$pdf->SetTextColor(0, 0, 0); // Negro

// Establecer el color de la línea para las celdas de la tabla
$pdf->SetDrawColor(0, 0, 0); // Negro

// Establecer el grosor de la línea para las celdas de la tabla
$pdf->SetLineWidth(0.3);

// Restablecer el color de fondo y la fuente para las celdas de datos
$pdf->SetFillColor(255, 255, 255); // Blanco
$pdf->SetTextColor(0, 0, 0); // Negro
$pdf->SetFont('', '', 10); // Tamaño de fuente normal

foreach ($aspectos as $index => $aspecto) {
    // Calcular la altura de las celdas 'Aspectos' y 'Observaciones'
    $numLineasAspectos = $pdf->getNumLines($aspectosDefault[$index], $aspectosWidth);
    $numLineasObservaciones = $pdf->getNumLines($observaciones[$index], $observacionesWidth);
    $maxNumLineas = max($numLineasAspectos, $numLineasObservaciones);

    // Calcular la altura de la celda
    $alturaCelda = $maxNumLineas * 6; // Ajusta el valor según tus necesidades

    // Verificar si hay suficiente espacio en la página para agregar la fila
    if ($pdf->GetY() + $alturaCelda > $pdf->getPageHeight() - $pdf->getBreakMargin()) {
        // No hay suficiente espacio, agregar una nueva página
        $pdf->AddPage();
        $pdf->Ln(15);
    }

    // Insertar un título antes de la sección correspondiente
    $pdf->SetFont('helvetica', 'B', 12);
    if ($index == 5) {
        $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Revisión Al Encender', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
    } else if ($index == 7) {
        $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Revisión Antes de Apagar', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
    } else if ($index == 12) {
        $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Hórometro', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
    }else if ($index == 14) {
        $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Averías Encontradas', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
    }
    $pdf->SetFont('', '', 10); // Tamaño de fuente normal

    $pdf->MultiCell($aspectosWidth, $alturaCelda, $aspectosDefault[$index], 1, 'L', 0, 0, '', '', true, 0, false, true, $alturaCelda, 'T');

    // Establecer el color de fondo en función del valor de $aspecto
    if ($aspecto == 'Bueno') {
        $pdf->SetFillColor(0, 129, 84); // Verde pálido
    } else if ($aspecto == 'Malo') {
        $pdf->SetFillColor(161, 20, 13); // Rojo salmón claro
    } else if ($aspecto == 'Si' || $aspecto == 'Sí') {
        $pdf->SetFillColor(0, 129, 84); // verde
    } else if ($aspecto == 'No'){
        $pdf->SetFillColor(161, 20, 13); // rojo
    }

    $pdf->Cell($condicionWidth, $alturaCelda, $aspecto, 1, 0, 'C', 1, '', 0, false, 'T', 'M');
    $pdf->SetFillColor(255, 255, 255); // Restablecer el color de fondo a blanco para las otras celdas

    $pdf->MultiCell($observacionesWidth, $alturaCelda, $observaciones[$index], 1, 'C', 0, 1, '', '', true);
    
}

    $pdf->AddPage();
    $pdf->Ln(20);
}
$pdf->deletePage($pdf->getPage()); // Eliminar la última página en blanco
// Salida del PDF
$pdf->Output('Reporte de Bitácora Matutino.pdf', 'I');
?>
