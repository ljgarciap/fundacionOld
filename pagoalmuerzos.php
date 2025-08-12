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
$valorinicial=$_REQUEST['valorinicial'];
$observaciones=$_REQUEST['observaciones'];
$abono=$_REQUEST['abono'];
$saldo=($valorinicial-$abono);

//se crea el residente con los datos y luego se crea el historial en este mismo archivo
mysqli_set_charset($con,"utf8");
$query="update cobroalmuerzos set valorinicial='$saldo',fechaabono='$fecha',abono='$abono',
saldo='$saldo',observaciones='$observaciones' where idcobroalmuerzos='$idcobro'";

$result=mysqli_query($con,"$query");
//echo $query;	
header("Location:almuerzos.php");
include("footersadmin.html");
}
else {
header("Location:index.php");
}
?>