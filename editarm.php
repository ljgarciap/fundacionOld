<!DOCTYPE html>
<html lang="es" class="no-js">

<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["sadmin"]==true){

$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
	
include("menusadmin.html");
include_once('bas/conn.php');

$idh=$_REQUEST['idh'];
$idr=$_REQUEST['idr'];
$nomfund=$_REQUEST['nomfund'];
$motivo=$_REQUEST['motivo'];

mysqli_set_charset($con,"utf8");
$result=mysqli_query($con,"UPDATE historiali SET motivo='$motivo' where idhistoriali='$idh'");
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
<p><center><h2><u>Registro del retiro actualizado</u></h2></center></p><br>
<center><p>Para ver detalle del registro de retiros; por favor clickea sobre el botón generar vista.</p></center>
<center>
<?php
if($nomfund==="FUNDACIÓN JESÚS ES MI ROCA"){
?>
<form id="detalle" action = "detalleretf.php" method = "post" target="_blank">
<?php	
}
else if($nomfund==="CENTRO JOREC"){
?>
<form id="detalle" action = "detalleretj.php" method = "post" target="_blank">
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