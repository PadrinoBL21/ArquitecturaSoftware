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
y.Nombre_Maquina, y.id_reporte, y.Maquina_ID, y.Fecha_Reporte, y.Turno, y.Revisado_Por,
y.Estado_Esqueleto, y.Nivel_Aceite_Motor, y.Nivel_Aceite_Hidraulico, y.Nivel_Anticongelante,
y.Baterias, y.Luces, y.Neumaticos_Presion_70LB, y.Banda_Alternador_Ventilador,
y.Nivel_Aceite_Transmision, y.Fugas, y.Frenos, y.Presion_Motor_50_PSI, y.Temperatura_Motor_100_180,
y.Horometro_Inicial, y.Horometro_Final, 
y.Observaciones_Estado_Esqueleto, y.Observaciones_Nivel_Aceite_Motor, 
y.Observaciones_Nivel_Aceite_Hidraulico, y.Observaciones_Nivel_Anticongelante,
y.Observaciones_Baterias, y.Observaciones_Luces, y.Observaciones_Neumaticos_Presion_70LB,
y.Observaciones_Banda_Alternador_Ventilador, y.Observaciones_Nivel_Aceite_Transmision,
y.Observaciones_Fugas, y.Observaciones_Frenos, y.Observaciones_Presion_Motor_50_PSI,
y.Observaciones_Temperatura_Motor_100_180, y.Observaciones_Horometro_Inicial,
y.Observaciones_Horometro_Final, y.Observaciones_Adicionales,
cmc.maquina_id, cmc.reporte_id,
cmc.CambiarFiltros, cmc.RevisarMangueras, cmc.EngrasarTazas_Pernos_Gatos, cmc.RevisarSistemaElectrico_Marcha,
cmc.RevisarSistema_Avance, cmc.RevisarNivelesFluidoGeneral,
cmc.Observaciones_CambiarFiltros, cmc.Observaciones_RevisarMangueras, cmc.Observaciones_EngrasarTazasPernosGatos,
cmc.Observaciones_RevisarSistemaElectrico, cmc.Observaciones_RevisarSistemaAvance,
cmc.Observaciones_RevisarNivelesFluidoGeneral, cmc.AveriasEncontradasMomento
FROM Yucle y
LEFT JOIN CheckMantenimientoYucle cmc ON y.Maquina_ID = cmc.maquina_id AND y.id_reporte = cmc.reporte_id
WHERE (y.Maquina_ID = '30' OR y.Maquina_ID = '31') AND y.Turno = 'Check'
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
        $row['Estado_Esqueleto'], $row['Nivel_Aceite_Motor'], $row['Nivel_Aceite_Hidraulico'],  $row['Nivel_Anticongelante'],
        $row['Baterias'], $row['Luces'], $row['Neumaticos_Presion_70LB'], $row['Banda_Alternador_Ventilador'],
        $row['Nivel_Aceite_Transmision'], $row['Fugas'], $row['Frenos'],  
        $row['Presion_Motor_50_PSI'], $row['Temperatura_Motor_100_180'],$row['Horometro_Inicial'], $row['Horometro_Final'],
        '',

        $row['CambiarFiltros'], $row['RevisarMangueras'], $row['EngrasarTazas_Pernos_Gatos'], $row['RevisarSistemaElectrico_Marcha'], 
        $row['RevisarSistema_Avance'], $row['RevisarNivelesFluidoGeneral'], ''
    );

    //DATOS GENERALES
    $datosGenerales = array(
       $row['id_reporte'],$row['Nombre_Maquina'] , $row['Fecha_Reporte'],$row['Turno'], $row['Revisado_Por']
    );



    $observaciones = array(
        isset($row['Observaciones_Estado_Esqueleto']) ? $row['Observaciones_Estado_Esqueleto'] : 'Sin observaciones',
        isset($row['Observaciones_Nivel_Aceite_Motor']) ? $row['Observaciones_Nivel_Aceite_Motor'] : 'Sin observaciones',
        isset($row['Observaciones_Nivel_Aceite_Hidraulico']) ? $row['Observaciones_Nivel_Aceite_Hidraulico'] : 'Sin observaciones',
        isset($row['Observaciones_Nivel_Anticongelante']) ? $row['Observaciones_Nivel_Anticongelante'] : 'Sin observaciones',
        isset($row['Observaciones_Baterias']) ? $row['Observaciones_Baterias'] : 'Sin observaciones',
        isset($row['Observaciones_Luces']) ? $row['Observaciones_Luces'] : 'Sin observaciones',
        isset($row['Observaciones_Neumaticos_Presion_70LB']) ? $row['Observaciones_Neumaticos_Presion_70LB'] : 'Sin observaciones',
        isset($row['Observaciones_Banda_Alternador_Ventilador']) ? $row['Observaciones_Banda_Alternador_Ventilador'] : 'Sin observaciones',
        isset($row['Observaciones_Nivel_Aceite_Transmision']) ? $row['Observaciones_Nivel_Aceite_Transmision'] : 'Sin observaciones',
        isset($row['Observaciones_Fugas']) ? $row['Observaciones_Fugas'] : 'Sin observaciones',
        isset($row['Observaciones_Frenos']) ? $row['Observaciones_Frenos'] : 'Sin observaciones',
        isset($row['Observaciones_Presion_Motor_50_PSI']) ? $row['Observaciones_Presion_Motor_50_PSI'] : 'Sin observaciones',
        isset($row['Observaciones_Temperatura_Motor_100_180']) ? $row['Observaciones_Temperatura_Motor_100_180'] : 'Sin observaciones',
        isset($row['Observaciones_Horometro_Inicial']) ? $row['Observaciones_Horometro_Inicial'] : 'Sin observaciones',
        isset($row['Observaciones_Horometro_Final']) ? $row['Observaciones_Horometro_Final'] : 'Sin observaciones',
        isset($row['Observaciones_Adicionales']) ? $row['Observaciones_Adicionales'] : 'Sin observaciones',
        isset($row['Observaciones_CambiarFiltros']) ? $row['Observaciones_CambiarFiltros'] : 'Sin observaciones',
        isset($row['Observaciones_RevisarMangueras']) ? $row['Observaciones_RevisarMangueras'] : 'Sin observaciones',
        isset($row['Observaciones_EngrasarTazasPernosGatos']) ? $row['Observaciones_EngrasarTazasPernosGatos'] : 'Sin observaciones',
        isset($row['Observaciones_RevisarSistemaElectrico']) ? $row['Observaciones_RevisarSistemaElectrico'] : 'Sin observaciones',
        isset($row['Observaciones_RevisarSistemaAvance']) ? $row['Observaciones_RevisarSistemaAvance'] : 'Sin observaciones',
        isset($row['Observaciones_RevisarNivelesFluidoGeneral']) ? $row['Observaciones_RevisarNivelesFluidoGeneral'] : 'Sin observaciones',
        isset($row['AveriasEncontradasMomento']) ? $row['AveriasEncontradasMomento'] : 'Sin observaciones'

        
    );
//datos nombre de aspectos
 $aspectosDefault = array(
        'Estado del esqueleto', 
        'Nivel de aceite del motor', 
        'Nivel de aceite hidráulico', 
        'Nivel de anticongelante',
        'Baterías', 
        'Luces', 
        'Neumáticos Presión 70LB', 
        'Banda del alternador y ventilador',
        'Nivel de aceite de transmisión', 
        'Fugas', 
        'Frenos', 
        'Presión del motor a 50 PSI', 
        'Temperatura del motor entre 100° y 180°',
        'Horómetro inicial', 
        'Horómetro final',
        'Observaciones adicionales',

        'Cambiar filtros',
        'Revisar mangueras',
        'Engrasar tazas, pernos y gatos',
        'Revisar sistema eléctrico y marcha',
        'Revisar sistema de avance',
        'Revisar niveles de fluido general',
        'Averías encontradas en el momento'
    
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
    if ($index == 8) {
        $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Máquina Encendida', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
    }else if ($index == 10) {
        $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Máquina Trabajando', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
    }elseif ($index == 13) {
        $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Horómetro', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
    }elseif ($index == 15) {
        $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Observaciones Adicionales', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
    }else if ($index == 16) {
        $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Check Servicio de Mantenimiento', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
    }else if ($index == 22) { 
        $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Observaciones Adicionales', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
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
