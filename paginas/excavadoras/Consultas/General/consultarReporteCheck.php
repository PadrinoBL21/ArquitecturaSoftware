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
$pdf->Ln(15);

$maquina_id = mysqli_real_escape_string($conn, $maquina_id);

$query = "SELECT 
e.Nombre_Maquina, e.id_reporte, e.Maquina_ID, e.Fecha_Reporte, e.Turno, e.Revisado_Por,
e.Estado_Esqueleto, e.Nivel_Aceite_Motor, e.Nivel_Aceite_Hidraulico, e.Nivel_Anticongelante, e.Baterias,
e.Luces, e.Cadena_Avance, e.Banda_Alternador_Ventilador, e.Fugas_Maquina_Encendida, e.Movimientos_Velocidad_Maquina_Trabajando,
e.Presion_Motor_50_PSI_Maquina_Trabajando, e.Temperatura_Motor_100_180_Maquina_Trabajando,
e.Horometro_Inicial, e.Horometro_Final,
e.observaciones_Estado_Esqueleto, e.observaciones_Nivel_Aceite_Motor, e.observaciones_Nivel_Aceite_Hidraulico, e.observaciones_Nivel_Anticongelante, e.observaciones_Baterias,
e.observaciones_Luces, e.observaciones_Cadena_Avance, e.observaciones_Banda_Alternador_Ventilador, e.observaciones_Fugas_Maquina_Encendida, e.observaciones_Movimientos_Velocidad_Maquina_Trabajando,
e.observaciones_Presion_Motor_50_PSI_Maquina_Trabajando, e.observaciones_Temperatura_Motor_100_180_Maquina_Trabajando,
e.observaciones_Horometro_Inicial, e.observaciones_Horometro_Final,
e.observaciones_Adicionales,
cmc.id_reporte, cmc.maquina_id,
cmc.CambiarFiltros, cmc.RevisarMangueras, cmc.EngrasarTazas_Pernos_Gatos, cmc.RevisarSistemaElectrico_Marcha, cmc.RevisarSistema_Avance, cmc.RevisarNivelesFluidoGeneral,
cmc.RevisarSistemasMovimientosBotes,
cmc.observaciones_CambiarFiltros, cmc.observaciones_RevisarMangueras, cmc.observaciones_EngrasarTazasPernosGatos, cmc.observaciones_RevisarSistemaElectrico, cmc.observaciones_RevisarSistemaAvance, cmc.observaciones_RevisarNivelesFluidoGeneral,
cmc.observaciones_RevisarSistemasMovimientosBotes, cmc.AveriasEncontradasMomento
FROM Excavadora e
LEFT JOIN CheckMantenimientoExcavadoras cmc ON e.Maquina_ID = cmc.maquina_id AND e.id_reporte = cmc.id_reporte
WHERE (e.Maquina_ID = '11' OR e.Maquina_ID = '12' OR e.Maquina_ID = '13') AND e.Turno = 'Check'
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
        $row['Estado_Esqueleto'], $row['Nivel_Aceite_Motor'], $row['Nivel_Aceite_Hidraulico'],
        $row['Nivel_Anticongelante'], $row['Baterias'],  
        $row['Luces'], $row['Cadena_Avance'], $row['Banda_Alternador_Ventilador'], 
        $row['Fugas_Maquina_Encendida'], $row['Movimientos_Velocidad_Maquina_Trabajando'], $row['Presion_Motor_50_PSI_Maquina_Trabajando'], 
        $row['Temperatura_Motor_100_180_Maquina_Trabajando'], $row['Horometro_Inicial'], $row['Horometro_Final'], '',
        $row['CambiarFiltros'], $row['RevisarMangueras'], $row['EngrasarTazas_Pernos_Gatos'], $row['RevisarSistemaElectrico_Marcha'],
        $row['RevisarSistema_Avance'], $row['RevisarNivelesFluidoGeneral'], $row['RevisarSistemasMovimientosBotes'], ''

    );

    //DATOS GENERALES
    $datosGenerales = array(
       $row['id_reporte'],$row['Nombre_Maquina'] , $row['Fecha_Reporte'],$row['Turno'], $row['Revisado_Por']
    );

    $observaciones = array(
        isset($row['observaciones_Estado_Esqueleto']) ? $row['observaciones_Estado_Esqueleto'] : 'Sin observaciones',
        isset($row['observaciones_Nivel_Aceite_Motor']) ? $row['observaciones_Nivel_Aceite_Motor'] : 'Sin observaciones',
        isset($row['observaciones_Nivel_Aceite_Hidraulico']) ? $row['observaciones_Nivel_Aceite_Hidraulico'] : 'Sin observaciones',
        isset($row['observaciones_Nivel_Anticongelante']) ? $row['observaciones_Nivel_Anticongelante'] : 'Sin observaciones',
        isset($row['observaciones_Baterias']) ? $row['observaciones_Baterias'] : 'Sin observaciones',
        isset($row['observaciones_Luces']) ? $row['observaciones_Luces'] : 'Sin observaciones',
        isset($row['observaciones_Cadena_Avance']) ? $row['observaciones_Cadena_Avance'] : 'Sin observaciones',
        isset($row['observaciones_Banda_Alternador_Ventilador']) ? $row['observaciones_Banda_Alternador_Ventilador'] : 'Sin observaciones',
        isset($row['observaciones_Fugas_Maquina_Encendida']) ? $row['observaciones_Fugas_Maquina_Encendida'] : 'Sin observaciones',
        isset($row['observaciones_Movimientos_Velocidad_Maquina_Trabajando']) ? $row['observaciones_Movimientos_Velocidad_Maquina_Trabajando'] : 'Sin observaciones',
        isset($row['observaciones_Presion_Motor_50_PSI_Maquina_Trabajando']) ? $row['observaciones_Presion_Motor_50_PSI_Maquina_Trabajando'] : 'Sin observaciones',
        isset($row['observaciones_Temperatura_Motor_100_180_Maquina_Trabajando']) ? $row['observaciones_Temperatura_Motor_100_180_Maquina_Trabajando'] : 'Sin observaciones',
        isset($row['observaciones_Horometro_Inicial']) ? $row['observaciones_Horometro_Inicial'] : 'Sin observaciones',
        isset($row['observaciones_Horometro_Final']) ? $row['observaciones_Horometro_Final'] : 'Sin observaciones',
        isset($row['observaciones_Adicionales']) ? $row['observaciones_Adicionales'] : 'Sin observaciones',

        isset($row['observaciones_CambiarFiltros']) ? $row['observaciones_CambiarFiltros'] : 'Sin observaciones',
        isset($row['observaciones_RevisarMangueras']) ? $row['observaciones_RevisarMangueras'] : 'Sin observaciones',
        isset($row['observaciones_EngrasarTazasPernosGatos']) ? $row['observaciones_EngrasarTazasPernosGatos'] : 'Sin observaciones',
        isset($row['observaciones_RevisarSistemaElectrico']) ? $row['observaciones_RevisarSistemaElectrico'] : 'Sin observaciones',
        isset($row['observaciones_RevisarSistemaAvance']) ? $row['observaciones_RevisarSistemaAvance'] : 'Sin observaciones',
        isset($row['observaciones_RevisarNivelesFluidoGeneral']) ? $row['observaciones_RevisarNivelesFluidoGeneral'] : 'Sin observaciones',
        isset($row['observaciones_RevisarSistemasMovimientosBotes']) ? $row['observaciones_RevisarSistemasMovimientosBotes'] : 'Sin observaciones',
        isset($row['AveriasEncontradasMomento']) ? $row['AveriasEncontradasMomento'] : 'Sin observaciones'

    );
//datos nombre de aspectos
 $aspectosDefault = array(
        'Estado del Esqueleto', 
        'Nivel de Aceite del Motor', 
        'Nivel de Aceite Hidráulico', 
        'Nivel de Anticongelante', 
        'Baterías',
        'Luces', 
        'Cadena de Avance', 
        'Banda del Alternador y Ventilador', 
        'Fugas con la Máquina Encendida',
        'Movimientos y Velocidad de la Máquina Trabajando',
        'Presión del Motor a 50 PSI con la Máquina Trabajando', 
        'Temperatura del Motor a 100-180 con la Máquina Trabajando',
        'Horómetro Inicial', 
        'Horómetro Final',
        'Observaciones Adicionales',

        'Cambiar Filtros',
        'Revisar Mangueras',
        'Engrasar Tazas, Pernos y Gatos',
        'Revisar Sistema Eléctrico y Marcha',
        'Revisar Sistema de Avance',
        'Revisar Niveles de Fluido General',
        'Revisar Sistema de Movimientos y Botes',
        'Averías Encontradas Al Momento De La Revisión'
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
    }else if ($index == 15) {
        $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Check De Mantenimiento', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
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
    $pdf->Ln(15);
}
$pdf->deletePage($pdf->getPage()); // Eliminar la última página en blanco
// Salida del PDF
$pdf->Output('Reporte de Bitácora Matutino.pdf', 'I');
?>
