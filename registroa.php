<!DOCTYPE html>
<html lang="es" class="no-js">

<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["admin"]==true){

$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
	
include("menuadmin.html");
include_once('bas/conn.php');
$idresidente=$_REQUEST['idresidente'];
$nomfund=$_REQUEST['nomfund'];
$nombresa=$_REQUEST['nombresa'];
$apellidosa=$_REQUEST['apellidosa'];
$documentoa=$_REQUEST['documentoa'];
$celulara=$_REQUEST['celulara'];
$emaila=$_REQUEST['emaila'];
$parentesco=$_REQUEST['parentesco'];
$expedido=$_REQUEST['expedido'];
$autorizo=$_REQUEST['autorizo'];
$actor="$nombresa"." "."$apellidosa";

$residentes=$_REQUEST['residentes'];
$actores=$_REQUEST['actores'];
$ultimoresidente=$_REQUEST['ultimoresidente'];
$pensiones=$_REQUEST['pensiones'];
$abpensiones=$_REQUEST['abpensiones'];
$uniformes=$_REQUEST['uniformes'];
$historialesi=$_REQUEST['historialesi'];
$historiales=$_REQUEST['historiales'];

if($nomfund=="FUNDACIÓN JESÚS ES MI ROCA"){$nf="F";}
else if($nomfund=="CENTRO JOREC"){$nf="J";}

$pass=MD5($documentoa);

//se crea el usuario con los datos y luego se crea la asociacion en este mismo archivo

mysqli_set_charset($con,"utf8");
$usuarios="INSERT INTO usuarios(documento,expedicion,nombres,apellidos,telefono,email,autorizacion,idroles) 
VALUES ('$documentoa','$expedido','$nombresa','$apellidosa','$celulara','$emaila','$autorizo','5')";

$actoresu="INSERT INTO actores(nombre) VALUES ('$actor')";
	
$result1=mysqli_query($con,"SELECT idusuarios FROM usuarios ORDER by idusuarios DESC LIMIT 1");
		while ($resultx = mysqli_fetch_array($result1)) {
		$idusuario=$resultx['idusuarios'];
		$idusuario=($idusuario+1);
		}

$asociacion="INSERT INTO asociacion(idresidentes,idusuarios,parentesco) 
VALUES ('$idresidente','$idusuario','$parentesco')";
		
$validacion="INSERT INTO validacion(password,idusuarios) VALUES ('$pass','$idusuario')";
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
select#selectoption {
	border-left:none;
	padding:none;
}

input#datahere {
	position:relative;
	border-right:none;
	padding:none;
}
</style>

<body>

<div class="container">
<div class="jumbotron">
<p><center><h2><u>Estado físico</u></h2></center></p><br>

<form id="registro" action = "verificaciona.php" method = "post">
<p>

<div class="row">
<div class="col-md-9">
<label>¿Padece el residente alguna enfermedad?:</label>
<input type="text" id="enfermedad" name="enfermedad" class="form-control input-sm chat-input" placeholder="Ingrese las enfermedades que padece"></input>
</div>
<div class="col-md-3">
<label>Fecha de último exámen físico:</label>
<input type="date" id="fechae" name="fechae" class="form-control input-sm chat-input">
</div>
</div>
<br>

<div class="row">
<div class="col-md-3">
<label>¿Cómo califica su salud en general?:</label>
<select id="salud" name="salud" class="form-control input-sm chat-input">
<option value="Excelente">Excelente</option>
<option value="Buena">Buena</option>
<option value="Regular">Regular</option>
<option value="Pobre">Pobre</option>
</select></div>
<div class="col-md-3">
<label>¿Tiene sus vacunas al dia?:</label>
<select id="vacunas" name="vacunas" class="form-control input-sm chat-input">
<option value="Si">Si</option>
<option value="No">No</option>
</select>
</div>
<div class="col-md-6">
<label>Diagnóstico por el médico:</label>
<input type="text" id="diagnosis" name="diagnosis" class="form-control input-sm chat-input" placeholder="Ingrese las enfermedades que padece"></input>
</div>
</div>
<br>

<div class="row">
<div class="col-md-6">
<label>¿Toma algún medicamento?:</label>
<input type="text" id="medicamento" name="medicamento" class="form-control input-sm chat-input" placeholder="Ingrese los medicamentos que toma"></input>
</div>
<div class="col-md-6">
<label>¿Tiene alergias?:</label>
<input type="text" id="alergias" name="alergias" class="form-control input-sm chat-input" placeholder="Ingrese las alergias que padece"></input>
</div>
</div>
<br>

<div class="row">
<div class="col-md-12">
<label>¿Ha estado hospitalizado?:</label>
<span>
<select id="selectoption" name="hospital"/><option value="Si">Si</option><option value="No">No</option></select>
<input type="text" id="datahere" name="hospitald" class="form-control input-sm chat-input" placeholder="Describa si su respuesta es si."/>
</span>
</div>
</div>
<br>

</p>
<input type="hidden" id="idresidente" name="idresidente" value="<?php echo $idresidente;?>"></input><!--oculto idresidente-->
<input type="hidden" id="nomfund" name="nomfund" value="<?php echo $nomfund;?>"></input><!--oculto nombre fundacion-->

<input type="hidden" id="residentes" name="residentes" value="<?php echo $residentes;?>"></input><!--oculto query residentes-->
<input type="hidden" id="actores" name="actores" value="<?php echo $actores;?>"></input><!--oculto query actores-->
<input type="hidden" id="ultimoresidente" name="ultimoresidente" value="<?php echo $ultimoresidente;?>"></input><!--oculto ultimoresidente-->
<input type="hidden" id="pensiones" name="pensiones" value="<?php echo $pensiones;?>"></input><!--oculto query pensiones-->
<input type="hidden" id="abpensiones" name="abpensiones" value="<?php echo $abpensiones;?>"></input><!--oculto query abonopensiones-->
<input type="hidden" id="uniformes" name="uniformes" value="<?php echo $uniformes;?>"></input><!--oculto query uniformes-->
<input type="hidden" id="historialesi" name="historialesi" value="<?php echo $historialesi;?>"></input><!--oculto query historialesi-->
<input type="hidden" id="historiales" name="historiales" value="<?php echo $historiales;?>"></input><!--oculto query historiales-->

<input type="hidden" id="usuarios" name="usuarios" value="<?php echo $usuarios;?>"></input><!--oculto query usuarios-->
<input type="hidden" id="actoresu" name="actoresu" value="<?php echo $actoresu;?>"></input><!--oculto query actoresu-->
<input type="hidden" id="asociacion" name="asociacion" value="<?php echo $asociacion;?>"></input><!--oculto asociacion-->
<input type="hidden" id="validacion" name="validacion" value="<?php echo $validacion;?>"></input><!--oculto query validacion-->

<center>
<div class="wrapper">
<button type="submit" class="btn btn-default">Terminar registro</button>          
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