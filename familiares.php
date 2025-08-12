<!DOCTYPE html>
<html lang="es" class="no-js">

<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["planta"]==true){
	
$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];

include("menuplanta.html");
include_once('bas/conn.php');
mysqli_set_charset($con,"utf8");
$hoy = date("y-m-d"); 
?>

<HEAD>
  <script type="text/javascript">
$(function() {
            $("#nombre").autocomplete({
			maxShowItems: 5,
                source: "residentesplanta.php",
                minLength: 1,
                select: function(event, ui) {
					event.preventDefault();
					$('#nombre').val(ui.item.nombrer);
					$('#idresidentes').val(ui.item.idresidentes);
			     }
            });
		});
</script>
</HEAD>

<body>

<div class="container">
<div class="jumbotron">
<p><center><h2><u>RESUMEN SEMANAL</u></h2></center></p><br>
<form id="residente" action = "familias.php" method = "post">
<p>
<div class="row">
<div class="col-md-6">
<label>Fecha:</label>
<input type="date" id="fecha" name="fecha" class="form-control input-sm chat-input" value='<?php echo "20$hoy";?>' required/>
<br>
<label for="nombre">Residente:</label>
<input type="text" id="nombre" name="nombre" class="form-control input-sm chat-input" placeholder="Ingrese los nombres del residente" required/>
</div>

<div class="col-md-6">
<label>Resumen de la semana:</label>
<textarea id="resumen" name="resumen" onkeyup="countChars(this);" rows="5" class="form-control input-sm chat-input" placeholder="Resumen público que no exceda 700 caracteres"></textarea></div>
</div>
<br>
</p>
<input type="hidden" id="idresidentes" name="idresidentes"></input>
<center>
<div class="wrapper">
<p id="charNum" style="font-size:1.25rem"></p>
<button type="submit" class="btn btn-info">Guardar y continuar</button>          
</div>
</center>
<script>
function countChars(obj){
    var maxLength = 700;
    var strLength = obj.value.length;
    var charRemain = (maxLength - strLength);
    
    if(charRemain < 0){
        document.getElementById("charNum").innerHTML = '<span style="color: red;">Excediste el límite de '+maxLength+' caracteres</span>';
    }else{
        document.getElementById("charNum").innerHTML = charRemain+' caracteres disponibles';
    }
}
</script>
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