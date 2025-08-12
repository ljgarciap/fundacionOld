
<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["bda"]==true){

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
$pdf->Cell(3,8,utf8_decode('#'));
$pdf->Cell(3);
$pdf->Cell(70,8,utf8_decode('Nombre residente'));
$pdf->Cell(3);
$pdf->Cell(20,8,utf8_decode('Ingreso'));
$pdf->Cell(3);
$pdf->Cell(30,8,utf8_decode('Residente'));
$pdf->Cell(5);
$pdf->Cell(30,8,utf8_decode('Acudiente'));
$pdf->Cell(3);
$pdf->Cell(30,8,utf8_decode('Codigo'));

$pdf->Ln(10);

//$pdf = new PDF('P','mm',array(139,216));
//$pdf->AddPage();
mysqli_set_charset($con,"utf8");
	
$result=mysqli_query($con,"SELECT concat(resi.nombresr,' ',resi.apellidosr) AS nombrer, 
	histo.fechaingreso as fechaingreso, resi.celular as tres,usua.telefono as tacu, 
	resi.codigo as codigo,resi.fechacodigo as fechacodigo from residentes resi 
	JOIN asociacion asoc ON asoc.idresidentes = resi.idresidentes 
	JOIN usuarios usua ON usua.idusuarios = asoc.idusuarios JOIN historial histo ON 
	histo.idresidentes = resi.idresidentes where 1=1 AND resi.estado IN('A','E') 
	ORDER BY nombrer asc");

$ordinal=0;

	while ($resultc = mysqli_fetch_array($result)) {
		$nombres=$resultc['nombrer'];
		$fechai=$resultc['fechaingreso'];
		$codigo=$resultc['codigo'];
		$fechacod=$resultc['fechacodigo'];
		$telres=$resultc['tres'];
		$telusu=$resultc['tacu'];
	    $ordinal=($ordinal+1);
	
$pdf->SetFont('Arial','',8);
$pdf->Cell(3,8,utf8_decode($ordinal));
$pdf->Cell(3);
$pdf->Cell(70,8,utf8_decode($nombres));
$pdf->Cell(3);
$pdf->Cell(20,8,utf8_decode($fechai));
$pdf->Cell(3);
$pdf->Cell(30,8,utf8_decode($telres));
$pdf->Cell(5);
$pdf->Cell(30,8,utf8_decode($telusu));
$pdf->Cell(3);
$pdf->Cell(30,8,utf8_decode($codigo));
if($ordinal==43){
$pdf->AddPage('P','Letter');
$pdf->SetFont('Arial','B',10);
$pdf->Ln(20);
$pdf->Cell(3,8,utf8_decode('#'));
$pdf->Cell(3);
$pdf->Cell(70,8,utf8_decode('Nombre residente'));
$pdf->Cell(3);
$pdf->Cell(20,8,utf8_decode('Ingreso'));
$pdf->Cell(3);
$pdf->Cell(30,8,utf8_decode('Residente'));
$pdf->Cell(5);
$pdf->Cell(30,8,utf8_decode('Acudiente'));
$pdf->Cell(3);
$pdf->Cell(30,8,utf8_decode('Codigo'));
$pdf->Ln(10);
}
else{
$pdf->Ln(5);	
}
	}	
$pdf->Ln(10);
$pdf->Cell(50,8,utf8_decode('Códigos generados el dia: '));
$pdf->Cell(30,8,utf8_decode($fechacod));
$pdf->Output();
}
else {
header("Location:index.php");
}
?>