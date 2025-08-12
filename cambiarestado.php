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
$nomfund=$_REQUEST['nomfund'];
$flag=$_REQUEST['flag'];

mysqli_set_charset($con,"utf8");

if($estado=="A" or $estado=="E"){
$estadoa="I";	

$result1=mysqli_query($con,"UPDATE historiali SET fecharetiro='20$hoy',motivo='$motivo' where idresidentes='$idr' and fecharetiro='0000-00-00'");

$result2=mysqli_query($con,"UPDATE residentes SET estado='$estadoa' where idresidentes='$idr'");
}
else if($estado=="I" and $flag=="A"){
$estadoa="A";
$result4=mysqli_query($con,"UPDATE historial SET fechaingreso='20$hoy' where idresidentes='$idr'");
$result1=mysqli_query($con,"INSERT INTO historiali(fechaingreso,motivo,idresidentes) 
VALUES ('20$hoy','$motivo','$idr')");
$result2=mysqli_query($con,"UPDATE residentes SET estado='$estadoa' where idresidentes='$idr'");
}
else if($estado=="I" and $flag=="E"){
$estadoa="E";
$result4=mysqli_query($con,"UPDATE historial SET fechaingreso='20$hoy' where idresidentes='$idr'");
$result1=mysqli_query($con,"INSERT INTO historiali(fechaingreso,motivo,idresidentes) 
VALUES ('20$hoy','$motivo','$idr')");
$result2=mysqli_query($con,"UPDATE residentes SET estado='$estadoa' where idresidentes='$idr'");
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
<p><center><h2><u>Estado del residente actualizado</u></h2></center></p><br>
<center><p>Para ver detalle del registro y/o imprimirlo; por favor clickea sobre el botón generar vista de documentación.</p></center>
<center>
<?php
if($nomfund==="FUNDACIÓN JESÚS ES MI ROCA"){
?>
<form id="detalle" action = "detallef.php" method = "post" target="_blank">
<?php	
}
else if($nomfund==="CENTRO JOREC"){
?>
<form id="detalle" action = "detallej.php" method = "post" target="_blank">
<?php	
}
?>
<input type="hidden" id="idresidente" name="idresidente" value="<?php echo $idr;?>"></input><!--oculto idresidente-->

<div class="wrapper">
<button type="submit" class="btn btn-default">Generar vista de documentación.</button>          
</div>
</center>
</form>
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