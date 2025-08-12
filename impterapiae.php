<?php
include_once('bas/conn.php');

$idterapiap=$_REQUEST['idt'];

mysqli_set_charset($con,"utf8");
	
$result1=mysqli_query($con,"select residentes.nombresr,residentes.apellidosr,residentes.tipodocumento,
residentes.documentor,terapiae.fecha,terapiae.hora,terapiae.resumen,terapiae.evaluacion,terapiae.tecnicas,
terapiae.tarea,terapiae.idusuarios from terapiae join residentes on terapiae.idresidentes=residentes.idresidentes where terapiae.idterapiae='$idterapiap'");

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
$idusuarios=$resultx['idusuarios'];

$queryp2="select nombres,apellidos from usuarios where idusuarios='$idusuarios'";
$resultp2=mysqli_query($con,"$queryp2");
while ($resultxp2 = mysqli_fetch_array($resultp2)) {
$nombres2=$resultxp2['nombres'];
$apellidos2=$resultxp2['apellidos'];
$psicologo=$nombres2." ".$apellidos2;
}

}

require('tfpdf.php');
class PDF extends tFPDF
{
// Cabecera de página
function Header()
{
    // Logo
	$this->Image('images/jemr.png',0,1,216);
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
$pdf->SetFont('Arial','B',15);
// Movernos a la derecha
$pdf->Cell(30);
// Título
$pdf->Cell(0,15,utf8_decode('REGISTRO DE ACOMPAÑAMIENTO POR PRACTICANTE'));
// Salto de línea
$pdf->Ln(5);

$pdf->SetFont('Arial','I',7);
// Movernos a la derecha
$pdf->Cell(60);
// Título
$pdf->Cell(0,15,utf8_decode('Acompañamiento realizado por : '.$psicologo));
// Salto de línea
$pdf->Ln(20);

$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,10,utf8_decode('Información personal'));
$pdf->Ln(10);
$pdf->SetFont('Arial','',11);
$pdf->Cell(110,10,utf8_decode('Fecha de terapia: '.$fecha));
$pdf->Cell(40,10,utf8_decode('Hora: '.$hora));
$pdf->Ln(10);
$pdf->Cell(110,10,utf8_decode('Nombre: '.$nombresr.' '.$apellidosr));
$pdf->Cell(40,10,utf8_decode('Documento: '.$tipodocumento.' '.$documentor));
$pdf->Ln(10);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,15,utf8_decode('Resumen'));
$pdf->Ln(15);
$pdf->SetFont('Arial','',11);
$html1="$resumen";
$pdf->Write(5,utf8_decode($html1),'');
$pdf->Ln(10);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,15,utf8_decode('Evaluación'));
$pdf->Ln(15);
$pdf->SetFont('Arial','',11);
$html1="$evaluacion";
$pdf->Write(5,utf8_decode($html1),'');
$pdf->Ln(10);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,15,utf8_decode('Técnicas'));
$pdf->Ln(15);
$pdf->SetFont('Arial','',11);
$html2="$tecnicas";
$pdf->Write(5,utf8_decode($html2),'');
$pdf->Ln(10);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,15,utf8_decode('Tarea'));
$pdf->Ln(15);
$pdf->SetFont('Arial','',11);
$html3="$tarea";
$pdf->Write(5,utf8_decode($html3),'');
$pdf->Ln(40);

$pdf->Output();
?>