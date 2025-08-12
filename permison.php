<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["sadmin"]==true){

$fechas=$_REQUEST['fechas'];	
$mot=$_REQUEST['mot'];	
$fechai=$_REQUEST['fechai'];	
$obs=$_REQUEST['obs'];	
$idr=$_REQUEST['idresidentes'];	

include_once('bas/conn.php');
mysqli_set_charset($con,"utf8");

$queryu="INSERT INTO permisos(motivo,fechasalida,fechaingreso,observaciones,idresidentes) VALUES ('$mot','$fechas','$fechai','$obs','$idr');
";	

//echo "$queryu";

$result1=mysqli_query($con,$queryu);

$url="historialp.php?idr=$idr";
header("Location:$url");
}
else {
header("Location:index.php");
}
?>
