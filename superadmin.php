<!DOCTYPE html>
<html lang="es">

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
<p><center><h2><u>Formulario de Ingreso del Residente</u></h2></center></p><br>
<form id="residente" action = "acudiente.php" method = "post">
<div class="row">
<div class="col-md-4">
<p><select id="nomfund" name="nomfund" class="form-control input-sm chat-input">
<option value="FUNDACIÓN JESÚS ES MI ROCA">FUNDACIÓN JESÚS ES MI ROCA</option>
<option value="CENTRO JOREC">CENTRO JOREC</option>
<option value="3">-*-</option>
</select>
</div>
<div class="col-md-4">
Valor pension: <input type="number" id="pension" name="pension" required></input>
</div>
<div class="col-md-4">
Valor uniforme: <input type="number" id="uniforme" name="uniforme" required>></input>
</div>
</div>
<br>
Bienvenido; por favor llene este formulario de manera precisa, es muy importante para nosotros tener esta información para poder brindar el mejor cuidado posible para usted o para su familiar. Su privacidad es importante para nosotros. La información que comparte con nosotros permanecerá estrictamente confidencial.</p>
<p><center><h2><u>Información personal</u></h2></center></p><br>
<p>
<div class="row">
<div class="col-md-6">
<label>Fecha de ingreso:</label>
<input type="date" id="fechai" name="fechai" class="form-control input-sm chat-input" value='<?php echo "20$hoy";?>' required/>
</div>
<div class="col-md-6">
<label>Ingresa a:</label>
<input type="text" id="motivo" name="motivo" class="form-control input-sm chat-input" placeholder="Ingrese su motivo"></input>
</div>
</div>
<br>

<div class="row">
<div class="col-md-6">
<label>Nombres:</label>
<input type="text" id="nombresr" name="nombresr" class="form-control input-sm chat-input" placeholder="Ingrese los nombres del nuevo residente" style="text-transform: uppercase;" required/></div>
<div class="col-md-6">
<label>Apellidos:</label>
<input type="text" id="apellidosr" name="apellidosr" class="form-control input-sm chat-input" placeholder="Ingrese los apellidos del nuevo residente" style="text-transform: uppercase;" required/>
</div>
</div>
<br>

<div class="row">
<div class="col-md-4">
<label>Fecha de nacimiento:</label>
<input type="date" id="fechan" name="fechan" class="form-control input-sm chat-input" required/>
</div>
<div class="col-md-4">
<label>Seguro social:</label>
<input type="text" id="seguro" name="seguro" class="form-control input-sm chat-input" placeholder="Ingrese su eps" style="text-transform: uppercase;"></input>
</div>
<div class="col-md-4">
<label>Número documento:</label>
<input type="number" id="documentor" name="documentor" class="form-control input-sm chat-input" placeholder="Ingrese el documento" required/>
</div>
</div>
<br>

<div class="row">
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
<div class="col-md-1">
<label>Tipo:</label>
<select id="tipodocr" name="tipodocr" class="form-control input-sm chat-input">
<option value="T.I">T.I</option>
<option value="C.C">C.C</option>
<option value="C.C">R.C</option>
</select></div>
<div class="col-md-3">
<label>Teléfono fijo:</label>
<input type="text" id="telefonor" name="telefonor" class="form-control input-sm chat-input" placeholder="Ingrese teléfono fijo"></input>
</div>
<div class="col-md-4">
<label>Celular:</label>
<input type="text" id="celularr" name="celularr" class="form-control input-sm chat-input" placeholder="Ingrese el número de celular"></input>
</div>
</div>
<br>

<div class="row">
<div class="col-md-8">
<label>Dirección:</label>
<input type="text" id="direccion" name="direccion" class="form-control input-sm chat-input" placeholder="Ingrese la dirección" style="text-transform: uppercase;"></input></div>
<div class="col-md-4">
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
<div class="col-md-2">
<label>Estudios:</label>
<select id="estudios" name="estudios" class="form-control input-sm chat-input">
<option value="Ninguno">Ninguno</option>
<option value="1°">1°</option>
<option value="2°">2°</option>
<option value="3°">3°</option>
<option value="4°">4°</option>
<option value="5°">5°</option>
<option value="6°">6°</option>
<option value="7°">7°</option>
<option value="8°">8°</option>
<option value="9°">9°</option>
<option value="10°">10°</option>
<option value="11°">11°</option>
<option value="Superior">Superior</option>
</select></div>
<div class="col-md-5">
<label>Profesión u oficio:</label>
<input type="text" id="profesion" name="profesion" class="form-control input-sm chat-input" placeholder="Ingrese profesión" style="text-transform: uppercase;"></input>
</div>
<div class="col-md-5">
<label>Correo electrónico:</label>
<input type="e-mail" id="emailr" name="emailr" class="form-control input-sm chat-input" placeholder="Ingrese el correo electrónico"></input>
</div>
</div>
<br>

<div class="row">
<div class="col-md-3">
<label>Estado civil:</label>
<select id="estadocivil" name="estadocivil" class="form-control input-sm chat-input">
<option value="Soltero">Soltero</option>
<option value="Casado">Casado</option>
<option value="Separado">Separado</option>
<option value="Unión libre">Unión libre</option>
</select></div>
<div class="col-md-9">
<label>Nombre del cónyuge:</label>
<input type="text" id="conyuge" name="conyuge" class="form-control input-sm chat-input" placeholder="Ingrese el nombre del cónyuge" style="text-transform: uppercase;"></input>
</div>
</div>
<br>

<div class="row">
<div class="col-md-6">
<label>Nombre del padre:</label>
<input type="text" id="padre" name="padre" class="form-control input-sm chat-input" placeholder="Ingrese nombre completo" style="text-transform: uppercase;"></input></div>
<div class="col-md-6">
<label>Nombre de la madre:</label>
<input type="text" id="madre" name="madre" class="form-control input-sm chat-input" placeholder="Ingrese nombre completo" style="text-transform: uppercase;"></input>
</div>
</div>
<br>

<div class="row">
<div class="col-md-2">
<label>Tiempo en la adicción:</label>
<div class="row">
<div class="col-md-5">
<input type="number" id="tiempo" name="tiempo" class="form-control input-sm chat-input" placeholder="#"></input>
</div>
<div class="col-md-7">
<select id="medida" name="medida" class="form-control input-sm chat-input">
<option value="Dias">Dias</option>
<option value="Semanas">Semanas</option>
<option value="Meses">Meses</option>
<option value="Años">Años</option>
</select>
</div>
</div>
</div>
<div class="col-md-6">
<label>Drogas usadas:</label>
<input type="text" id="drogas" name="drogas" class="form-control input-sm chat-input" placeholder="Ingrese la lista de drogas" style="text-transform: uppercase;"></input>
</div>
<div class="col-md-2">
<label>Problemas con la justicia:</label>
<select id="prob" name="prob" class="form-control input-sm chat-input">
<option value="No">No</option>
<option value="Si">Si</option>
</select>
</div>
<div class="col-md-2">
<label>Ha estado preso:</label>
<select id="preso" name="preso" class="form-control input-sm chat-input">
<option value="No">No</option>
<option value="Si">Si</option>
</select>
</div>
</div>
<br>

<div class="row">
<div class="col-md-5">
<label>Fundaciones en las que ha estado:</label>
<input type="text" id="fundaciones" name="fundaciones" class="form-control input-sm chat-input" placeholder="Ingrese las fundaciones" style="text-transform: uppercase;"></input></div>
<div class="col-md-4">
<label>Motivos del retiro:</label>
<input type="text" id="retiro" name="retiro" class="form-control input-sm chat-input" placeholder="Ingrese los motivos" style="text-transform: uppercase;"></input>
</div>
<div class="col-md-3">
<label>Cómo se enteró de nosotros:</label>
<input type="text" id="referido" name="referido" class="form-control input-sm chat-input" placeholder="Ingrese  medio de como se enteró" style="text-transform: uppercase;"></input>
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

<script type="text/javascript">
$(function() {
            $("#documentor").autocomplete({
			maxShowItems: 5,
                source: "residentesd.php",
                minLength: 1,
                select: function(event, ui) {
					event.preventDefault();
		
			     }
            });
		});
</script>		<!-- boots -->

<?php	
include("footersadmin.html");

}
else {
header("Location:index.php");
}
?>
</body>
</html>