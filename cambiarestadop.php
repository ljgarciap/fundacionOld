<!DOCTYPE html>
<html lang="es" class="no-js">

<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["sadmin"]==true){

$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
	
include("menusadmin.html");
include_once('bas/conn.php');

$hoy=date("y-m-d"); 

$idr=$_REQUEST['idresidente'];
$estado=$_REQUEST['estado'];
$motivo=$_REQUEST['motivo'];
mysqli_set_charset($con,"utf8");

if($estado=="A"){
$estadoa="I";	

$result1=mysqli_query($con,"UPDATE historialp SET fecharetiro='20$hoy',observaciones='$motivo' where idpracticantes='$idr'");

$result2=mysqli_query($con,"UPDATE practicantes SET estado='$estadoa' where idpracticantes='$idr'");
}
else if($estado=="I"){
$estadoa="A";
$result4=mysqli_query($con,"UPDATE historialp SET fechaingreso='20$hoy',observaciones='$motivo' where idpracticantes='$idr'");
$result2=mysqli_query($con,"UPDATE practicantes SET estado='$estadoa' where idpracticantes='$idr'");
}
?>

<style>
.wrapper {
    text-align: center;
}
.btn{
	background-color:#941524;
	border-color:transparent;
	color:white;
	font-size:1.5em;
}
.btn:hover{
	background-color:#523a18;
	border-color:transparent;
	color:white;
}
</style>

<body>

<div class="container">
<div class="jumbotron">
<p>
<p><center><h2><u>Estado del practicante actualizado</u></h2></center></p><br>
</p>
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