<!DOCTYPE html>
<html lang="es" class="no-js">

<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["sadmin"]==true){
	
$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];

include("menusadmin.html");
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
<p><center><h2><u>Formulario de Creación de nuevo usuario</u></h2></center></p><br>
<form id="residente" action = "cusuario.php" method = "post">
<br>
<br>

<div class="row">
<div class="col-md-6">
<label>Nombres:</label>
<input type="text" id="nombresr" name="nombresr" class="form-control input-sm chat-input" placeholder="Ingrese los nombres del nuevo practicante" style="text-transform: uppercase;"></input></div>
<div class="col-md-6">
<label>Apellidos:</label>
<input type="text" id="apellidosr" name="apellidosr" class="form-control input-sm chat-input" placeholder="Ingrese los apellidos del nuevo practicante" style="text-transform: uppercase;"></input>
</div>
</div>
<br>

<div class="row">
<div class="col-md-2">
<label>Fecha de nacimiento:</label>
<input type="date" id="fechan" name="fechan" class="form-control input-sm chat-input" required/>
</div>

<div class="col-md-2">
<label>Número documento:</label>
<input type="number" id="documentor" name="documentor" class="form-control input-sm chat-input" placeholder="Ingrese el documento"></input>
</div>

<div class="col-md-1">
<label>Tipo:</label>
<select id="tipodocr" name="tipodocr" class="form-control input-sm chat-input">
<option value="C.C">C.C</option>
<option value="T.I">T.I</option>
</select></div>

<div class="col-md-4">
<label>Expedido en:</label>
<select id="expedicion" name="expedicion" class="form-control input-sm chat-input">
  <option value="PIEDECUESTA" selected>PIEDECUESTA</option>
<?php
$selectciudad=mysqli_query($con,"select DETALLE_CIUDADES as ciudad FROM ciudades order by DETALLE_CIUDADES asc");
		while ($resultc = mysqli_fetch_array($selectciudad)) {
		$sciudad=$resultc['ciudad'];
		echo "<option value='$sciudad'>$sciudad</option>";
		}
?>
</select>
</div>

<div class="col-md-3">
<label>Seguro social:</label>
<input type="text" id="seguro" name="seguro" class="form-control input-sm chat-input" placeholder="Ingrese su eps" style="text-transform: uppercase;"></input>
</div>

</div>
<br>

<div class="row">

<div class="col-md-5">
<label>Teléfono:</label>
<input type="text" id="telefonor" name="telefonor" class="form-control input-sm chat-input" placeholder="Ingrese teléfono fijo"></input>
</div>

<div class="col-md-7">
<label>Correo electrónico:</label>
<input type="e-mail" id="emailr" name="emailr" class="form-control input-sm chat-input" placeholder="Ingrese el correo electrónico"></input>
</div>

</div>
<br>

<div class="row">
<div class="col-md-7">
<label>Dirección:</label>
<input type="text" id="direccion" name="direccion" class="form-control input-sm chat-input" placeholder="Ingrese la dirección" style="text-transform: uppercase;"></input></div>
<div class="col-md-5">
<label>Ciudad:</label>
<select id="ciudad" name="ciudad" class="form-control input-sm chat-input">
  <option value="PIEDECUESTA" selected>PIEDECUESTA</option>
<?php
$selectciudad2=mysqli_query($con,"select DETALLE_CIUDADES as ciudad FROM ciudades order by DETALLE_CIUDADES asc");
		while ($resultc2 = mysqli_fetch_array($selectciudad2)) {
		$sciudad2=$resultc2['ciudad'];
		echo "<option value='$sciudad2'>$sciudad2</option>";
		}
?>
</select>
</div>

</div>
<br>

<div class="row">

<div class="col-md-5">
<label>Universidad:</label>
<input type="text" id="universidad" name="universidad" class="form-control input-sm chat-input" placeholder="Ingrese universidad"></input>
</div>
<div class="col-md-5">
<label>Carrera:</label>
<input type="text" id="carrera" name="carrera" class="form-control input-sm chat-input" placeholder="Ingrese la carrera" value="Psicología"></input>
</div>

<div class="col-md-2">
<label>Semestre:</label>
<input type="text" id="semestre" name="semestre" class="form-control input-sm chat-input" placeholder="Ingrese el semestre"></input>
</div>

</div>
<br>

</p>

<center>
<div class="wrapper">
<button type="submit" class="btn btn-default">Guardar y continuar</button>          
</div>
</center>

</form>
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