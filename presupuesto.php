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
<p><center><h2><u>Presupuesto entre fechas por fundación</u></h2></center></p><br>
<form id="residente" action = "calcpresupuesto.php" method = "post">
<br>
<div class="row">
<div class="col-md-3">
<label>Fecha inicial:</label>
<input type="date" id="fechai" name="fechai" class="form-control input-sm chat-input" value='20<?php echo $hoy; ?>' required/>
</div>

<div class="col-md-3">
<label>Fecha final:</label>
<input type="date" id="fechaf" name="fechaf" class="form-control input-sm chat-input" value='20<?php echo $hoy; ?>' required/>
</div>

<div class="col-md-6">
<label>Centro:</label>
<select id="centro" name="centro" class="form-control input-sm chat-input">
  <option value="J" selected>Jorec</option>
  <option value="R" selected>Jesús es mi roca</option>
</select>
</div>

</div>
<br>

</p>

<center>
<div class="wrapper">
<button type="submit" class="btn btn-default">Consultar</button>          
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