<!DOCTYPE html>
<html lang="es" class="no-js">

<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["sadmin"]==true){

$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
	
include("menusadmin.html");
include_once('bas/conn.php');

$idr=$_REQUEST['idr'];
$documentor=$_REQUEST['documentor'];
$expedicionr=$_REQUEST['expedicionr'];
$fechan=$_REQUEST['fechan'];
$nomres=$_REQUEST['nomres'];
$apres=$_REQUEST['apres'];
$telefonor=$_REQUEST['telefonor'];
$celularr=$_REQUEST['celularr'];
$profesionr=$_REQUEST['profesionr'];
$emailr=$_REQUEST['emailr'];
$estador=$_REQUEST['estador'];
$direccionr=$_REQUEST['direccionr'];
$ciudadr=$_REQUEST['ciudadr'];
$estudiosr=$_REQUEST['estudiosr'];
$estadocivilr=$_REQUEST['estadocivilr'];
$conyuger=$_REQUEST['conyuger'];
$tipodocr=$_REQUEST['tipodocr'];
$eps=$_REQUEST['eps'];
$padrer=$_REQUEST['padrer'];
$madrer=$_REQUEST['madrer'];
$nomfund=$_REQUEST['nomfund'];
$idasociacion=$_REQUEST['idasociacion'];
$parentesco=$_REQUEST['parentesco'];
$idhistorial=$_REQUEST['idhistorial'];
$fechai=$_REQUEST['fechai'];
$motivoi=$_REQUEST['motivoi'];
$tiempoadiccion=$_REQUEST['tiempoadiccion'];
$medidatiempo=$_REQUEST['medidatiempo'];
$drogasusadas=$_REQUEST['drogasusadas'];
$problemas=$_REQUEST['problemas'];
$carcel=$_REQUEST['carcel'];
$fundaciones=$_REQUEST['fundaciones'];
$motivos=$_REQUEST['motivos'];
$referido=$_REQUEST['referido'];
$idhistorialm=$_REQUEST['idhistorialm'];
$enfermedades=$_REQUEST['enfermedades'];
$fechaexamen=$_REQUEST['fechaexamen'];
$estadosalud=$_REQUEST['estadosalud'];
$vacunas=$_REQUEST['vacunas'];
$diagnosis=$_REQUEST['diagnosis'];
$medicamentos=$_REQUEST['medicamentos'];
$alergias=$_REQUEST['alergias'];
$hospitalizado=$_REQUEST['hospitalizado'];
$descripcion=$_REQUEST['hospitald'];
$idusuarios=$_REQUEST['idusuarios'];
$documentou=$_REQUEST['documentou'];
$expedicionu=$_REQUEST['expedicionu'];
$nombresu=$_REQUEST['nombresu'];
$apellidosu=$_REQUEST['apellidosu'];
$telefonou=$_REQUEST['telefonou'];
$emailu=$_REQUEST['emailu'];
$autorizacion=$_REQUEST['autorizacion'];

//se crea el usuario con los datos y luego se crea la asociacion en este mismo archivo

mysqli_set_charset($con,"utf8");

if($nomfund=='EF'){
	$nomfund="FUNDACIÓN JESÚS ES MI ROCA";

$result=mysqli_query($con,"UPDATE residentes SET documentor='$documentor',expedicionr='$expedicionr',fechanacimiento='$fechan',nombresr='$nomres',apellidosr='$apres',
telefono='$telefonor',celular='$celularr',profesion='$profesionr',email='$emailr',estado='E',
direccionf='$direccionr',ciudad='$ciudadr',estudios='$estudiosr',estadocivil='$estadocivilr',
conyuge='$conyuger',tipodocumento='$tipodocr',eps='$eps',padre='$padrer',madre='$madrer',
nomfund='$nomfund' where idresidentes='$idr'");
}
else if($nomfund=='EJ'){
	$nomfund="CENTRO JOREC";

$result=mysqli_query($con,"UPDATE residentes SET documentor='$documentor',expedicionr='$expedicionr',fechanacimiento='$fechan',nombresr='$nomres',apellidosr='$apres',
telefono='$telefonor',celular='$celularr',profesion='$profesionr',email='$emailr',estado='E',
direccionf='$direccionr',ciudad='$ciudadr',estudios='$estudiosr',estadocivil='$estadocivilr',
conyuge='$conyuger',tipodocumento='$tipodocr',eps='$eps',padre='$padrer',madre='$madrer',
nomfund='$nomfund' where idresidentes='$idr'");
}
else if($nomfund=='J'){
	$nomfund="CENTRO JOREC";
	
$result=mysqli_query($con,"UPDATE residentes SET documentor='$documentor',expedicionr='$expedicionr',fechanacimiento='$fechan',nombresr='$nomres',apellidosr='$apres',
telefono='$telefonor',celular='$celularr',profesion='$profesionr',email='$emailr',estado='A',
direccionf='$direccionr',ciudad='$ciudadr',estudios='$estudiosr',estadocivil='$estadocivilr',
conyuge='$conyuger',tipodocumento='$tipodocr',eps='$eps',padre='$padrer',madre='$madrer',
nomfund='$nomfund' where idresidentes='$idr'");
}
else{$nomfund="FUNDACIÓN JESÚS ES MI ROCA";
	
$result=mysqli_query($con,"UPDATE residentes SET documentor='$documentor',expedicionr='$expedicionr',fechanacimiento='$fechan',nombresr='$nomres',apellidosr='$apres',
telefono='$telefonor',celular='$celularr',profesion='$profesionr',email='$emailr',estado='A',
direccionf='$direccionr',ciudad='$ciudadr',estudios='$estudiosr',estadocivil='$estadocivilr',
conyuge='$conyuger',tipodocumento='$tipodocr',eps='$eps',padre='$padrer',madre='$madrer',
nomfund='$nomfund' where idresidentes='$idr'");
}

$result2=mysqli_query($con,"UPDATE asociacion SET parentesco='$parentesco' where idasociacion='$idasociacion'");

$result3=mysqli_query($con,"UPDATE historial SET fechaingreso='$fechai',motivoi='$motivoi',tiempoadiccion='$tiempoadiccion',medidatiempo='$medidatiempo',drogasusadas='$drogasusadas',problemas='$problemas',carcel='$carcel',
fundaciones='$fundaciones',motivos='$motivos',referido='$referido' where idhistorial='$idhistorial'");
 
$result4=mysqli_query($con,"UPDATE historialm SET enfermedades='$enfermedades',fechaexamen='$fechaexamen',estadosalud='$estadosalud',vacunas='$vacunas',diagnosis='$diagnosis',medicamentos='$medicamentos',alergias='$alergias',hospitalizado='$hospitalizado',descripcion='$descripcion' where idhistorialm='$idhistorialm'");

$result5=mysqli_query($con,"UPDATE usuarios SET documento='$documentou',expedicion='$expedicionu',nombres='$nombresu',apellidos='$apellidosu',telefono='$telefonou',email='$emailu',autorizacion='$autorizacion' where idusuarios='$idusuarios'");
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
<p>
<p><center><h2><u>Registro del residente actualizado</u></h2></center></p><br>
<center><p>Para ver detalle del registro y/o imprimirlo; por favor clickea sobre el botón generar vista de documentación.</p></center>
<center>
<?php
if($nomfund==="FUNDACIÓN JESÚS ES MI ROCA"){
?>
<form id="detalle" action = "detallef.php" method = "post" target="_blank">
<?php	
}
else if($nomfund==="CENTRO JOREC"){
?>
<form id="detalle" action = "detallej.php" method = "post" target="_blank">
<?php	
}
?>
<input type="hidden" id="idresidente" name="idresidente" value="<?php echo $idr;?>"></input><!--oculto idresidente-->

<div class="wrapper">
<button type="submit" class="btn btn-default">Generar vista de documentación.</button>          
</div>
</center>
</form>
</p>
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