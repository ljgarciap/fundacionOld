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
                source: "residenteshistoria.php",
                minLength: 1,
                select: function(event, ui) {
					event.preventDefault();
					$('#nombre').val(ui.item.nombrer);
					$('#cedula').val(ui.item.docr);
					$('#idresidentes').val(ui.item.idresidentes);
					$('#fundacion').val(ui.item.nomfund);
					$('#expedido').val(ui.item.expr);
					$('#fechai').val(ui.item.fechai);
					$('#fechan').val(ui.item.fechan);
					$('#escolaridad').val(ui.item.estudios);
					$('#oficio').val(ui.item.profesion);
					$('#direccion').val(ui.item.direccionf);
					$('#telefono').val(ui.item.telefono);
					$('#eps').val(ui.item.eps);
					$('#edad').val(ui.item.edad);
			     }
            });
		});
</script>
</HEAD>

<body>

<div class="container">
<div class="jumbotron">
<p><center><h2><u>GENERALIDADES ACOMPAÑAMIENTO</u></h2></center></p><br>
<form id="residente" action = "histoclinica.php" method = "post">
<p>
<div class="row">
<div class="col-md-1">
<?php
mysqli_set_charset($con,"utf8");
$resultp=mysqli_query($con,"select idhistoriaclinica from historiaclinica order by idhistoriaclinica desc LIMIT 1");
$idhistoriaclinica=0;
while ($resultxp = mysqli_fetch_array($resultp)) {
$idhistoriaclinica=$resultxp['idhistoriaclinica'];
}
$idhistoriaclinica=($idhistoriaclinica+1);
?>
<label>CONS:</label>
<input type="text" id="cons" name="cons" class="form-control input-sm chat-input" value='<?php echo $idhistoriaclinica;?>' readonly/>
</div>
<div class="col-md-2">
<label>Fecha realización:</label>
<input type="date" id="fecha" name="fecha" class="form-control input-sm chat-input" value='<?php echo "20$hoy";?>' required/>
</div>
<div class="col-md-2">
<label>Fecha ingreso:</label>
<input type="date" id="fechai" name="fechai" class="form-control input-sm chat-input" value='' readonly/>
</div>
<div class="col-md-3">
<label for="nombre">Residente:</label>
<input type="text" id="nombre" name="nombre" class="form-control input-sm chat-input" placeholder="Ingrese los nombres del residente" required/></div>
<div class="col-md-4">
<label for="remitido">Remitido:</label>
<input type="text" id="remitido" name="remitido" class="form-control input-sm chat-input" placeholder="Remitido por" required/></div>
</div>
<br>
<h3>DATOS DE IDENTIFICACIÓN</h3><br>
<div class="row">
<div class="col-md-2">
<label>Documento:</label>
<input type="text" id="cedula" name="cedula" class="form-control input-sm chat-input"readonly/></div>
<div class="col-md-2">
<label>Expedido:</label>
<input type="text" id="expedido" name="expedido" class="form-control input-sm chat-input"readonly/></div>
<div class="col-md-2">
<label for="fechan">Fecha nacimiento:</label>
<input type="date" id="fechan" name="fechan" class="form-control input-sm chat-input"  readonly/></div>
<div class="col-md-3">
<label>Lugar nacimiento:</label>
<select id="lugarn" name="lugarn" class="form-control input-sm chat-input">
  <option value="902" selected>PIEDECUESTA</option>
<?php
$selectciudad=mysqli_query($con,"select DETALLE_CIUDADES as ciudad,ID_CIUDADES as idciudad FROM ciudades order by DETALLE_CIUDADES asc");
		while ($resultc = mysqli_fetch_array($selectciudad)) {
		$sciudad=$resultc['ciudad'];
		$iciudad=$resultc['idciudad'];
		echo "<option value='$iciudad'>$sciudad</option>";
		}
?>
</select>
</div>
<div class="col-md-1">
<label>Edad:</label>
<input type="text" id="edad" name="edad" class="form-control input-sm chat-input" readonly/></div>
<div class="col-md-2">
<label for="genero">Genero:</label>
<input type="text" id="genero" name="genero" class="form-control input-sm chat-input"  required/></div>
</div>
<br>

<div class="row">
<div class="col-md-1">
<label>Escolaridad:</label>
<input type="text" id="escolaridad" name="escolaridad" class="form-control input-sm chat-input" readonly/></div>
<div class="col-md-2">
<label>Oficio:</label>
<input type="text" id="oficio" name="oficio" class="form-control input-sm chat-input"readonly/></div>
<div class="col-md-4">
<label for="direccion">Dirección:</label>
<input type="text" id="direccion" name="direccion" class="form-control input-sm chat-input" readonly/></div>
<div class="col-md-2">
<label>Teléfono:</label>
<input type="text" id="telefono" name="telefono" class="form-control input-sm chat-input"readonly/></div>
<div class="col-md-3">
<label>Seguro social:</label>
<input type="text" id="eps" name="eps" class="form-control input-sm chat-input" readonly/></div>
</div>
<br>

<h3>GENERALIDADES</h3><br>
<div class="row">
<div class="col-md-6">
<label>Motivo de consulta:</label>
<textarea id="motivoconsulta" name="motivoconsulta" onkeyup="countChars(this);" rows="6" class="form-control input-sm chat-input" placeholder="Motivo de la consulta"></textarea></div>
<div class="col-md-6">
<label>Descripción de la situación actual:</label>
<textarea id="descripcion" name="descripcion" onkeyup="countChars(this);" rows="6" class="form-control input-sm chat-input" placeholder="Descripción de la situación actual del paciente."></textarea></div>
</div>
<br>

<h3>ANTECEDENTES</h3><br>
<div class="row">
<div class="col-md-6">
<label>Antecedentes Médicos, Psicológicos y Psiquiátricos</label>
<textarea id="amedicos" name="amedicos" onkeyup="countChars(this);" rows="4" class="form-control input-sm chat-input" placeholder="Antecedentes Médicos, Psicológicos y Psiquiátricos."></textarea></div>
<div class="col-md-6">
<label>Antecedentes Familiares</label>
<textarea id="afamiliares" name="afamiliares" onkeyup="countChars(this);" rows="4" class="form-control input-sm chat-input" placeholder="Antecedentes Familiares."></textarea></div>
</div>
<br>
<div class="row">
<div class="col-md-4">
<label>Antecedentes Personales</label>
<textarea id="apersonales" name="apersonales" onkeyup="countChars(this);" rows="7" class="form-control input-sm chat-input" placeholder="Antecedentes Personales."></textarea></div>
<div class="col-md-4">
<label>Factores Prenatales y nacimiento</label>
<textarea id="condiciones" name="condiciones" onkeyup="countChars(this);" rows="7" class="form-control input-sm chat-input" placeholder="Factores Prenatales  y nacimiento(condiciones Físicas, situacionales y psicológicas de la madre en el embarazo)"></textarea></div>
<div class="col-md-4">
<label>Aspectos Relevantes del desarrollo</label>
<textarea id="aspectos" name="aspectos" onkeyup="countChars(this);" rows="7" class="form-control input-sm chat-input" placeholder="Aspectos Relevantes del desarrollo: (Infancia, Adolescencia, edad adulta, adultez mayor)"></textarea></div>
</div>
<br>

<h3>AREAS DE FUNCIONAMIENTO</h3><br>
<h4>AREA FAMILIAR</h4><br>
<div class="row">
<div class="col-md-6">
<label>Tipologia familiar</label>
<input type="text" id="tipologia" name="tipologia" rows="4" class="form-control input-sm chat-input" placeholder="Tipologia Familiar"></input></div>
<div class="col-md-6">
<label>Genograma</label><br>
<a href="subirgenograma.php" target="blank">Subir genograma</a></div>
</div>
<br>
<div class="row">
<div class="col-md-6">
<label>Observaciones</label>
<textarea id="observaciones" name="observaciones" onkeyup="countChars(this);" rows="4" class="form-control input-sm chat-input" placeholder="Observaciones"></textarea></div>
<div class="col-md-6">
<label>Area Personal</label>
<textarea id="personal" name="personal" onkeyup="countChars(this);" rows="4" class="form-control input-sm chat-input" placeholder="Area Personal"></textarea></div>
</div>
<br>
<div class="row">
<div class="col-md-4">
<label>Área Social</label>
<textarea id="social" name="social" onkeyup="countChars(this);" rows="7" class="form-control input-sm chat-input" placeholder="Área Social."></textarea></div>
<div class="col-md-4">
<label>Área Educativa / Ocupacional</label>
<textarea id="educativa" name="educativa" onkeyup="countChars(this);" rows="7" class="form-control input-sm chat-input" placeholder="Área Educativa / Ocupacional"></textarea></div>
<div class="col-md-4">
<label>Área Afectiva</label>
<textarea id="afectiva" name="afectiva" onkeyup="countChars(this);" rows="7" class="form-control input-sm chat-input" placeholder="Área Afectiva"></textarea></div>
</div>
<br>

<div class="row">
<div class="col-md-6">
<label>PROCESO DE ACOMPAÑAMIENTO PSICOLOGICO</label>
<textarea id="estrategias" name="estrategias" onkeyup="countChars(this);" rows="4" class="form-control input-sm chat-input" placeholder="Técnicas o  Estrategias  Psicológicas Abordadas"></textarea></div>
<div class="col-md-6">
<label>OBSERVACIONES GENERALES </label>
<textarea id="observacionesgen" name="observacionesgen" onkeyup="countChars(this);" rows="4" class="form-control input-sm chat-input" placeholder="OBSERVACIONES GENERALES"></textarea></div>
</div>
<br>
<div class="row">
<div class="col-md-6">
<label>IMPRESIÓN DIAGNÓSTICA</label>
<textarea id="impresion" name="impresion" onkeyup="countChars(this);" rows="4" class="form-control input-sm chat-input" placeholder="IMPRESIÓN DIAGNÓSTICA  (Descriptiva)."></textarea></div>
<div class="col-md-6">
<label>PLAN DE ACOMPAÑAMIENTO PSICOLOGICO</label>
<textarea id="plan" name="plan" onkeyup="countChars(this);" rows="4" class="form-control input-sm chat-input" placeholder="PLAN DE ACOMPAÑAMIENTO PSICOLOGICO"></textarea></div>
</div>
<br>

</p>
<input type="hidden" id="idresidentes" name="idresidentes"></input>
<input type="hidden" id="fundacion" name="fundacion"></input>

<input type="hidden" id="cedorientador" name="cedorientador" value="<?php echo $usuariosess ?>"></input>
<input type="hidden" id="orientador" name="orientador" value="<?php echo $nombresess ?>"></input>

<center>
<div class="wrapper">
<p id="charNum" style="font-size:1.25rem"></p>
<button type="submit" class="btn btn-info">Guardar y continuar</button>          
</div>
</center>
<script>
function countChars(obj){
    var maxLength = 2500;
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