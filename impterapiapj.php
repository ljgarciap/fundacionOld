<?php
include_once('bas/conn.php');

$idterapiap=$_REQUEST['idt'];

mysqli_set_charset($con,"utf8");
	
$result1=mysqli_query($con,"select residentes.nombresr,residentes.apellidosr,residentes.tipodocumento,
residentes.documentor,terapiap.fecha,terapiap.hora,terapiap.evaluacion,terapiap.trabajo,
terapiap.tarea from terapiap join residentes on terapiap.idresidentes=residentes.idresidentes where terapiap.idterapiap='$idterapiap'");

while ($resultx = mysqli_fetch_array($result1)) {
$nombresr=$resultx['nombresr'];
$apellidosr=$resultx['apellidosr'];
$tipodocumento=$resultx['tipodocumento'];
$documentor=$resultx['documentor'];
$fecha=$resultx['fecha'];
$hora=$resultx['hora'];
$evaluacion=$resultx['evaluacion'];
$trabajo=$resultx['trabajo'];
$tarea=$resultx['tarea'];
}

require('tfpdf.php');
class PDF extends tFPDF
{
// Cabecera de página
function Header()
{
    // Logo
	$this->Image('images/jorech.png',0,1,216);
}

// Pie de página
function Footer()
{
$this->Image('images/jorech.jpg',0,265,216);	  	
}
}

$pdf = new PDF();

$pdf->AddPage('P','Letter');
// Arial bold 15
$pdf->SetFont('Arial','B',16);
// Movernos a la derecha
$pdf->Cell(55);
// Título
$pdf->Cell(0,15,'REGISTRO DE TERAPIA');
// Salto de línea
$pdf->Ln(20);
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,utf8_decode('Información personal'));
$pdf->Ln(15);
$pdf->SetFont('Arial','',11);
$pdf->Cell(110,10,utf8_decode('Fecha de terapia: '.$fecha));
$pdf->Cell(40,10,utf8_decode('Hora: '.$hora));
$pdf->Ln(10);
$pdf->Cell(110,10,utf8_decode('Nombre: '.$nombresr.' '.$apellidosr));
$pdf->Cell(40,10,utf8_decode('Documento: '.$tipodocumento.' '.$documentor));
$pdf->Ln(10);
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,15,utf8_decode('Evaluación'));
$pdf->Ln(15);
$pdf->SetFont('Arial','',11);
$html1="$evaluacion";
$pdf->Write(5,utf8_decode($html1),'');
$pdf->Ln(10);
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,15,utf8_decode('Trabajo'));
$pdf->Ln(15);
$pdf->SetFont('Arial','',11);
$html2="$trabajo";
$pdf->Write(5,utf8_decode($html2),'');
$pdf->Ln(10);
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,15,utf8_decode('Tarea'));
$pdf->Ln(15);
$pdf->SetFont('Arial','',11);
$html3="$tarea";
$pdf->Write(5,utf8_decode($html3),'');
$pdf->Ln(40);

$pdf->Output();
?>