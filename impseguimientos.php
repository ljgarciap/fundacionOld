<?php
include_once('bas/conn.php');

$idseguimientos=$_REQUEST['idt'];

mysqli_set_charset($con,"utf8");
	
$result1=mysqli_query($con,"select residentes.nombresr,residentes.apellidosr,residentes.tipodocumento,residentes.documentor,
seguimientos.fecha,seguimientos.hora,seguimientos.resumen,seguimientos.evaluacion,
seguimientos.tecnicas,seguimientos.tarea from seguimientos join residentes on seguimientos.idresidentes=residentes.idresidentes where seguimientos.idseguimientos='$idseguimientos'");

while ($resultx = mysqli_fetch_array($result1)) {
$nombresr=$resultx['nombresr'];
$apellidosr=$resultx['apellidosr'];
$tipodocumento=$resultx['tipodocumento'];
$documentor=$resultx['documentor'];
$fecha=$resultx['fecha'];
$hora=$resultx['hora'];
$resumen=$resultx['resumen'];
$evaluacion=$resultx['evaluacion'];
$tecnicas=$resultx['tecnicas'];
$tarea=$resultx['tarea'];
}

require('tfpdf.php');
class PDF extends tFPDF
{
// Cabecera de página
function Header()
{
    // Logo
	$this->Image('images/jemr.png',0,1,216);
	$this->Ln(20);	
}

// Pie de página
function Footer()
{
$this->Image('images/jemr.jpg',0,265,216);	  	
}
}

$pdf = new PDF();

$pdf->AddPage('P','Letter');
// Arial bold 15
$pdf->SetFont('Arial','B',16);
// Movernos a la derecha
$pdf->Cell(52);
// Título
$pdf->Cell(0,15,utf8_decode('REGISTRO DE ATENCIÓN INDIVIDUAL'));
// Salto de línea
$pdf->Ln(20);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,10,utf8_decode('Información personal'));
$pdf->Ln(12);
$pdf->SetFont('Arial','',10);
$pdf->Cell(110,10,utf8_decode('Fecha: '.$fecha));
$pdf->Cell(40,10,utf8_decode('Hora: '.$hora));
$pdf->Ln(10);
$pdf->Cell(110,10,utf8_decode('Nombre: '.$nombresr.' '.$apellidosr));
$pdf->Cell(40,10,utf8_decode('Documento: '.$tipodocumento.' '.$documentor));
$pdf->Ln(10);
$pdf->Cell(5,10,'--------------------------------------------------------------------------------------------------------------------------------------------------------------------');
$pdf->Ln(10);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,15,utf8_decode('Descripción breve de la Atención Individual Realizada'));
$pdf->Ln(15);
$pdf->SetFont('Arial','',10);
$html0="$resumen";
$pdf->Write(5,utf8_decode($html0),'');
$pdf->Ln(10);
$pdf->Cell(5,10,'--------------------------------------------------------------------------------------------------------------------------------------------------------------------');
$pdf->Ln(10);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,15,utf8_decode('Descripción de la Actitud, Estado de Ánimo y Lenguaje del paciente en el transcurso de la Atención Individual'));
$pdf->Ln(15);
$pdf->SetFont('Arial','',10);
$html1="$evaluacion";
$pdf->Write(5,utf8_decode($html1),'');
$pdf->Ln(10);
$pdf->Cell(5,10,'--------------------------------------------------------------------------------------------------------------------------------------------------------------------');
$pdf->Ln(10);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,15,utf8_decode('Técnicas Psicológicas o Estrategias Psicoeducativas Abordadas durante la Atención Individual'));
$pdf->Ln(15);
$pdf->SetFont('Arial','',10);
$html2="$tecnicas";
$pdf->Write(5,utf8_decode($html2),'');
$pdf->Ln(10);
$pdf->Cell(5,10,'--------------------------------------------------------------------------------------------------------------------------------------------------------------------');
$pdf->Ln(10);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,15,utf8_decode('Tarea a realizar por el paciente'));
$pdf->Ln(15);
$pdf->SetFont('Arial','',10);
$html3="$tarea";
$pdf->Write(5,utf8_decode($html3),'');
$pdf->Ln(40);

$pdf->Output();
?>