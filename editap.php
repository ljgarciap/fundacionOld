<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["sadmin"]==true){

$fechas=$_REQUEST['fechas'];	
$mot=$_REQUEST['mot'];	
$fechai=$_REQUEST['fechai'];	
$obs=$_REQUEST['obs'];	
$idr=$_REQUEST['idresidentes'];
$idp=$_REQUEST['idpermisos'];	

include_once('bas/conn.php');
mysqli_set_charset($con,"utf8");

$queryu="update permisos set motivo='$mot',fechasalida='$fechas',fechaingreso='$fechai',observaciones='$obs' where idpermisos=$idp";

//echo "$queryu";

$result1=mysqli_query($con,$queryu);

$url="historialp.php?idr=$idr";
header("Location:$url");
}
else {
header("Location:index.php");
}
?>
