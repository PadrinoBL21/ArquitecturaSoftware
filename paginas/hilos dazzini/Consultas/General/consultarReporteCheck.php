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
c.Nombre_Maquina, c.id_reporte, c.Maquina_ID, c.Fecha_Reporte, c.Turno, c.Revisado_Por,
c.Estado_Equipo, c.Observaciones_Estado_Equipo, c.Nivel_Aceite_Motor, c.Observaciones_Nivel_Aceite_Motor,
c.Nivel_Anticongelante, c.Observaciones_Nivel_Anticongelante, c.Nivel_Aceite_Unidad_Compresion,
 c.Observaciones_Nivel_Aceite_Unidad_Compresion,
c.Fugas, c.Observaciones_Fugas, c.Ruidos_Extranos, c.Observaciones_Ruidos_Extranos, c.Bateria, c.Observaciones_Bateria,
c.Horometro_Inicial, c.Observaciones_Horometro_Inicial, c.Horometro_Final, c.Observaciones_Horometro_Final, Observaciones_Adicionales,
cmc.reporte_id, cmc.maquina_id,
cmc.CambiarFiltros, cmc.RevisarMangueras, `cmc`.`RevisarSistemaElectrico(Marcha)`, cmc.RevisarNivelesFluidoGeneral,
cmc.Observaciones_CambiarFiltros, cmc.Observaciones_RevisarMangueras, `cmc`.`Observaciones_SistemaElectrico(Marcha)`,
cmc.Observaciones_RevisarNivelesFluidoGeneral, cmc.AveriasEncontradasMomentoServicio
FROM Compresor c
LEFT JOIN CheckMantenimientoCompresores cmc ON c.Maquina_ID = cmc.maquina_id AND c.id_reporte = cmc.reporte_id
WHERE (c.Maquina_ID = '4' OR c.Maquina_ID = '5' OR c.Maquina_ID = '6') AND c.Turno = 'Check'";

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
        $row['Estado_Equipo'], $row['Nivel_Aceite_Motor'], $row['Nivel_Anticongelante'],
        $row['Nivel_Aceite_Unidad_Compresion'], $row['Fugas'], $row['Ruidos_Extranos'], $row['Bateria'],
        $row['Horometro_Inicial'], $row['Horometro_Final'], '' ,
        $row['CambiarFiltros'], $row['RevisarMangueras'], $row['RevisarSistemaElectrico(Marcha)'],
        $row['RevisarNivelesFluidoGeneral'], ''
    );

    //DATOS GENERALES
    $datosGenerales = array(
       $row['id_reporte'],$row['Nombre_Maquina'] , $row['Fecha_Reporte'],$row['Turno'], $row['Revisado_Por']
    );

    $observaciones = array(
        isset($row['Observaciones_Estado_Equipo']) ? $row['Observaciones_Estado_Equipo'] : 'Sin observaciones',
        isset($row['Observaciones_Nivel_Aceite_Motor']) ? $row['Observaciones_Nivel_Aceite_Motor'] : 'Sin observaciones',
        isset($row['Observaciones_Nivel_Anticongelante']) ? $row['Observaciones_Nivel_Anticongelante'] : 'Sin observaciones',
        isset($row['Observaciones_Nivel_Aceite_Unidad_Compresion']) ? $row['Observaciones_Nivel_Aceite_Unidad_Compresion'] : 'Sin observaciones',
        isset($row['Observaciones_Fugas']) ? $row['Observaciones_Fugas'] : 'Sin observaciones',
        isset($row['Observaciones_Ruidos_Extranos']) ? $row['Observaciones_Ruidos_Extranos'] : 'Sin observaciones',
        isset($row['Observaciones_Bateria']) ? $row['Observaciones_Bateria'] : 'Sin observaciones',
        isset($row['Observaciones_Horometro_Inicial']) ? $row['Observaciones_Horometro_Inicial'] : 'Sin observaciones',
        isset($row['Observaciones_Horometro_Final']) ? $row['Observaciones_Horometro_Final'] : 'Sin observaciones',
        isset($row['Observaciones_Adicionales']) ? $row['Observaciones_Adicionales'] : 'Sin observaciones',
        isset($row['Observaciones_CambiarFiltros']) ? $row['Observaciones_CambiarFiltros'] : 'Sin observaciones',
        isset($row['Observaciones_RevisarMangueras']) ? $row['Observaciones_RevisarMangueras'] : 'Sin observaciones',
        isset($row['Observaciones_SistemaElectrico(Marcha)']) ? $row['Observaciones_SistemaElectrico(Marcha)'] : 'Sin observaciones',
        isset($row['Observaciones_RevisarNivelesFluidoGeneral']) ? $row['Observaciones_RevisarNivelesFluidoGeneral'] : 'Sin observaciones',
        isset($row['AveriasEncontradasMomentoServicio']) ? $row['AveriasEncontradasMomentoServicio'] : 'Sin observaciones'
    );
//datos nombre de aspectos
 $aspectosDefault = array(
    'Estado del Equipo',
    'Nivel de Aceite del Motor', 
    'Nivel de Anticongelante',
    'Nivel Aceite de la Unidad de Compresión',
    'Fugas',
    'Ruidos Extraños',
    'Baterías',
    'Horómetro Inicial (Horas)',
    'Horómetro Final (Horas)',
    'Observaciones Adicionales',
    'Cambiar Filtros',
    'Revisar Mangueras',
    'Revisar Sistema Eléctrico (Marcha)',
    'Revisar Niveles de Fluido General',
    'Averías Encontradas en el Momento del Servicio'
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
    if ($index == 7) {
       $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Hórometro', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
    }elseif ($index == 10) {
        $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Check de Mantenimiento', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
    }
       $pdf->SetFont('', '', 10); // Tamaño de fuente normal*/

    $pdf->MultiCell($aspectosWidth, $alturaCelda, $aspectosDefault[$index], 1, 'L', 0, 0, '', '', true, 0, false, true, $alturaCelda, 'T');

    // Establecer el color de fondo en función del valor de $aspecto
    if ($aspecto == 'Bueno') {
        $pdf->SetFillColor(0, 129, 84); // Verde pálido
    } else if ($aspecto == 'Malo') {
        $pdf->SetFillColor(161, 20, 13); // Rojo salmón claro
    }elseif ($aspecto == 'Si') {
        $pdf->SetFillColor(0, 129, 84); // Verde
    } else if ($aspecto == 'No') {
        $pdf->SetFillColor(161, 20, 13); // Rojo
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