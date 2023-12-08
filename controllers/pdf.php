<?php
require('../assets/plugins/fpdf/fpdf.php');
require('../models/informe.modelo.php');
require_once('../assets/plugins/jpgraph/src/jpgraph.php');
require_once('../assets/plugins/jpgraph/src/jpgraph_bar.php');

// Obtener los datos enviados por el formulario
$desde = $_POST['desde'];
$hasta = $_POST['hasta'];
$grafico = $_POST['variable'];


$img = explode(',', $grafico, 2)[1];
$pic = 'data://text/plain;base64,' . $img;


list($dia_d, $mes_d, $ano_d) = explode("/", $desde);
list($dia_h, $mes_h, $ano_h) = explode("/", $hasta);

$meses = [
    "01" => "ENERO",
    "02" => "FEBRERO",
    "03" => "MARZO",
    "04" => "ABRIL",
    "05" => "MAYO",
    "06" => "JUNIO",
    "07" => "JULIO",
    "08" => "AGOSTO",
    "09" => "SEPTIEMBRE",
    "10" => "OCTUBRE",
    "11" => "NOVIEMBRE",
    "12" => "DICIEMBRE"];

    $mes_h = $meses[$mes_h];



//Capturar año actual
$año = date("Y");

// Covertir los datos obtenidos a formato valido para la BD
$fechaIni = date('Y-m-d', strtotime(str_replace('/', '-', $desde)));
$fechaFin = date('Y-m-d', strtotime(str_replace('/', '-', $hasta)));
$id_direccion = 1;


// $dataDireccion= $this-> InformeModelo::mdlDireccion();
// $data = $this->InformeModelo::mdlListarRangoFecha($fechaIni,$fechaFin,$id_direccion);


class PDF extends FPDF

{
    private $widths;
    private $aligns;
    private $y0;
    private $startY;
    private $LineHeight; // nueva variable de clase
    // Cabecera de página
    function Header()
    {

        // // Arial bold 15
        $this->SetFont('Arial', '', 11);
        $this->SetTextColor(0, 151, 199);
        // Número de página
        $this->Cell(350, 25, '' . $this->PageNo(), 0, 0, 'C');
        // Movernos a la derecha
        $this->Cell(80);
        $this->Ln(20);
    }

    // Pie de página
    function Footer()
    {
        $año = date("Y");
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'B', 14);
        // $this->Image('../assets/img/logoTesHeader.png', 35, 264, 33);
        $this->SetX(120);
        // $this->Cell(10, -20, iconv('UTF-8', 'windows-1252', 'Contraloría Académica - ') . $año);
    }
    function __construct()
    {
        parent::__construct();
        $this->y0 = $this->GetY();
        $this->startY = $this->y0;
        $this->SetMargins(12, 0, 10);
    }

    function CheckPageBreak($h)
    {
        if ($this->GetY() + $h > $this->PageBreakTrigger) {
            $this->AddPage($this->CurOrientation);
            $this->SetY($this->startY); // establecer la posición actual en $startY
            return true;
        }
        return false;
    }

    function SetStartY($y) // nuevo método
    {
        $this->startY = $y;
    }

    function Row($data, $fontSizes, $b, $lineHeight = 10, $verticalAlignColumns = [])
    {
        // Calcular el alto de la fila
        $nb = 0;
        for ($i = 0; $i < count($data); $i++) {
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        }
        $h = $lineHeight * $nb;
    
        // Restablecer la altura de línea a la fuente actual después de calcular el alto de la fila
        $this->SetLineHeight($this->FontSize);
    
        // Comprobar si es la primera fila de la tabla
        if ($this->GetY() == $this->startY) {
            $this->SetY($this->GetY() + $h - $this->FontSize);
        }
    
        // Comprobar si la fila se ajusta a la página actual
        if ($this->CheckPageBreak($h))
            $this->Ln();
    
        // Dibujar las celdas
        for ($i = 0; $i < count($data); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            $x = $this->GetX();
            $y = $this->GetY();
            $this->Rect($x, $y, $w, $h);
    
            // Verificar si se debe alinear verticalmente la columna actual
            $shouldVerticalAlign = isset($verticalAlignColumns[$i]) && $verticalAlignColumns[$i];
    
            // Calcular el alto real del texto
            $textHeight = $this->getStringHeight($w, $data[$i], $fontSizes[$i]);
    
            // Calcular la posición Y para centrar el texto verticalmente si es necesario
            $yPos = $y;
            if ($shouldVerticalAlign && $nb >= $this->NbLines($w, $data[$i])) {
                $yPos += (($h - $textHeight) / 2);
            }
    
            // Verificar si el texto coincide exactamente con el alto de una sola línea de texto
            $isSingleLine = abs($textHeight - $lineHeight) < 0.001;
    
            $this->SetFont('Arial', $b, $fontSizes[$i]); // Establecer el tamaño de la fuente
    
            // Alinear el texto en la parte superior si es una sola línea o si el número de líneas de la celda es igual al número de líneas del texto
            if ($isSingleLine || $nb == $this->NbLines($w, $data[$i])) {
                $this->SetXY($x, $y); // Establecer la posición Y en la parte superior
            } else {
                $this->SetXY($x, $yPos); // Establecer la posición Y centrada
            }
    
            $this->MultiCell($w, $lineHeight, $data[$i], 0, $a, false);
    
            $this->SetXY($x + $w, $y);
        }
    
        $this->Ln($h);
    }
    // Función auxiliar para obtener el alto real del texto en una celda
    function getStringHeight($cellWidth, $text, $fontSize)
    {
        $this->SetFont('Arial', '', $fontSize); // Usar la fuente que desees
        $width = $cellWidth - $this->cMargin * 2;
        $lines = explode("\n", $text);
        $textHeight = 0;
        foreach ($lines as $line) {
            $lineWidth = $this->GetStringWidth($line);
            $lineHeight = ceil($lineWidth / $width) * $this->FontSize;
            $textHeight += $lineHeight;
        }
        return $textHeight;
    }

    function SetLineHeight($height)
    {
        $this->LineHeight = $height;
    }

    function SetWidths($w)
    {
        // Establecer las dimensiones de cada celda
        $this->widths = $w;
    }

    function SetAligns($a)
    {
        // Establecer la alineación de cada celda
        $this->aligns = $a;
    }

    function NbLines($w, $txt)
    {
        $cw = &$this->CurrentFont['cw'];
        if ($w == 0)
            $w = $this->w - $this->rMargin - $this->x;
        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if ($nb > 0 and $s[$nb - 1] == "\n")
            $nb--;
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while ($i < $nb) {
            $c = $s[$i];
            if ($c == "\n") {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if ($c == ' ')
                $sep = $i;
            $l += $cw[$c];
            if ($l > $wmax) {
                if ($sep == -1) {
                    if ($i == $j)
                        $i++;
                } else
                    $i = $sep + 1;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            } else
                $i++;
        }
        return $nl;
    }
}

$config = InformeModelo::mdlObtenerConfig();

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$validacionGrafico = InformeModelo::mdlGenerarGrafico($fechaIni, $fechaFin);
if ($validacionGrafico == null) {
    $pdf->Cell(0, 20, iconv('UTF-8', 'windows-1252', 'NO SE ENCONTRARON DATOS EN EL RANGO DE FECHAS'), 0, 0, 'C');
} else {
    // Logo
    //$pdf->Image('../assets/img/logoTesHeader.png', 30, 25, 150);

    $pdf->Ln(80);
    $pdf->SetFont('Arial', 'B', 22);
    $pdf->Cell(0, 10, 'INFORME DEL ' . $dia_d . ' AL ' . $dia_h . ' DE ' . $mes_h . ' DE ' . $ano_h . '', 0, 0, 'C');
    $pdf->Ln();
    $pdf->SetFont('Arial', 'B', 20);
    // $pdf->Cell(0, 30, iconv('UTF-8', 'windows-1252', 'CONTRALORÍA ACADÉMICA'), 0, 0, 'C');
    $pdf->Ln();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->SetFont('Arial', 'B', 12);
    /************************************************
        CELDA ELABORADO POR
     *************************************************/
    $pdf->SetXY(20, 210);
    $pdf->MultiCell(86, 10, iconv('UTF-8', 'windows-1252', 'Elaborado por:' . "\n\n" . ' ' . "\n" . ' '), 1, 'L', 0);
    $pdf->SetXY(20, 210);
    $pdf->Cell(0, 40, iconv('UTF-8', 'windows-1252', $config[0]['elaboradopor']));
    $pdf->SetXY(20, 210);
    $pdf->Cell(0, 50, iconv('UTF-8', 'windows-1252', $config[0]['cargoelaborado']));

    /************************************************
        CELDA APROBADO POR
     *************************************************/
    $pdf->SetXY(106, 210);
    $pdf->MultiCell(86, 10, iconv('UTF-8', 'windows-1252', 'Aprobado por:' . "\n\n" . ' ' . "\n" . ' '), 1, 'L', 0);
    $pdf->SetXY(106, 210);
    $pdf->Cell(0, 40, iconv('UTF-8', 'windows-1252', $config[0]['aprobadopor']));
    $pdf->SetXY(106, 210);
    $pdf->Cell(0, 50, iconv('UTF-8', 'windows-1252', $config[0]['cargoaprobado']));
    $pdf->AddPage();
    $pdf->SetAutoPageBreak(true, 50);
    $dataDireccion = InformeModelo::mdlDireccion($fechaIni, $fechaFin);
    $pdf->SetY(25);
    $pdf->SetFont('Arial', 'B', 19);
    // $pdf->Cell(0, 0, iconv('UTF-8', 'windows-1252', 'Desarrollo:'), 0, 0, 'L');
    $pdf->Ln();
    // $pdf->Cell(0, 20, iconv('UTF-8', 'windows-1252', '        - Revisión de sílabos y micros del  periodo ' . $ano_h . ''), 0, 0, 'L');
    $pdf->SetWidths(array(40, 40, 40, 30, 35));
    $pdf->SetAligns(array('L', 'L', 'L', 'C', 'C'));
    $pdf->SetY(40);
    foreach ($dataDireccion as $row) {
        $pdf->SetFont('Arial', 'B', 18);
        $pdf->Cell(0, 20, iconv('UTF-8', 'windows-1252', $row["direccion"]), 0, 0, 'C');
        $pdf->Ln();
        $id_direccion = $row["id_direccion"];

        $pdf->SetFont('Arial', 'B', 11);

        // Definir el encabezado de la tabla
        $silabos = 0;
        $micros = 0;
        $header = array('Carrera', 'Asignatura', 'Profesor', 'Documento', 'Fecha revision');
        $pdf->Row($header, array(12, 12, 12, 12, 12), 'B');
        if($id_direccion==12){
            $data = InformeModelo::mdlListarRangoFechaCapel($fechaIni, $fechaFin);
        } else{
            $data = InformeModelo::mdlListarRangoFecha($fechaIni, $fechaFin, $id_direccion);
        }
        $dataGrafico = InformeModelo::mdlGenerarGrafico($fechaIni, $fechaFin);
        foreach ($data as $fill) {
            $pdf->SetStartY(20);
            $pdf->SetFont('Arial', '', 6);
            $resaño = substr($fill["year"], -2);
            
            $pdf->Row(array(
                iconv('UTF-8', 'windows-1252', $fill["carreras"]),
                iconv('UTF-8', 'windows-1252', $fill["nombre_materia"]),
                iconv('UTF-8', 'windows-1252', $fill["profesor"]),
                iconv('UTF-8', 'windows-1252', $fill["documento"] . " " . $fill["semestre_modulo"] . "-" . $resaño),
                iconv('UTF-8', 'windows-1252', $fill["fecha_entrega"])
            ), array(6, 6, 6, 8, 9), '', 5,[true, true, true,true,true] );
            if ($fill["documento"] == "SILABO") {
                $silabos++;
            } else {
                $micros++;
            }
        }
        if ($micros > 0) {
            $micros =  $micros . " Micros";
        } else {
            $micros = '';
        }
        $pdf->Row(array(
            '', '', '',
            iconv('UTF-8', 'windows-1252', $silabos . " Silabos\n" . $micros),
            ''
        ), array(6, 6, 6, 9, 6), 'B', 4);
    }
    $pdf->Ln(5);
    if ($pdf->GetY() + 80 > $pdf->GetPageHeight() - 60) {
        // Si se sobrepasa, agregar una nueva página
        $pdf->AddPage();
    }
    $pdf->Ln(10);
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->SetX(20);
    $pdf->Cell(0, 0, iconv('UTF-8', 'windows-1252', 'Silabos y Micros por carrera ' . $mes_h . ' - ' . $ano_h));
    $pdf->SetX(0);
    $pdf->image($pic, 20, $pdf->GetY() + 10, 170, 80, "png");

    $pdf->SetY($pdf->GetY() + 100);
    $pdf->SetWidths(array(100, 35, 35));
    $pdf->SetAligns(array('L', 'C', 'C'));
    $pdf->SetMargins(20, 0, 10);
    $pdf->SetX(20);
    $pdf->Row(array('Direccion', 'Silabo', 'Micros'), array(12, 12, 12), 'B');
    // Initialize variables to keep track of the total sum
    $totalSilabos = 0;
    $totalMicros = 0;
    foreach ($dataGrafico as $fill) {
        $totalMicros += $fill["micros"];
        $totalSilabos += $fill["silabos"];
        $pdf->SetX(20);
        $pdf->SetFont('Arial', '', 7);
        $pdf->Row(array(
            iconv('UTF-8', 'windows-1252', $fill["direccion"]),
            iconv('UTF-8', 'windows-1252', $fill["silabos"]),
            iconv('UTF-8', 'windows-1252', $fill["micros"]),
        ), array(12, 12, 12), '', 8);
    }
    $pdf->Row(array('TOTAL', $totalSilabos, $totalMicros), array(12, 12, 12), 'B');
}
$pdf->Output();
