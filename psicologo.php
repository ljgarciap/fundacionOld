<!DOCTYPE html>
<html lang="es" class="no-js">

<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["psico"]==true){
	
$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];

include("menupsico.html");
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
  <script type="text/javascript">
$(function() {
            $("#nombrer").autocomplete({
			maxShowItems: 3,
                source: "residentesb.php",
                minLength: 1,
                select: function(event, ui) {
					event.preventDefault();
                    $('#idresidentes').val(ui.item.idresidentes);
					$('#nombrer').val(ui.item.nombrer);
			     }
            });
		});
</script>
<body>

<div class="container">
<div class="jumbotron">
<p><center><h2><u>Ficha de seguimiento Residente</u></h2></center></p><br>
<form id="residente" action = "seguimiento.php" method = "post">
<p>
<div class="row">
<div class="col-md-2">
<label>Fecha:</label>
<input type="date" id="fechar" name="fechar" class="form-control input-sm chat-input" value='<?php echo "20$hoy";?>' required/>
</div>
<div class="col-md-2">
<label>Hora:</label>
<input type="time" id="horar" name="horar" class="form-control input-sm chat-input" placeholder="Ingrese la hora"></input>
</div>
<div class="col-md-4">
<label>Residente:</label>
<input type="text" id="nombrer" name="nombrer" class="form-control input-sm chat-input" placeholder="Ingrese los nombres del residente" style="text-transform: uppercase;"></input></div>
<div class="col-md-4">
<label>Fundación:</label>
<select id="nomfund" name="nomfund" class="form-control input-sm chat-input">
<option value="FUNDACIÓN JESÚS ES MI ROCA">FUNDACIÓN JESÚS ES MI ROCA</option>
<option value="CENTRO JOREC">CENTRO JOREC</option>
</select>
</div>
</div>
<br>

<div class="row">
<div class="col-md-4">
<label>Evaluación de compromiso:</label>
<textarea id="compromiso" name="compromiso" rows="6" class="form-control input-sm chat-input" placeholder="Evaluación anterior"></textarea></div>
<div class="col-md-4">
<label>Trabajo de la sesión:</label>
<textarea id="sesion" name="sesion" rows="6" class="form-control input-sm chat-input" placeholder="Trabajo de la sesión"></textarea></div>
<div class="col-md-4">
<label>Tarea asignada:</label>
<textarea id="tarea" name="tarea" rows="6" class="form-control input-sm chat-input" placeholder="Tarea asignada"></textarea></div>
</div>
<br>
</p>
<input type="hidden" id="idresidentes" name="idresidentes"></input>
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