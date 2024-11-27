<?php
include '../../Conexion.php';
require_once('../../TCPDF-main/tcpdf.php');
session_start();
$maquina_id = isset($_SESSION['maquina_id']) ? $_SESSION['maquina_id'] : 'ID de la Máquina No Disponible';
$Turno = isset($_SESSION['Turno']) ? $_SESSION['Turno'] : 'No existen turnos seleccionados';
$tipoMaquina = isset($_SESSION['tipo_maquina']) ? $_SESSION['tipo_maquina'] : 'ID de la Máquina No Disponible';
$mes = isset($_SESSION['mes']) ? $_SESSION['mes'] : 'ID de la Máquina No Disponible';
date_default_timezone_set('America/Mexico_City');
$fecha = date('Y-m-d');
$semana = date('W');

class PDF extends TCPDF {
    // Encabezado
    public function Header() {
        $logoPath = '../../img/logopdf.png'; 
        $this->Image($logoPath, 10, 10, 50, 0, 'PNG'); 
        $this-> Ln(3);
        // Helvetica bold 15
        $this->SetFont('helvetica', '', 10);
        // Título
        $this->Cell(0, 10, 'Reporte de Bitácora', 0, false, 'C', 0, '', 0, false, 'T', 'M');
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
        // Helvetica italic 8
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
$obtenerColumnnasEnum = "CALL GetEnumColumns('$tipoMaquina')";
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
$queryMV = "CALL ConsultaMaquinas('$Turno','$tipoMaquina','$mes')";
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
//Aspectos Normales
      if ($tipoMaquina=='Cargador'){
        $aspectos = array(
            $row['Estado_Esqueleto'], $row['Nivel_Aceite_Motor'], $row['Nivel_Aceite_Hidraulico'],
            $row['Nivel_Anticongelante'], $row['Baterias'], $row['Luces'], $row['Neumaticos_Presion_75LB'],
            $row['Banda_Alternador_Ventilador'], $row['Nivel_Aceite_Transmision_Maquina_Encendida'],
            $row['Fugas_Maquina_Encendida'], $row['Frenos_Maquina_Trabajando'],
            $row['Presion_Motor_50_PSI_Maquina_Trabajando'],
            $row['Temperatura_Motor_100_180_Maquina_Trabajando'],
            $row['Horometro_Final'],''
        );
        
       

        $datosGenerales = array(
            $row['id_reporte'],$row['Nombre_Maquina'] , $row['Fecha_Reporte'],$row['Turno'], $row['Revisado_Por'], $row['estatus']
        );

        $observaciones = array(
            isset($row['Observaciones_Estado_Esqueleto']) ? $row['Observaciones_Estado_Esqueleto'] : 'Sin observaciones',
            isset($row['Observaciones_Nivel_Aceite_Motor']) ? $row['Observaciones_Nivel_Aceite_Motor'] : 'Sin observaciones',
            isset($row['Observaciones_Nivel_Aceite_Hidraulico']) ? $row['Observaciones_Nivel_Aceite_Hidraulico'] : 'Sin observaciones',
            isset($row['Observaciones_Nivel_Anticongelante']) ? $row['Observaciones_Nivel_Anticongelante'] : 'Sin observaciones',   
            isset($row['Observaciones_Baterias']) ? $row['Observaciones_Baterias'] : 'Sin observaciones', 
            isset($row['Observaciones_Luces']) ? $row['Observaciones_Luces'] : 'Sin observaciones', 
            isset($row['Observaciones_Neumaticos_Presion_75LB']) ? $row['Observaciones_Neumaticos_Presion_75LB'] : 'Sin observaciones', 
            isset($row['Observaciones_Banda_Alternador_Ventilador']) ? $row['Observaciones_Banda_Alternador_Ventilador'] : 'Sin observaciones', 
            isset($row['Observaciones_Nivel_Aceite_Maquina_Encendida']) ? $row['Observaciones_Nivel_Aceite_Maquina_Encendida'] : 'Sin observaciones',   
            isset($row['Observaciones_Fugas_Maquina_Encendida']) ? $row['Observaciones_Fugas_Maquina_Encendida'] : 'Sin observaciones', 
            isset($row['Observaciones_Frenos_Maquina_Trabajando']) ? $row['Observaciones_Frenos_Maquina_Trabajando'] : 'Sin observaciones', 
            isset($row['Observaciones_Presion_Motor_50_PSI_Maquina_Trabajando']) ? $row['Observaciones_Presion_Motor_50_PSI_Maquina_Trabajando'] : 'Sin observaciones', 
            isset($row['Observaciones_Temperatura_Motor_100_180_Maquina_Trabajando']) ? $row['Observaciones_Temperatura_Motor_100_180_Maquina_Trabajando'] : 'Sin observaciones',   
            isset($row['Observaciones_Horometro_Final']) ? $row['Observaciones_Horometro_Final'] : 'Sin observaciones', 
            isset($row['ObservacionesAdicionales']) ? $row['ObservacionesAdicionales'] : 'Sin observaciones'
 
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
            'Horómetro Final (Horas)',
            'Observaciones Adicionales' );

      } else if ($tipoMaquina=='Compresor'){
        $aspectos = array(
            $row['Estado_Equipo'], $row['Nivel_Aceite_Motor'], $row['Nivel_Anticongelante'],
            $row['Nivel_Aceite_Unidad_Compresion'], $row['Fugas'], $row['Ruidos_Extranos'], $row['Bateria'],
            $row['Horometro_Final'],''
        );
        
       

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
            isset($row['Observaciones_Horometro_Final']) ? $row['Observaciones_Horometro_Final'] : 'Sin observaciones',   
            isset($row['Observaciones_Adicionales']) ? $row['Observaciones_Adicionales'] : 'Sin observaciones'
        );

        // datos nombre de aspectos
        $aspectosDefault = array(
            'Estado del Equipo',
            'Nivel de Aceite del Motor',
            'Nivel de Anticongelante',
            'Nivel de Aceite Unidad de Compresion',
            'Fugas',
            'Ruidos Extraños',
            'Bateria',
           
            'Horómetro Final (Horas)','Observaciones Adicionales'
        );

      }else if ($tipoMaquina=='Cuadreador'){
        $aspectos = array(
            $row['Riel_Ruedas_Poleas_Tren'], $row['Ruidos_Extranos_Motor'], $row['Control_Botones'],
            $row['Limpieza_Clavijas'], $row['Limpieza_Motor'], $row['Limpieza_Riel'], $row['Inspeccion_General_Equipo'],
            $row['Estado_Conexiones_Quitar'], ''
        );
        
       

        $datosGenerales = array(
            $row['id_reporte'],$row['Nombre_Maquina'] , $row['Fecha_Reporte'],$row['Turno'], $row['Revisado_Por']
        );

        $observaciones = array(
            isset($row['Observaciones_Riel_Ruedas_Poleas_Tren']) ? $row['Observaciones_Riel_Ruedas_Poleas_Tren'] : 'Sin observaciones',
            isset($row['Observaciones_Ruidos_Extranos_Motor']) ? $row['Observaciones_Ruidos_Extranos_Motor'] : 'Sin observaciones',
            isset($row['Observaciones_Control_Botones']) ? $row['Observaciones_Control_Botones'] : 'Sin observaciones',
            isset($row['Observaciones_Limpiar_Clavijas']) ? $row['Observaciones_Limpiar_Clavijas'] : 'Sin observaciones',   
            isset($row['Observaciones_Motor']) ? $row['Observaciones_Motor'] : 'Sin observaciones', 
            isset($row['Observaciones_Riel']) ? $row['Observaciones_Riel'] : 'Sin observaciones', 
            isset($row['Observaciones_Inspeccion_General_Equipo']) ? $row['Observaciones_Inspeccion_General_Equipo'] : 'Sin observaciones', 
            isset($row['Observaciones_Estado_Conexiones_Quitar']) ? $row['Observaciones_Estado_Conexiones_Quitar'] : 'Sin observaciones',
            isset($row['AveriasEncontradasAlMomento']) ? $row['AveriasEncontradasAlMomento'] : 'Sin observaciones');

        // datos nombre de aspectos
        $aspectosDefault = array(
            'Estado de Riel, Ruedas, Poleas y Tren',
            'Ruidos Extraños en el Motor',
            'Control de Botones',
            'Limpieza de Clavijas',
            'Limpieza del Motor',
            'Limpieza del Riel',
            'Inspeccion General del Equipo',
            'Estado de las Conexiones Quitar',
            'Averias Encontradas al Momento'
        );

      } 
      //Espadas
      else if ($tipoMaquina=='Espada'){
        $aspectos = array(
            $row['Ajuste_Hoja'], 
            $row['Ajuste_Wideas'],
            $row['Estado_Control_Botones'],
            $row['Engrasar_Tren_Avance'],
            $row['Revision_Nivel_Aceite'], 
            $row['Ruidos_Extranos_Encender'],
            $row['Movimientos_Espada_Encender'],
            $row['Ruidos_Extraños_Antes_Apagar'], 
            $row['Inspeccion_General_Equipo'],
            $row['Limpiar_Cadena'], 
            $row['Enfriamiento_Motor'],
            $row['Limpieza_Exterior_Equipo'], 
           
            $row['Horometro_Final'], ''
        );
        
       

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
           
            isset($row['Observaciones_Horometro_Final']) ? $row['Observaciones_Horometro_Final'] : 'Sin observaciones',
            isset($row['Averias_Encontradas'])?$row['Averias_Encontradas']:'Sin Averias');
        // datos nombre de aspectos
        $aspectosDefault = array(
            'Ajuste de Hojas',
            'Ajuste de Wideas',
            'Estado de los Botones',
            'Engrasar Tren de Avance',
            'Revision de Nivel de Aceite',
            'Ruidos Extranos al Encender',
            'Movimientos de la Espada al Encender',
            'Ruidos Extranos antes de Apagar',
            'Inspeccion General del Equipo',
            'Limpiar la Cadena',
            'Enfriamiento del Motor',
            'Limpieza Exterior del Equipo',
           
            'Horometro Final', 'Averias Encontradas'
        );

      } //Excavadora
      else if ($tipoMaquina=='Excavadora'){
        $aspectos = array(
            $row['Estado_Esqueleto'], 
            $row['Nivel_Aceite_Motor'],
            $row['Nivel_Aceite_Hidraulico'],
            $row['Nivel_Anticongelante'],
            $row['Baterias'], 
            $row['Luces'],
            $row['Cadena_Avance'],
            $row['Banda_Alternador_Ventilador'], 
            $row['Fugas_Maquina_Encendida'],
            $row['Movimientos_Velocidad_Maquina_Trabajando'], 
            $row['Presion_Motor_50_PSI_Maquina_Trabajando'],
            $row['Temperatura_Motor_100_180_Maquina_Trabajando'], 
          
            $row['Horometro_Final'], ''
        );
        
       

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
           
            isset($row['observaciones_Horometro_Final']) ? $row['observaciones_Horometro_Final'] : 'Sin observaciones',
            isset($row['observaciones_Adicionales'])?$row['observaciones_Adicionales']:'Sin Averias');
        // datos nombre de aspectos
        $aspectosDefault = array(
           'Estado del Esqueleto',
           'Nivel de Aceite Motor',
           'Nivel de Aceite Hidraulico',
           'Nivel de Anticongelante',
           'Baterias',
           'Luces',
           'Cadena de Avance',
           'Banda Alternador Ventilador',
           'Fugas de Maquina',
           'Movimientos y Velocidad',
           'Presion de Motor 50 PSI ',
           'Temperatura de Motor 100-180',
           
           'Horometro Final','Observaciones Adicionales'
        );

      } //Generadores
      else if ($tipoMaquina=='Generador'){
        $aspectos = array(
            $row['Estado_Equipo'], 
            $row['Nivel_Aceite_Motor'],
            $row['Nivel_Anticongelante'],
            $row['Baterias'], 
            $row['Ruidos_Extranos'],
            $row['Fugas'],
          
            $row['Horometro_Final'],
           ''
        );
        
       

        $datosGenerales = array(
            $row['id_reporte'],$row['Nombre_Maquina'] , $row['Fecha_Reporte'],$row['Turno'], $row['Revisado_Por']
        );

        $observaciones = array(
            isset($row['observaciones_Estado_Equipo']) ? $row['observaciones_Estado_Equipo'] : 'Sin observaciones',
            isset($row['observaciones_Nivel_Aceite_Motor']) ? $row['observaciones_Nivel_Aceite_Motor'] : 'Sin observaciones',
            isset($row['observaciones_Nivel_Anticongelante']) ? $row['observaciones_Nivel_Anticongelante'] : 'Sin observaciones',
            isset($row['observaciones_Baterias']) ? $row['observaciones_Baterias'] : 'Sin observaciones',
            isset($row['observaciones_Ruidos_Extranos']) ? $row['observaciones_Ruidos_Extranos'] : 'Sin observaciones',   
            isset($row['observaciones_Fugas']) ? $row['observaciones_Fugas'] : 'Sin observaciones', 
            
            isset($row['observaciones_Horometro_Final']) ? $row['observaciones_Horometro_Final'] : 'Sin observaciones', 
            isset($row['observaciones_Adicionales']) ? $row['observaciones_Adicionales'] : 'Sin observaciones',
        );
        // datos nombre de aspectos
        $aspectosDefault = array(
          'Estado del Equipo',
          'Nivel de Aceite Motor',
          'Nivel de Anticongelante',
          'Baterias',
          'Ruidos Extranos',
          'Fugas',
        
          'Horometro Final',
          'Observaciones Adicionales'
        );

      }//Hilos
      else if ($tipoMaquina=='Hilo'){
        $aspectos = array(
            $row['Control_Botones'], 
            $row['Revision_Movimientos_Avance'],
            $row['Revisar_Movimientos_Polea'],
            $row['Revisar_Giros_Motor'], 
            $row['Limpieza_Clavijas'],
            $row['Interior_Exterior_Carro'],
            $row['Engrasar_Bastagos'], 
            $row['Ruidos_Extranos'],
            $row['Inspeccion_General_Equipo'],
            $row['Estado_Conexiones_Quitar'],
            
            $row['Horometro_Final'],
           ''
        );
        
       

        $datosGenerales = array(
            $row['id_reporte'],$row['Nombre_Maquina'] , $row['Fecha_Reporte'],$row['Turno'], $row['Revisado_Por']
        );

        $observaciones = array(
            isset($row['Observaciones_Control_Botones']) ? $row['Observaciones_Control_Botones'] : 'Sin observaciones',
            isset($row['Observaciones_Revision_Movimientos_Avance']) ? $row['Observaciones_Revision_Movimientos_Avance'] : 'Sin observaciones',
            isset($row['Observaciones_Revisar_Movimientos_Polea']) ? $row['Observaciones_Revisar_Movimientos_Polea'] : 'Sin observaciones',
            isset($row['Observaciones_Revisar_Giros_Motor']) ? $row['Observaciones_Revisar_Giros_Motor'] : 'Sin observaciones',
            isset($row['Observaciones_Limpieza_Clavijas']) ? $row['Observaciones_Limpieza_Clavijas'] : 'Sin observaciones',   
            isset($row['Observaciones_InteriorExteriorCarro']) ? $row['Observaciones_InteriorExteriorCarro'] : 'Sin observaciones', 
            isset($row['Observaciones_Engrasar_Bastagos']) ? $row['Observaciones_Engrasar_Bastagos'] : 'Sin observaciones', 
            isset($row['Observaciones_Ruidos_Extranos']) ? $row['Observaciones_Ruidos_Extranos'] : 'Sin observaciones', 
            isset($row['Observaciones_Inspeccion_General_Equipo']) ? $row['Observaciones_Inspeccion_General_Equipo'] : 'Sin observaciones', 
            isset($row['Observaciones_Estado_Conexiones_Quitar']) ? $row['Observaciones_Estado_Conexiones_Quitar'] : 'Sin observaciones', 

          
            isset($row['Observaciones_Horometro_Final']) ? $row['Observaciones_Horometro_Final'] : 'Sin observaciones', 
            isset($row['Observaciones_Adicionales']) ? $row['Observaciones_Adicionales'] : 'Sin observaciones',
        );
        // datos nombre de aspectos
        $aspectosDefault = array(
          'Control de Botones',
          'Revisión de Movimientos de Avance',
          'Revisar Movimientos de Polea',
          'Revisar Giros del Motor',
          'Limpieza de Clavijas',
          'Interior y Exterior del Carro',
          'Engrasar Bastagos',
          'Ruidos Extranos',
          'Inspección General del Equipo',
          'Estado de Conexiones al Quitar',
         
          'Horometro Final',
          'Observaciones Adicionales'
        );

      }
      //Hilo_Dazzini
      else if ($tipoMaquina=='Hilo_Dazzini'){
        $aspectos = array(
            $row['Control_Botones'], 
            $row['Revision_Movimientos_Avance'],
            $row['Revisar_Movimientos_Polea'],
            $row['Revisar_Giros_Motor'], 
            $row['Limpieza_Clavijas'],
            $row['Interior_Exterior_Carro'],
            $row['Engrasar_Bastagos'], 
            $row['Ruidos_Extranos'],
            $row['Inspeccion_General_Equipo'],
            $row['Estado_Conexiones_Quitar'],
           
            $row['Horometro_Final'],
           ''
        );
        
       

        $datosGenerales = array(
            $row['id_reporte'],$row['Nombre_Maquina'] , $row['Fecha_Reporte'],$row['Turno'], $row['Revisado_Por']
        );

        $observaciones = array(
            isset($row['Observaciones_Control_Botones']) ? $row['Observaciones_Control_Botones'] : 'Sin observaciones',
            isset($row['Observaciones_Revision_Movimientos_Avance']) ? $row['Observaciones_Revision_Movimientos_Avance'] : 'Sin observaciones',
            isset($row['Observaciones_Revisar_Movimientos_Polea']) ? $row['Observaciones_Revisar_Movimientos_Polea'] : 'Sin observaciones',
            isset($row['Observaciones_Revisar_Giros_Motor']) ? $row['Observaciones_Revisar_Giros_Motor'] : 'Sin observaciones',
            isset($row['Observaciones_Limpieza_Clavijas']) ? $row['Observaciones_Limpieza_Clavijas'] : 'Sin observaciones',   
            isset($row['Observaciones_InteriorExteriorCarro']) ? $row['Observaciones_InteriorExteriorCarro'] : 'Sin observaciones', 
            isset($row['Observaciones_Engrasar_Bastagos']) ? $row['Observaciones_Engrasar_Bastagos'] : 'Sin observaciones', 
            isset($row['Observaciones_Ruidos_Extranos']) ? $row['Observaciones_Ruidos_Extranos'] : 'Sin observaciones', 
            isset($row['Observaciones_Inspeccion_General_Equipo']) ? $row['Observaciones_Inspeccion_General_Equipo'] : 'Sin observaciones', 
            isset($row['Observaciones_Estado_Conexiones_Quitar']) ? $row['Observaciones_Estado_Conexiones_Quitar'] : 'Sin observaciones', 

            
            isset($row['Observaciones_Horometro_Final']) ? $row['Observaciones_Horometro_Final'] : 'Sin observaciones', 
            isset($row['Observaciones_Adicionales']) ? $row['Observaciones_Adicionales'] : 'Sin observaciones',
        );
        // datos nombre de aspectos
        $aspectosDefault = array(
          'Control / Botones',
          'Revisión de Movimientos de Avance',
          'Revisar Movimientos de Polea',
          'Revisar Giros del Motor',
          'Limpieza de Clavijas',
          'Interior y Exterior del Carro',
          'Engrasar Bastagos',
          'Ruidos Extraños',
          'Inspección General del Equipo',
          'Estado de Conexiones a Quitar',
          
          'Horometro Final',
          'Observaciones Adicionales'
        );

      }
      
      //Perforadoras
      else if ($tipoMaquina=='Perforadora'){
        $aspectos = array(
            $row['Estado_Equipo'], 
            $row['Nivel_Aceite_Centralina'],
            $row['Revisar_Conexiones'],
            $row['Arranque_Motor_Centralina'], 
            $row['Revision_Bomba_Trabajando'],
            $row['Revision_Movimientos'],
            $row['Fugas'], 
            $row['Ruidos_Extraños'],
            $row['Inspeccion_General_Equipo'],
            $row['Movimiento_Motor_Regreso'],
            $row['Estados_Conexiones_Quitar'],
           
            $row['Horometro_Final'],
           ''
        );
        
       

        $datosGenerales = array(
            $row['id_reporte'],$row['Nombre_Maquina'] , $row['Fecha_Reporte'],$row['Turno'], $row['Revisado_Por']
        );

        $observaciones = array(
            isset($row['Observaciones_Estado_Equipo']) ? $row['Observaciones_Estado_Equipo'] : 'Sin observaciones',
            isset($row['Observaciones_Nivel_Aceite_Centralina']) ? $row['Observaciones_Nivel_Aceite_Centralina'] : 'Sin observaciones',
            isset($row['Observaciones_Revisar_Conexiones']) ? $row['Observaciones_Revisar_Conexiones'] : 'Sin observaciones',
            isset($row['Observaciones_Arranque_Motor']) ? $row['Observaciones_Arranque_Motor'] : 'Sin observaciones',
            isset($row['Observaciones_Revision_Bomba']) ? $row['Observaciones_Revision_Bomba'] : 'Sin observaciones',   
            isset($row['Observaciones_Revision_Movimientos']) ? $row['Observaciones_Revision_Movimientos'] : 'Sin observaciones', 
            isset($row['Observaciones_Fugas']) ? $row['Observaciones_Fugas'] : 'Sin observaciones', 
            isset($row['Observaciones_Ruidos_Extraños']) ? $row['Observaciones_Ruidos_Extraños'] : 'Sin observaciones', 
            isset($row['Observaciones_Inspeccion_General_Equipo']) ? $row['Observaciones_Inspeccion_General_Equipo'] : 'Sin observaciones', 
            isset($row['Observaciones_Movimiento_Motor_Regreso']) ? $row['Observaciones_Movimiento_Motor_Regreso'] : 'Sin observaciones', 
            isset($row['Observaciones_Estado_Conexiones_Quitar']) ? $row['Observaciones_Estado_Conexiones_Quitar'] : 'Sin observaciones', 

           
            isset($row['Observaciones_Horometro_Final']) ? $row['Observaciones_Horometro_Final'] : 'Sin observaciones', 
            isset($row['Observaciones_Adicionales']) ? $row['Observaciones_Adicionales'] : 'Sin observaciones',
        );
        // datos nombre de aspectos
        $aspectosDefault = array(
          'Estado del Equipo',
          'Nivel de Aceite Centralina',
          'Revisar Conexiones',
          'Arranque Motor Centralina',
          'Revision Bomba Trabajando',
          'Revision Movimientos',
          'Fugas',
          'Ruidos Extraños',
          'Inspeccion General Equipo',
          'Movimiento Motor Regreso',
          'Estado Conexiones Quitar',
         
          'Horometro Final',
          'Observaciones Adicionales'
          
        );

      }  // Yucle
      else if ($tipoMaquina=='Yucle'){
        $aspectos = array(
            $row['Estado_Esqueleto'], 
            $row['Nivel_Aceite_Motor'],
            $row['Nivel_Aceite_Hidraulico'],
            $row['Nivel_Anticongelante'], 
            $row['Baterias'],
            $row['Luces'],
            $row['Neumaticos_Presion_70LB'], 
            $row['Banda_Alternador_Ventilador'],
            $row['Nivel_Aceite_Transmision'],
            $row['Fugas'],
            $row['Frenos'],
            $row['Presion_Motor_50_PSI'],
            $row['Temperatura_Motor_100_180'],

           
            $row['Horometro_Final'],
           ''
        );
        
       

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
            isset($row['Observaciones_Fugas']) ? $row['Observaciones_Fugas'] : 'Sin observaciones', 
            isset($row['Observaciones_Neumaticos_Presion_70LB']) ? $row['Observaciones_Neumaticos_Presion_70LB'] : 'Sin observaciones', 
            isset($row['Observaciones_Banda_Alternador_Ventilador']) ? $row['Observaciones_Banda_Alternador_Ventilador'] : 'Sin observaciones', 
            isset($row['Observaciones_Fugas']) ? $row['Observaciones_Fugas'] : 'Sin observaciones', 
            isset($row['Observaciones_Frenos']) ? $row['Observaciones_Frenos'] : 'Sin observaciones', 
            isset($row['Observaciones_Presion_Motor_50_PSI']) ? $row['Observaciones_Presion_Motor_50_PSI'] : 'Sin observaciones', 
            isset($row['Observaciones_Temperatura_Motor_100_180']) ? $row['Observaciones_Temperatura_Motor_100_180'] : 'Sin observaciones', 

           
            isset($row['Observaciones_Horometro_Final']) ? $row['Observaciones_Horometro_Final'] : 'Sin observaciones', 
            isset($row['Observaciones_Adicionales']) ? $row['Observaciones_Adicionales'] : 'Sin observaciones',
        );
        // datos nombre de aspectos
        $aspectosDefault = array(
          'Estado del Esqueleto',
          'Nivel de Aceite del Motor',
          'Nivel de Aceite Hidraulico',
          'Nivel de Anticongelante',
          'Baterias',
          'Luces',
          'Neumaticos Presion 70LB',
          'Banda Alternador Ventilador',
          'Nivel Aceite Transmision',
          'Fugas',
          'Frenos',
          'Presion Motor 50 PSI',
          'Temperatura Motor 100-180', 
         
          'Horometro Final',
          'Observaciones Adicionales'
          
        );

      }
        //Aspectos del Check
        if ($row['Turno'] == 'Check' AND $tipoMaquina=='Cargador') {
            array_pop($aspectos);array_pop($aspectosDefault);array_pop($observaciones);
            $aspectos = array_merge($aspectos, array(
                $row['CambiarFiltros'], $row['RevisarMangueras'], $row['EngrasarTazas_Pernos_Gatos'], $row['RevisarSistemaElectrico_Marcha'],
                $row['RevisarSistema_Avance'], $row['RevisarNivelesFluidoGeneral'],
                '' // Averías encontradas al momento del check
            ));

            $observaciones = array_merge($observaciones, array(
                isset($row['Observaciones_CambiarFiltros']) ? $row['Observaciones_CambiarFiltros'] : 'Sin observaciones',
                isset($row['Observaciones_RevisarMangueras']) ? $row['Observaciones_RevisarMangueras'] : 'Sin observaciones',
                isset($row['Observaciones_EngrasarTazasPernosGatos']) ? $row['Observaciones_EngrasarTazasPernosGatos'] : 'Sin observaciones',
                isset($row['Observaciones_RevisarSistemaElectrico']) ? $row['Observaciones_RevisarSistemaElectrico'] : 'Sin observaciones',
                isset($row['Observaciones_RevisarSistemaAvance']) ? $row['Observaciones_RevisarSistemaAvance'] : 'Sin observaciones',
                isset($row['Observaciones_RevisarNivelesFluidoGeneral']) ? $row['Observaciones_RevisarNivelesFluidoGeneral'] : 'Sin observaciones',
                isset($row['AveriasEncontradasMomento']) ? $row['AveriasEncontradasMomento'] : 'Sin observaciones'
            ));

            $aspectosDefault = array_merge($aspectosDefault, array(
                'Cambiar Filtros',
                'Revisar Mangueras',
                'Engrasar Tazas, Pernos y Gatos',
                'Revisar Sistema Eléctrico (Marcha)',
                'Revisar Sistema De Avance',
                'Revisar Niveles De Fluido en General',
                'Averías Encontradas Durante el Check'
            ));
            //Compresores Check
        } else  if ($row['Turno'] == 'Check' AND $tipoMaquina=='Compresor') {
            array_pop($aspectos);array_pop($aspectosDefault);array_pop($observaciones);
            $aspectos = array_merge($aspectos, array(
                $row['CambiarFiltros'], 
                $row['RevisarMangueras'], 
                $row['RevisarSistemaElectrico(Marcha)'], 
                $row['RevisarNivelesFluidoGeneral'],
                '',
                ''
                 // Averías encontradas al momento del check
            ));

            $observaciones = array_merge($observaciones, array(
                isset($row['Observaciones_CambiarFiltros']) ? $row['Observaciones_CambiarFiltros'] : 'Sin observaciones',
                isset($row['Observaciones_RevisarMangueras']) ? $row['Observaciones_RevisarMangueras'] : 'Sin observaciones',
                isset($row['Observaciones_SistemaElectrico(Marcha)']) ? $row['Observaciones_SistemaElectrico(Marcha)'] : 'Sin observaciones',
                isset($row['Observaciones_RevisarNivelesFluidoGeneral']) ? $row['Observaciones_RevisarNivelesFluidoGeneral'] : 'Sin observaciones',
                isset($row['AveriasEncontradasMomentoServicio']) ? $row['AveriasEncontradasMomentoServicio'] : 'Sin Averias'
                
            ));

            $aspectosDefault = array_merge($aspectosDefault, array(
                'Cambiar Filtros',
                'Revisar Mangueras',
                'Revisar Sistema Eléctrico (Marcha)',
                'Revisar Niveles De Fluido en General',
                'Averías Encontradas Durante el Check',
                ''
            ));
        } 
        //Excavadoras Check
        else  if ($row['Turno'] == 'Check' AND $tipoMaquina=='Excavadora') {
            array_pop($aspectos);array_pop($aspectosDefault);array_pop($observaciones);
            $aspectos = array_merge($aspectos, array(
                $row['CambiarFiltros'], 
                $row['RevisarMangueras'], 
                $row['EngrasarTazas_Pernos_Gatos'], 
                $row['RevisarSistemaElectrico_Marcha'],
                $row['RevisarSistema_Avance'],
                $row['RevisarNivelesFluidoGeneral'],
                $row['RevisarSistemasMovimientosBotes'], ''
                 // Averías encontradas al momento del check
            ));

            $observaciones = array_merge($observaciones, array(
                isset($row['observaciones_CambiarFiltros']) ? $row['observaciones_CambiarFiltros'] : 'Sin observaciones',
                isset($row['observaciones_RevisarMangueras']) ? $row['observaciones_RevisarMangueras'] : 'Sin observaciones',
                isset($row['observaciones_EngrasarTazasPernosGatos']) ? $row['observaciones_EngrasarTazasPernosGatos'] : 'Sin observaciones',
                isset($row['observaciones_RevisarSistemaElectrico']) ? $row['observaciones_RevisarSistemaElectrico'] : 'Sin observaciones',
                isset($row['observaciones_RevisarSistemaAvance']) ? $row['observaciones_RevisarSistemaAvance'] : 'Sin Averias',
                isset($row['observaciones_RevisarNivelesFluidoGeneral']) ? $row['observaciones_RevisarNivelesFluidoGeneral'] : 'Sin Averias',
                isset($row['observaciones_RevisarSistemasMovimientosBotes']) ? $row['observaciones_RevisarSistemasMovimientosBotes'] : 'Sin observaciones',
                isset($row['AveriasEncontradasMomento']) ? $row['AveriasEncontradasMomento'] : 'Sin observaciones'


            ));

            $aspectosDefault = array_merge($aspectosDefault, array(
                'Cambiar Filtros',
                'Revisar Mangueras',
                'Engrasar Tazas, Pernos y Gatos',
                'Revisar Sistema Eléctrico (Marcha)',
                'Revisar Sistema Avance',
                'Revisar Niveles De Fluido en General',
                'Revisar Sistemas Movimientos Botes',
                'Averias Encontradas al Momento'
            ));
        }
         //Generadores Check
         else  if ($row['Turno'] == 'Check' AND $tipoMaquina=='Generador') {
            array_pop($aspectos);array_pop($aspectosDefault);array_pop($observaciones);
            $aspectos = array_merge($aspectos, array(
                $row['CambiarFiltros'], 
                $row['RevisarMangueras'], 
                $row['RevisarSistemaElectrico_Marcha'], 
                $row['RevisarNivelesFluidoGeneral'],
                
               ''
                 // Averías encontradas al momento del check
            ));

            $observaciones = array_merge($observaciones, array(
                isset($row['observaciones_CambiarFiltros']) ? $row['observaciones_CambiarFiltros'] : 'Sin observaciones',
                isset($row['observaciones_RevisarMangueras']) ? $row['observaciones_RevisarMangueras'] : 'Sin observaciones',
                isset($row['observaciones_RevisarSistemaElectrico']) ? $row['observaciones_RevisarSistemaElectrico'] : 'Sin observaciones',
                isset($row['observaciones_RevisarNivelesFluidoGeneral']) ? $row['observaciones_RevisarNivelesFluidoGeneral'] : 'Sin Averias',
                isset($row['AveriasEncontradasMomento'])? $row['AveriasEncontradasMomento'] : 'Sin Averias',

                ''

            ));

            $aspectosDefault = array_merge($aspectosDefault, array(
                'Cambiar Filtros',
                'Revisar Mangueras',
                'Revisar Sistema Eléctrico (Marcha)',
                'Revisar Niveles De Fluido en General',
                'Averias Encontradas al Momento'
            ));
        }  
        
    //Yucle    
    else  if ($row['Turno'] == 'Check' AND $tipoMaquina=='Yucle') {
        array_pop($aspectos);array_pop($aspectosDefault);array_pop($observaciones);
            $aspectos = array_merge($aspectos, array(
                $row['CambiarFiltros'], 
                $row['RevisarMangueras'], 
                $row['EngrasarTazas_Pernos_Gatos'], 
                $row['RevisarSistemaElectrico_Marcha'],
                $row['RevisarSistema_Avance'],
                $row['RevisarNivelesFluidoGeneral'],
                
               ''
                 // Averías encontradas al momento del check
            ));

            $observaciones = array_merge($observaciones, array(
                isset($row['Observaciones_CambiarFiltros']) ? $row['Observaciones_CambiarFiltros'] : 'Sin observaciones',
                isset($row['Observaciones_RevisarMangueras']) ? $row['Observaciones_RevisarMangueras'] : 'Sin observaciones',
                isset($row['Observaciones_EngrasarTazasPernosGatos']) ? $row['Observaciones_EngrasarTazasPernosGatos'] : 'Sin observaciones',
                isset($row['Observaciones_RevisarSistemaElectrico']) ? $row['Observaciones_RevisarSistemaElectrico'] : 'Sin observaciones',
                isset($row['Observaciones_RevisarSistemaAvance']) ? $row['Observaciones_RevisarSistemaAvance'] : 'Sin observaciones',
                isset($row['Observaciones_RevisarNivelesFluidoGeneral']) ? $row['Observaciones_RevisarNivelesFluidoGeneral'] : 'Sin observaciones',

                
                isset($row['AveriasEncontradasMomento'])? $row['AveriasEncontradasMomento'] : 'Sin Averias',

                ''

            ));

            $aspectosDefault = array_merge($aspectosDefault, array(
              'Cambiar Filtros',
              'Revisar Mangueras',
              'Engrasar Tazas, Pernos y Gatos',
              'Revisar Sistema Eléctrico (Marcha)',
              'Revisar Sistema (Avance)',
              'Revisar Niveles De Fluido en General',
              'Averias Encontradas al Momento'
            ));
        }

        // Configuración del PDF
        $pdf->SetMargins(10, 10, 10); // Márgenes del documento
        $pdf->SetHeaderMargin(10);
        $pdf->SetFooterMargin(10);

        $pdf->SetAutoPageBreak(true, 20);

        $reporte = html_entity_decode($datosGenerales[0]);
        $nombreMaquina = html_entity_decode($datosGenerales[1]);
        $fecha = html_entity_decode($datosGenerales[2]);
        $turno = html_entity_decode($datosGenerales[3]);
        $revisadoPor = html_entity_decode($datosGenerales[4]);

        $pdf->Cell(0, 5, 'No. de Reporte: '.$datosGenerales[0], 0, 1, 'L', 0, '', 0, false, 'T', 'M');
        $pdf->Cell(0, 5, 'Nombre de la Máquina: '.$datosGenerales[1], 0, 1, 'L', 0, '', 0, false, 'T', 'M');
        $pdf->Cell(0, 5, 'Fecha: '.$datosGenerales[2], 0, 1, 'L', 0, '', 0, false, 'T', 'M');
        $pdf->cell (0,5,'Semana: '.$semana,0,1,'L',0,'',0,false,'T','M');
        $pdf->Cell(0, 5, 'Turno: '.$datosGenerales[3], 0, 1, 'L', 0, '', 0, false, 'T', 'M');
        $pdf->Cell(0, 5, 'Revisado por: '.$datosGenerales[4], 0, 1, 'L', 0, '', 0, false, 'T', 'M');
        $pdf->Cell(0, 5, 'Estatus de la máquina: '.$datosGenerales[5], 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $pdf->SetFillColor(220, 220, 220); // Gris claro
        $pdf->SetTextColor(0, 0, 0); // Negro
        $pdf->SetFont('helvetica', 'B', 12);

        $pdf->Cell(0, 10, 'Bitácora de mantenimiento', 0, false, 'C', 0, '', 0, false, 'T', 'M');
        $pdf->Ln();

        $pdf->SetFillColor(220, 220, 220);
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->Cell($aspectosWidth, 8, 'Aspectos', 1, 0, 'C', 1);
        $pdf->Cell($condicionWidth, 8, 'Estado', 1, 0, 'C', 1);
        $pdf->Cell($observacionesWidth, 8, 'Observaciones', 1, 0, 'C', 1);
        $pdf->Ln();

       

        foreach ($aspectos as $index => $aspecto) {
            if (isset($aspectosDefault[$index]) && isset($observaciones[$index])) {
                // Decodificar las entidades HTML
                $aspecto = html_entity_decode($aspecto);
                $aspectosDefault[$index] = html_entity_decode($aspectosDefault[$index]);
                $observaciones[$index] = html_entity_decode($observaciones[$index]);
        
                $numLineasAspectos = $pdf->getNumLines($aspectosDefault[$index], $aspectosWidth);
                $numLineasObservaciones = $pdf->getNumLines($observaciones[$index], $observacionesWidth);
                $maxNumLineas = max($numLineasAspectos, $numLineasObservaciones);
                $alturaCelda = $maxNumLineas * 6;
        
                if ($pdf->GetY() + $alturaCelda > $pdf->getPageHeight() - $pdf->getBreakMargin()) {
                    $pdf->AddPage();
                    $pdf->Ln(15);
                }

            $pdf->SetFont('helvetica', 'B', 12);
            if ($tipoMaquina == 'Cargador') {
            if ($index == 8) {
                $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Evaluación con Máquina Encendida', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
            } else if ($index == 10) {
                $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Evaluación con Máquina Trabajando', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
            } else if ($index == 13) {
                $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Hórometro', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
            } elseif ($index == 14) {
                if ($datosGenerales[3] == 'Check') {
                    $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Check de Mantenimiento', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
                } else {
                    $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Observaciones Adicionales', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
                }
            }

        } else if ($tipoMaquina == 'Compresor') {
            if ($index == 7) {
                $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Hórometro', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
             }elseif ($index == 8) {
                if ($index == 8 && $datosGenerales[3] == 'Check') {
                    $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Check de Mantenimiento', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
                } else {
                    $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Observaciones Adicionales', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
                }
            }
            
            } else if ($tipoMaquina == 'Cuadreador') {
                if ($index == 3) {
                    $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Aspectos A Limpiar', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
                }else if ($index == 6) {
                    $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Antes De Apagar', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
                } else if ($index == 8) {
                    $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Observación Adicional', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
                }
            } else if ($tipoMaquina == 'Espada') {
                if ($index == 5) {
                    $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Revisión Al Encender', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
            } else if ($index == 7) {
                    $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Revisión Antes de Apagar', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
                } else if ($index == 12) {
                    $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Hórometro', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
                }else if ($index == 13) {
                    $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Observaciones Adicionales', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
                }
        } else if ($tipoMaquina == 'Excavadora') {
            if ($index == 8) {
                $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Máquina Encendida', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
            } else if ($index == 9) {
                $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Máquina Trabajando', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
            } else if ($index == 12) {
                $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Hórometro', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
            }else if ($index == 13) {
                if ($datosGenerales[3] == 'Check') {
                    $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Check de Mantenimiento', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
                } else {
                    $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Observaciones Adicionales', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
                }
            }

        } else if ($tipoMaquina == 'Generador') {
            if ($index == 6) {
                $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Horómetro', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
            }else if ($index == 7) {
                if ($datosGenerales[3] == 'Check') {
                    $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Check de Mantenimiento', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
                } else {
                    $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Observaciones Adicionales', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
                }
            }

        } else if ($tipoMaquina == 'Hilo') {
            if ($index == 4) {
        $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Aspectos a Limpiar', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
    }elseif ($index == 7) {
        $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Revisión de Máquina Antes de Apagar', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
    }elseif ($index == 10) {
        $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Horómetro', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
    } elseif ($index == 11) {
            $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Observaciones Adicionales', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
        }

    } else if ($tipoMaquina == 'Hilo_Dazzini') {
        if ($index == 4) {
            $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Aspectos a Limpiar', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
        }elseif ($index == 7) {
            $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Revisión de Máquina Antes de Apagar', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
        }elseif ($index == 10) {
            $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Horómetro', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
        }elseif ($index == 11) {
            $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Observaciones Adicionales', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
        }
    } else if ($tipoMaquina == 'Perforadora') {
        if ($index == 3) {
            $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Revisión Maquina Encendida', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
        }elseif ($index == 6) {
            $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Revisión de Máquina Antes de Apagar', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
        }elseif ($index == 11) {
            $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Horómetro', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
        }elseif ($index == 12) {
            $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Observaciones Adicionales', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
        }
    } else if ($tipoMaquina == 'Yucle') {
        if ($index == 8) {
            $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Máquina Encendida', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
        }else if ($index == 10) {
            $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Máquina Trabajando', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
        }elseif ($index == 13) {
            $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Horómetro', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
        }elseif ($index == 14) {
            if ($datosGenerales[3] == 'Check') {
                $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Check de Mantenimiento', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
            } else {
                $pdf->Cell($pageWidth - $pdf->getMargins()['left'] - $pdf->getMargins()['right'], 9, 'Observaciones Adicionales', 0, 1, 'C', 0, '', 0, false, 'T', 'M');
                }
            }
    }
            $pdf->SetFont('', '', 10);

            $pdf->MultiCell($aspectosWidth, $alturaCelda, $aspectosDefault[$index], 1, 'L', 0, 0, '', '', true, 0, false, true, $alturaCelda, 'T');

            if ($datosGenerales[3] == 'Check') {
                if ($aspecto == 'Bueno') {
                    $pdf->SetFillColor(0, 129, 84); // Verde pálido
                } else if ($aspecto == 'Malo') {
                    $pdf->SetFillColor(161, 20, 13); // Rojo salmón claro
                } else if ($aspecto == 'Si' || $aspecto == 'Sí') {
                    $pdf->SetFillColor(0, 129, 84); // Verde
                } else if ($aspecto == 'No') {
                    $pdf->SetFillColor(161, 20, 13); // Rojo
                }
            } else { 
                $pdf->SetFillColor(255, 255, 255);
                if ($aspecto == 'Bueno') {
                    $pdf->SetFillColor(0, 129, 84); // Verde pálido
                } else if ($aspecto == 'Malo') {
                    $pdf->SetFillColor(161, 20, 13); // Rojo salmón claro
                } else if ($aspecto == 'Si' || $aspecto == 'Sí') {
                    $pdf->SetFillColor(0, 129, 84); // Verde
                } else if ($aspecto == 'No') {
                    $pdf->SetFillColor(161, 20, 13); // Rojo
                }
            }
    

            
            
        
        

            $pdf->Cell($condicionWidth, $alturaCelda, $aspecto, 1, 0, 'C', 1, '', 0, false, 'T', 'M');
            $pdf->SetFillColor(255, 255, 255);

            $pdf->MultiCell($observacionesWidth, $alturaCelda, $observaciones[$index], 1, 'C', 0, 1, '', '', true);
        }
    }

        $pdf->AddPage();
      $pdf->Ln(20);
    }
}
$pdf->deletePage($pdf->getPage());
mysqli_close($conn);

$datosGenerales = ""; 
$fechaDescarga = date('Y-m-d'); 

$nombreArchivo = "Reporte_Bitacora_{$tipoMaquina}_{$fechaDescarga}.pdf";

$pdf->Output($nombreArchivo, 'I');
?>
