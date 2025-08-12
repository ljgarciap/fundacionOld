<!DOCTYPE html>
<html lang="es" class="no-js">

<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["planta"]==true){
	
$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
$idusuario=$_SESSION["cons"];

include("menuplanta.html");
include_once('bas/conn.php');
mysqli_set_charset($con,"utf8");

$hoy = date("y-m-d"); 

$fecha=$_REQUEST['fecha'];
$hora=$_REQUEST['hora'];
$resumen=$_REQUEST['resumen'];
$evaluacion=$_REQUEST['evaluacion'];
$tecnicas=$_REQUEST['tecnicas'];
$tarea=$_REQUEST['tarea'];
$idresidentes=$_REQUEST['idresidentes'];
$fundacion=$_REQUEST['fundacion'];

mysqli_set_charset($con,"utf8");

if($fundacion=="FUNDACIÓN JESÚS ES MI ROCA"){$nf="F";}
else if($fundacion=="CENTRO JOREC"){$nf="J";}

$query="INSERT INTO seguimientos(fecha,hora,resumen,evaluacion,tecnicas,tarea,idresidentes,idusuarios) 
VALUES ('$fecha','$hora','$resumen','$evaluacion','$tecnicas','$tarea','$idresidentes','$idusuario')";

$result=mysqli_query($con,"$query");
	
$query1="SELECT idseguimientos FROM seguimientos ORDER by idseguimientos desc LIMIT 1";
$result1=mysqli_query($con,"$query1");

while ($resultx = mysqli_fetch_array($result1)) {
$idseguimientos=$resultx['idseguimientos'];
}

if($nf=="F"){
	$url="impseguimientos.php?idt=$idseguimientos";
}
else if($nf=="J"){
	$url="impseguimientosj.php?idt=$idseguimientos";
}
?>

<body>

<div class="container">
<div class="jumbotron">

<br><br>
<center>
<h1><a href="<?php echo $url; ?>" target="blank">Imprimir seguimiento</a></h1>
<br>
<h1><a href="planta.php">Regresar a inicio</a></h1>
</center>

</div>
</div>

<?php	
include("footersadmin.html");
}
else {
header("Location:index.php");
}
?>
</body>
</html>