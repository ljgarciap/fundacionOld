<!DOCTYPE html>
<html lang="es" class="no-js">

<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["terg"]==true){
	
$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];

include("menuterg.html");
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
<form id="residente" action = "seguimientog.php" method = "post">
<p>
<div class="row">
<div class="col-md-2">
<label>Fecha:</label>
<input type="date" id="fechar" name="fechar" class="form-control input-sm chat-input" value='<?php echo "20$hoy";?>' required/>
</div>
<div class="col-md-3">
<label>Director:</label>
<input type="text" id="colider" name="colider" class="form-control input-sm chat-input" placeholder="Ingrese el director"></input>
</div>
<div class="col-md-4">
<label>Residente:</label>
<input type="text" id="nombrer" name="nombrer" class="form-control input-sm chat-input" placeholder="Ingrese los nombres del residente" style="text-transform: uppercase;"></input></div>
<div class="col-md-3">
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
<label>Fallas que trae:</label><br>
<div class="row">
<div class="col-md-4">
<label><input type="checkbox" name="fallas[0]" value="Falta de respeto"> Falta de respeto</label><br>
<label><input type="checkbox" name="fallas[1]" value="Consumo"> Consumo</label><br>
<label><input type="checkbox" name="fallas[2]" value="Reingreso"> Reingreso</label><br>
</div>
<div class="col-md-8">
<label><input type="checkbox" name="fallas[3]" value="Manipulación a la familia"> Manipulación a la familia</label><br>
<label><input type="checkbox" name="fallas[4]" value="Agresión a compañero"> Agresión a compañero</label><br>
<label><input type="checkbox" name="fallas[5]" value="Falta de respeto a un directivo"> Falta de respeto a un directivo</label><br>
</div>
</div>
<textarea name="observaciones" rows="5" class="form-control input-sm chat-input" placeholder="Motivos de la confrontación y observaciones"></textarea>
</div>

<div class="col-md-8">
<label>Ayudas:</label>
<div class="row">
<div class="col-md-4">
<label><input type="checkbox" name="ayudas[0]" value="Orden x 8 días"> Orden x 8 días</label><br>
<label><input type="checkbox" name="ayudas[1]" value="Planas 1000 (200 Diarias)"> Planas 1000 (200 Diarias)</label><br>
<label><input type="checkbox" name="ayudas[2]" value="Recorte de cabello – Grave"> Recorte de cabello (Grave)</label><br>
<label><input type="checkbox" name="ayudas[3]" value="Introspección x 8 días – 20m diarios"> Introspección x 8 días (20m diarios)</label><br>
</div>
<div class="col-md-4">
<label><input type="checkbox" name="ayudas[4]" value="Perdida de visitas x 1 domingo"> Perdida de visitas x 1 domingo</label><br>
<label><input type="checkbox" name="ayudas[5]" value="Perdida de visitas x 2 domingos"> Perdida de visitas x 2 domingos</label><br>
<label><input type="checkbox" name="ayudas[6]" value="Perdida de visitas x 3 domingos"> Perdida de visitas x 3 domingos</label><br>
<label><input type="checkbox" name="ayudas[7]" value="Perdida de visitas x 4 domingos"> Perdida de visitas x 4 domingos</label><br>
</div>
<div class="col-md-4">
<label><input type="checkbox" name="ayudas[8]" value="Perdida de llamadas x 1 viernes"> Perdida de llamadas x 1 viernes</label><br>
<label><input type="checkbox" name="ayudas[9]" value="Perdida de llamadas x 2 viernes"> Perdida de llamadas x 2 viernes</label><br>
<label><input type="checkbox" name="ayudas[10]" value="Perdida de llamadas x 3 viernes"> Perdida de llamadas x 3 viernes</label><br>
<label><input type="checkbox" name="ayudas[11]" value="Perdida de llamadas x 4 viernes"> Perdida de llamadas x 4 viernes</label><br>
</div>
</div>
<textarea name="ayudas[12]" rows="3" class="form-control input-sm chat-input" placeholder="Otras fallas"></textarea></div>
</div><br>
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