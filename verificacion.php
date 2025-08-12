<!DOCTYPE html>
<html lang="es" class="no-js">

<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["sadmin"]==true){

$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
	
include("menusadmin.html");
include_once('bas/conn.php');
$idresidente=$_REQUEST['idresidente'];
$nomfund=$_REQUEST['nomfund'];
$enfermedad=$_REQUEST['enfermedad'];
$fechae=$_REQUEST['fechae'];
$salud=$_REQUEST['salud'];
$vacunas=$_REQUEST['vacunas'];
$diagnosis=$_REQUEST['diagnosis'];
$medicamento=$_REQUEST['medicamento'];
$alergias=$_REQUEST['alergias'];
$hospital=$_REQUEST['hospital'];
$hospitald=$_REQUEST['hospitald'];

$residentes=$_REQUEST['residentes'];
$actores=$_REQUEST['actores'];
$ultimoresidente=$_REQUEST['ultimoresidente'];
$pensiones=$_REQUEST['pensiones'];
$abpensiones=$_REQUEST['abpensiones'];
$uniformes=$_REQUEST['uniformes'];
$historialesi=$_REQUEST['historialesi'];
$historiales=$_REQUEST['historiales'];

$usuarios=$_REQUEST['usuarios'];
$actoresu=$_REQUEST['actoresu'];
$asociacion=$_REQUEST['asociacion'];
$validacion=$_REQUEST['validacion'];

//se crea el usuario con los datos y luego se crea la asociacion en este mismo archivo

mysqli_set_charset($con,"utf8");
$historialm="INSERT INTO historialm(enfermedades,fechaexamen,estadosalud,vacunas,diagnosis,medicamentos,
alergias,hospitalizado,descripcion,idresidentes) VALUES ('$enfermedad','$fechae','$salud','$vacunas','$diagnosis','$medicamento','$alergias','$hospital','$hospitald',
'$idresidente')";

$resresidentes=mysqli_query($con,"$residentes");
$resactores=mysqli_query($con,"$actores");
$resultimoresidente=mysqli_query($con,"$ultimoresidente");
$respensiones=mysqli_query($con,"$pensiones");
$resabpensiones=mysqli_query($con,"$abpensiones");
$resuniformes=mysqli_query($con,"$uniformes");
$reshistorialesi=mysqli_query($con,"$historialesi");
$reshistoriales=mysqli_query($con,"$historiales");
$resusuarios=mysqli_query($con,"$usuarios");
$resactoresu=mysqli_query($con,"$actoresu");
$resasociacion=mysqli_query($con,"$asociacion");
$resvalidacion=mysqli_query($con,"$validacion");
$reshistorialm=mysqli_query($con,"$historialm");

/*
echo "<br><br><br>";
echo "$residentes";echo "<br>";
echo "$actores";echo "<br>";
echo "$ultimoresidente";echo "<br>";
echo "$pensiones";echo "<br>";
echo "$abpensiones";echo "<br>";
echo "$uniformes";echo "<br>";
echo "$historialesi";echo "<br>";
echo "$historiales";echo "<br>";
echo "$usuarios";echo "<br>";
echo "$actoresu";echo "<br>";
echo "$asociacion";echo "<br>";
echo "$validacion";echo "<br>";
echo "$historialm";echo "<br>";
*/
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
<p><center><h2><u>Registro del residente completo</u></h2></center></p><br>
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
<input type="hidden" id="idresidente" name="idresidente" value="<?php echo $idresidente;?>"></input><!--oculto idresidente-->

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