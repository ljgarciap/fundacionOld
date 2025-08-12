<?php
include_once('bas/conn.php');

//$idcertificacion=$_REQUEST['idresidente'];

mysqli_set_charset($con,"utf8");
/*	
$result1=mysqli_query($con,"select residentes.documentor as cedular,residentes.expedicionr as expedidor,residentes.fechanacimiento as fechanr,residentes.nombresr as nombrer,residentes.apellidosr as apellidosr, residentes.profesion as profesionr,residentes.email as emailr,historial.fechaingreso as fechaih,historial.motivoi as motivoi,historial.tiempoadiccion as tiempoah,historial.medidatiempo as 
canth,historialm.descripcion as descrhmh from residentes join asociacion on asociacion.idresidentes=residentes.idresidentes join usuarios where residentes.idresidentes='$idresidente'");

while ($resultx = mysqli_fetch_array($result1)) {
$cedular=$resultx['cedular'];
$expedidor=$resultx['expedidor'];
$fechanr=$resultx['fechanr'];
$nombrer=$resultx['nombrer'];
$apellidosr=$resultx['apellidosr'];
$telefonor=$resultx['telefonor'];
$celularr=$resultx['celularr'];
$profesionr=$resultx['profesionr'];
$emailr=$resultx['emailr'];
$descrhmh=$resultx['descrhmh'];
}
*/
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
$pdf->SetFont('Arial','',12);
// Movernos a la derecha
$pdf->Cell(60);
// Título
$pdf->Cell(0,15,'Piedecuesta, Noviembre 15 de 2019');
// Salto de línea
$pdf->Ln(20);
// Arial bold 15
$pdf->SetFont('Arial','B',16);
// Movernos a la derecha
$pdf->Cell(55);
// Título
$pdf->Cell(0,15,'A QUIEN PUEDA INTERESAR');
// Salto de línea
$pdf->Ln(25);
$pdf->Cell(30);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,10,utf8_decode('LA FUNDACIÓN JESÚS ES MI ROCA CERTIFICA QUE'));
$pdf->Ln(30);
$pdf->SetFont('Arial','',12);
$html = 'YONILBER RAMIREZ ARIAS, identificado con cédula de ciudadania N° 1050543142 de San Pablo Bolívar, se desempeño como Psicólogo, realizando un Apoyo Psicosocial a las siguientes poblaciones (niñez, adolescencia, adultos jóvenes, adultos mayores y familias); entre las actividades desarrolladas y ejecutadas están las siguientes:

-Encuentros Psicoeducativos
-Talleres Reflexivos
-Capacitaciones
-Atenciones Individuales
-Actividades Ludico - Recreativas
-Escuela De Padres
-Reportes

Dicho trabajo se realizo en el periodo comprendido entre el 16 de Julio al 16 de Octubre de 2019, con responsabilidad y compromiso.';
$pdf->Write(5,utf8_decode($html),'');
$pdf->Ln(10);
$pdf->SetFont('Arial','I',10);
//firmas
$pdf->Ln(40);
$pdf->Cell(70,10);
$firmaauto="Yuleidis Reyes";
$docu='37620619';
$parentescou='Director y Fundador';
$expedidou='Piedecuesta';
$picf = "firmas/$docu.png";
if(file_exists($picf)){
$pdf->Image($picf,5,180,70,'C');
}
else{
$pdf->Cell(10,10);	
}
$url="http://fundacionjesusesmiroca.org/certificaciones/69994537922034.php";
$pdf->Ln(10);
$pdf->Cell(50,10,utf8_decode($firmaauto));
$pdf->Ln(7);
$pdf->Cell(50,10,utf8_decode($parentescou));
$pdf->Ln(7);
$pdf->Cell(65,10,utf8_decode('No C.C'.' '.$docu.' de '.$expedidou));
$pdf->Ln(10);
$pdf->SetFont('Arial','',7);
$pdf->Cell(65,10,utf8_decode('Puede verificar la veracidad de este documento en: '.$url));
$pdf->Output();
?>