<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["sadmin"]==true){
	
$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
$apellidosess=$_SESSION["apellido"];

$orientador="$nombresess"." "."$apellidosess";

include_once('bas/conn.php');
$hoy = date("y-m-d"); 
$fecha="20$hoy";
$idcobro=$_REQUEST['idcobro'];
$antiguo=$_REQUEST['antiguo'];
$nuevo=$_REQUEST['nuevo'];
$visita=$_REQUEST['visita'];
$buzo=$_REQUEST['buzo'];
$observaciones=$_REQUEST['observaciones'];

//se crea el residente con los datos y luego se crea el historial en este mismo archivo
mysqli_set_charset($con,"utf8");
$query="update uniformes set nuevo='$nuevo',antiguo='$antiguo',visita='$visita',buzo='$buzo',valorinicial='$saldo',fechaabono='$fecha',abono='$abono',saldo='$saldo',comentario='$observaciones' where iduniformes='$idcobro'";
$result=mysqli_query($con,"$query");
	
header("Location:uniformes.php");
include("footersadmin.html");
}
else {
header("Location:index.php");
}
?>