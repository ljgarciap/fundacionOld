<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["sadmin"]==true){

$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
$apellidosess=$_SESSION["apellido"];
	
include_once('bas/conn.php');

require('tfpdf.php');
class PDF extends tFPDF{
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
$pdf->SetFont('Arial','B',10);
$pdf->Ln(20);
$pdf->Cell(10,8,utf8_decode('#'));
$pdf->Cell(10);
$pdf->Cell(100,8,utf8_decode('Nombre residente'));
$pdf->Cell(10);
$pdf->Cell(40,8,utf8_decode('Fecha ingreso'));
$pdf->Cell(10);
$pdf->Cell(30,8,utf8_decode('Llamada'));
$pdf->Ln(10);

//$pdf = new PDF('P','mm',array(139,216));
//$pdf->AddPage();
mysqli_set_charset($con,"utf8");
	
$result=mysqli_query($con,"select residentes.idresidentes,residentes.nombresr,residentes.apellidosr,residentes.eps,
residentes.nomfund,historial.fechaingreso from residentes join historial on residentes.idresidentes=historial.idresidentes 
where estado='A' order by nombresr;");

$ordinal=0;
$hoy = date("y-m-d");
$fecha="20$hoy";

	while ($resultc = mysqli_fetch_array($result)) {
		$idr=$resultc['idresidentes'];
		$nombres=$resultc['nombresr'];
		$apellidos=$resultc['apellidosr'];
		$fechai=$resultc['fechaingreso'];
	    $ordinal=($ordinal+1);
		$d=mt_rand(1000,9999);

$resultcod=mysqli_query($con,"UPDATE residentes SET codigo='$d',fechacodigo='20$hoy' where idresidentes='$idr'");
		
$pdf->SetFont('Arial','',8);
$pdf->Cell(10,8,utf8_decode($ordinal));
$pdf->Cell(10);
$pdf->Cell(100,8,utf8_decode($nombres.' '.$apellidos));
$pdf->Cell(10);
$pdf->Cell(40,8,utf8_decode($fechai));
$pdf->Cell(10);
$pdf->Cell(30,8,utf8_decode($d));
if($ordinal==43){
$pdf->AddPage('P','Letter');
$pdf->SetFont('Arial','B',10);
$pdf->Ln(20);
$pdf->Cell(10,8,utf8_decode('#'));
$pdf->Cell(10);
$pdf->Cell(100,8,utf8_decode('Nombre residente'));
$pdf->Cell(10);
$pdf->Cell(40,8,utf8_decode('Fecha ingreso'));
$pdf->Cell(10);
$pdf->Cell(30,8,utf8_decode('Llamada'));
$pdf->Ln(10);
}
else{
$pdf->Ln(5);	
}
	}	
$pdf->Ln(10);
$pdf->Cell(50,8,utf8_decode('Códigos generados el dia: '));
$pdf->Cell(30,8,utf8_decode($fecha));
$pdf->Output();
}
else {
header("Location:index.php");
}
?>	