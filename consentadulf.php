<?php
include_once('bas/conn.php');

$idresidentes=$_REQUEST['idt'];

mysqli_set_charset($con,"utf8");

session_start();
if($_SESSION["ok"]==true && $_SESSION["planta"]==true){
$iduser=$_SESSION["cons"];
}

include_once('bas/conn.php');
mysqli_set_charset($con,"utf8");
$resultp=mysqli_query($con,"select usuarios.nombres as nombre,usuarios.apellidos as apellido,usuarios.documento as doc,usuarios.expedicion as exp from usuarios where usuarios.idusuarios='$iduser'");

while ($resultxp = mysqli_fetch_array($resultp)) {
$nombres=$resultxp['nombre'];
$apellidos=$resultxp['apellido'];
$psico=$nombres." ".$apellidos;
}

	
$result1=mysqli_query($con,"select residentes.documentor as documentor,residentes.expedicionr as expedidor,residentes.nombresr as nombrer,residentes.apellidosr as apellidosr,residentes.tipodocumento as tipodocumentor,asociacion.parentesco as parentescou,usuarios.nombres as nombreu,usuarios.apellidos as apellidou,usuarios.documento 
as docu,usuarios.expedicion as expedidou,historial.fechaingreso as fechaih,historial.orientador as orientador,historial.cedorientador as cedorientador from residentes join asociacion on asociacion.idresidentes=residentes.idresidentes join usuarios on asociacion.idusuarios=usuarios.idusuarios join historial on historial.idresidentes=residentes.idresidentes where residentes.idresidentes='$idresidentes'");

while ($resultx = mysqli_fetch_array($result1)) {
$nombresr=$resultx['nombrer'];
$apellidosr=$resultx['apellidosr'];
$tipodocumentor=$resultx['tipodocumentor'];
$documentor=$resultx['documentor'];
$expedidor=$resultx['expedidor'];
$parentescou=$resultx['parentescou'];
$nombreu=$resultx['nombreu'];
$apellidou=$resultx['apellidou'];
$docu=$resultx['docu'];
$expedidou=$resultx['expedidou'];
$fechaingreso=$resultx['fechaih'];

$resumen="Yo, $nombresr $apellidosr, identificado con cédula de ciudadanía número $documentor de $expedidor, actuando en calidad de paciente y en total uso de mis facultades mentales, manifiesto mi aceptación voluntaria del acompañamiento psicosocial ofrecido por el Psicólogo $psico de la Fundación Jesús es mi Roca, el cual me ha sido claramente explicado.

Entiendo que toda la información concerniente al acompañamiento psicosocial es confidencial, se mantendrá custodiada en los reportes de acompañamiento psicosocial y no será divulgada ni entregada a ninguna institución externa o individuo sin mi consentimiento expreso, excepto cuando la orden de entrega provenga de una autoridad judicial competente.

También entiendo, y por lo tanto estoy de acuerdo con la necesidad de quebrantar este principio de confidencialidad en caso de presentarse situaciones que pongan en grave peligro la integridad física o mental del menor o de algún miembro de la comunidad. 

Autorizo al Psicólogo, para que consulte este caso con otros profesionales, si en algún momento se requerirse, con el fin de brindar el mejor acompañamiento psicosocial posible. Igualmente, el resultado de dicha consulta me será comunicado en forma verbal o escrita.

En forma expresa manifiesto a usted que he leído y comprendido íntegramente este documento, por lo cual acepto su contenido y las consecuencias que de él se deriven.";
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
$pdf->Cell(32);
// Título
$pdf->Cell(0,15,utf8_decode('CONSENTIMIENTO INFORMADO ADULTO'));
// Salto de línea
$pdf->Ln(25);
$pdf->SetFont('Arial','',10);
$html0="$resumen";
$pdf->Write(5,utf8_decode($html0),'');
$pdf->Ln(10);
$pdf->Ln(30);
//firmas
$pdf->Cell(10,10);	
$pdf->Cell(10,10);	
//firmas
$pdf->Ln(10);
$pdf->SetFont('Arial','',10);
$pdf->Cell(95,10,utf8_decode('____________________________'));
$pdf->Cell(10,10);	
$pdf->Cell(1,10);
$pdf->Cell(95,10,utf8_decode('____________________________'));
$pdf->Cell(10,10);	
$pdf->Ln(5);
$pdf->Cell(95,10,utf8_decode('FIRMA DEL ACUDIENTE'));
$pdf->Cell(10,10);
$pdf->Cell(95,10,utf8_decode('FIRMA DEL RESIDENTE'));
$pdf->Ln(5);
$pdf->Cell(95,10,utf8_decode('C.C'.' '.$docu.' de '.$expedidou));
$pdf->Cell(10,10);
$pdf->Cell(95,10,utf8_decode($tipodocumentor.' '.$documentor.' de '.$expedidor));
$pdf->Ln(10);

$pdf->Ln(40);

$pdf->Output();
?>