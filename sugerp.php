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
<p><center><h2><u>Sugeridos seguimiento Residente</u></h2></center></p><br>
<form id="residente" action = "sugeridop.php" method = "post">
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
<label>Dirigido a:</label><br>
<select name="area" id="area" class="form-control input-sm chat-input">

<?php
$queryp2="select idusuarios,nombres,apellidos,idroles from usuarios where (idroles='4' or idroles='7') and estado='A'";
$resultp2=mysqli_query($con,"$queryp2");
while ($resultxp2 = mysqli_fetch_array($resultp2)) {
$nombres2=$resultxp2['nombres'];
$apellidos2=$resultxp2['apellidos'];
$idusuarios=$resultxp2['idusuarios'];
$idroles=$resultxp2['idroles'];
$psicologo=$nombres2." ".$apellidos2;

	if($idroles==4){
		$rol="PSICÓLOGO";
	}
	else if($idroles==7){
		$rol="Practicante";
	}
?>
<option value="<?php echo $idusuarios;?>"><?php echo $rol;?> : <?php echo $psicologo;?></option>
<?php
}
?>

</select>
</div>

</div>
<br>

<div class="row">
<div class="col-md-12">
<label>Sugerencias:</label>
<textarea id="sesion" name="sesion" rows="4" class="form-control input-sm chat-input" placeholder="Trabajo sugerido"></textarea></div>
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