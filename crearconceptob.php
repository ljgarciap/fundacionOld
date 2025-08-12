<!DOCTYPE html>
<html lang="es" class="no-js">

<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["bda"]==true){
	
$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];

include("menubda.html");
include_once('bas/conn.php');
mysqli_set_charset($con,"utf8");

$hoy = date("y-m-d"); 
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
<p><center><h2><u>Formulario de Creación de nuevo concepto</u></h2></center></p><br>
<br>
<br>
<div class="row">
<div class="col-md-9">
<label>Nombres:</label>
<form id="residente" action = "creaconceptob.php" method = "post">
<input type="text" id="nombresr" name="nombresr" class="form-control input-sm chat-input" placeholder="Ingrese el nuevo concepto, recuerde que debe ser unico" style="text-transform: uppercase;"></input>
</div>
<div class="col-md-3 wrapper">
<button type="submit" class="btn btn-default">Guardar y continuar</button>          
</div>
</form>
</div>

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