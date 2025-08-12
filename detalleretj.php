<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["sadmin"]==true){
	
$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
$apellidosess=$_SESSION["apellido"];
	
include_once('bas/conn.php');

$idresidente=$_REQUEST['idresidente'];

mysqli_set_charset($con,"utf8");
	
$result1=mysqli_query($con,"select residentes.tipodocumento as tipor, residentes.documentor as cedr, residentes.nombresr as nomr, residentes.apellidosr as apelr, residentes.nomfund as nomfund, historiali.fecharetiro as fecharetiro, historiali.motivo as motivor from residentes join historiali on historiali.idresidentes=residentes.idresidentes where residentes.idresidentes='$idresidente' order by fecharetiro asc;");

while ($resultx = mysqli_fetch_array($result1)) {
$tipor=$resultx['tipor'];
$cedr=$resultx['cedr'];
$nomr=$resultx['nomr'];
$apelr=$resultx['apelr'];
$nomfund=$resultx['nomfund'];
$fecharetiro=$resultx['fecharetiro'];
$motivor=$resultx['motivor'];
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
$pdf->Cell(35);
// Título
$pdf->Cell(0,15,'REGISTRO DE RETIROS DEL RESIDENTE');
// Salto de línea
$pdf->Ln(20);
$pdf->SetFont('Arial','',12);
$pdf->Ln(10);

mysqli_set_charset($con,"utf8");
$result1=mysqli_query($con,"select residentes.tipodocumento as tipor, residentes.documentor as cedr, residentes.nombresr as nomr, residentes.apellidosr as apelr, residentes.nomfund as nomfund, historiali.fecharetiro as fecharetiro, historiali.motivo as motivor from residentes join historiali on historiali.idresidentes=residentes.idresidentes where residentes.idresidentes='$idresidente' order by fecharetiro asc;");
while ($resultx = mysqli_fetch_array($result1)) {
$tipor=$resultx['tipor'];
$cedr=$resultx['cedr'];
$nomr=$resultx['nomr'];
$apelr=$resultx['apelr'];
$nomfund=$resultx['nomfund'];
$fecharetiro=$resultx['fecharetiro'];
$motivor=$resultx['motivor'];

$pdf->Cell(5,10,utf8_decode($nomr.' '.$apelr.'   '.' Fecha de retiro:  '.$fecharetiro));
$pdf->Ln(10);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(5,10,utf8_decode('Motivo del retiro: '));
$pdf->Ln(10);
$pdf->SetFont('Arial','',12);
$html = $motivor;
$pdf->Write(5,utf8_decode($html),'');
$pdf->Ln(20);
}
$pdf->Output();
}
else {
header("Location:index.php");
}
?>