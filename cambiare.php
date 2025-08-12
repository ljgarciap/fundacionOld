<!DOCTYPE html>
<html lang="es" class="no-js">

<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["sadmin"]==true){

$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
	
include("menusadmin.html");
include_once('bas/conn.php');

$idr=$_REQUEST['idr'];
$estado=$_REQUEST['estado'];

mysqli_set_charset($con,"utf8");
	
$result1=mysqli_query($con,"select nombresr,apellidosr,nomfund from residentes where idresidentes='$idr'");

while ($resultx = mysqli_fetch_array($result1)) {
$nombre=$resultx['nombresr'];
$apellido=$resultx['apellidosr'];
$nomfund=$resultx['nomfund'];
$esp=" ";
$residente="$nombre$esp$apellido";
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
<form id="cambiarestado" action = "cambiarestado.php" method = "get">
<p><center><h2>
<select id="flag" name="flag">
<option value="A">Cambio de estado del residente</option>
<option value="E">Cambio de estado del residente -*-</option>
</select>
</h2></center></p><br>

<?php
if($estado=="A"){
?>
<center>
<p>Estas a punto de cambiar el estado del residente <?php echo $residente; ?> de activo a INACTIVO</p></center>
<center><p>Introduce los motivos del retiro y clickea sobre el botón actualizar.</p></center>
<center><input type="text" id="motivo" name="motivo" class="form-control input-sm chat-input"></input></center><br>
<?php
}
else if($estado=="I"){
?>
<p>Estas a punto de cambiar el estado del residente <?php echo $residente; ?> de Inactivo a ACTIVO</p>
<center><p>Introduce los comentarios del reingreso y clickea sobre el botón actualizar.</p></center>
<center><input type="text" id="motivo" name="motivo" class="form-control input-sm chat-input"></input></center><br>
<?php	
}
else if($estado=="E"){
?>
<p>Estas a punto de cambiar el estado del residente <?php echo $residente; ?> de activo a INACTIVO</p>
<center><p>Introduce los comentarios del reingreso y clickea sobre el botón actualizar.</p></center>
<center><input type="text" id="motivo" name="motivo" class="form-control input-sm chat-input"></input></center><br>
<?php	
}
?>
<center>
<input type="hidden" id="idresidente" name="idresidente" value="<?php echo $idr;?>"></input>
<input type="hidden" id="estado" name="estado" value="<?php echo $estado;?>"></input>
<input type="hidden" id="nomfund" name="nomfund" value="<?php echo $nomfund;?>"></input>
<!--oculto idresidente-->
<div class="wrapper">
<button type="submit" class="btn btn-default">Actualizar estado.</button>          
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