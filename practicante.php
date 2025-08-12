<!DOCTYPE html>
<html lang="es" class="no-js">

<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["tere"]==true){
	
$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];

date_default_timezone_set("America/Bogota");

include("menutere.html");
include_once('bas/conn.php');
mysqli_set_charset($con,"utf8");
$hoy = date("y-m-d"); 
$hora = date("H:i")
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
					$('#cedula').val(ui.item.docr);
					$('#idresidentes').val(ui.item.idresidentes);
					$('#fundacion').val(ui.item.nomfund);
			     }
            });
		});
</script>
</HEAD>

<body>

<div class="container">
<div class="jumbotron">
<p><center><h2><u>REGISTRO DE ATENCIÓN INDIVIDUAL</u></h2></center></p><br>
<form id="residente" action = "seguimientos.php" method = "post">
<p>
<div class="row">
<div class="col-md-2">
<label>Fecha:</label>
<input type="date" id="fecha" name="fecha" class="form-control input-sm chat-input" value='<?php echo "20$hoy";?>' required/>
</div>
<div class="col-md-2">
<label>Hora:</label>
<input type="time" id="hora" name="hora" class="form-control input-sm chat-input" value='<?php echo "$hora";?>' required/>
</div>
<div class="col-md-4">
<label for="nombre">Residente:</label>
<input type="text" id="nombre" name="nombre" class="form-control input-sm chat-input" placeholder="Ingrese los nombres del residente" required/></div>
<div class="col-md-4">
<label>Documento:</label>
<input type="text" id="cedula" name="cedula" class="form-control input-sm chat-input"></input></div>
</div>
<br>

<div class="row">
<div class="col-md-3">
<label>Descripción de la Atención Individual:</label>
<textarea id="resumen" name="resumen" onkeyup="countChars(this);" rows="8" class="form-control input-sm chat-input" placeholder="Descripción breve de la Atención Individual Realizada"></textarea></div>
<div class="col-md-3">
<label>Descripción de la Actitud del paciente:</label>
<textarea id="evaluacion" name="evaluacion" onkeyup="countChars(this);" rows="8" class="form-control input-sm chat-input" placeholder="Descripción de la Actitud, Estado de Ánimo y Lenguaje del paciente en el transcurso de la Atención Individual"></textarea></div>
<div class="col-md-3">
<label>Técnicas o Estrategias Abordadas:</label>
<textarea id="tecnicas" name="tecnicas" onkeyup="countChars(this);" rows="8" class="form-control input-sm chat-input" placeholder="Técnicas Psicológicas o Estrategias Psicoeducativas Abordadas durante la Atención Individual"></textarea></div>
<div class="col-md-3">
<label>Tarea a realizar por el paciente:</label>
<textarea id="tarea" name="tarea" onkeyup="countChars(this);" rows="8" class="form-control input-sm chat-input" placeholder="Tarea a realizar por el paciente"></textarea></div>
</div>
<br>
</p>
<input type="hidden" id="idresidentes" name="idresidentes"></input>
<input type="hidden" id="fundacion" name="fundacion"></input>
<center>
<div class="wrapper">
<p id="charNum" style="font-size:1.25rem"></p>
<button type="submit" class="btn btn-info">Guardar y continuar</button>          
</div>
</center>
<script>
function countChars(obj){
    var maxLength = 5000;
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