<!DOCTYPE html>
<html lang="es" class="no-js">

<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["tere"]==true){

$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
	
include("menutere.html");
include_once('bas/conn.php');

$hoy=date("y-m-d"); 

$fecha=$_REQUEST['fecha'];
$remitido=$_REQUEST['remitido'];
$lugarn=$_REQUEST['lugarn'];
$genero=$_REQUEST['genero'];
$motivoconsulta=$_REQUEST['motivoconsulta'];
$descripcion=$_REQUEST['descripcion'];
$amedicos=$_REQUEST['amedicos'];
$afamiliares=$_REQUEST['afamiliares'];
$apersonales=$_REQUEST['apersonales'];
$condiciones=$_REQUEST['condiciones'];
$aspectos=$_REQUEST['aspectos'];
$tipologia=$_REQUEST['tipologia'];
$observaciones=$_REQUEST['observaciones'];
$personal=$_REQUEST['personal'];
$social=$_REQUEST['social'];
$educativa=$_REQUEST['educativa'];
$afectiva=$_REQUEST['afectiva'];
$estrategias=$_REQUEST['estrategias'];
$observacionesgen=$_REQUEST['observacionesgen'];
$impresion=$_REQUEST['impresion'];
$plan=$_REQUEST['plan'];
$idresidentes=$_REQUEST['idresidentes'];
$fundacion=$_REQUEST['fundacion'];
$cedorientador=$_REQUEST['cedorientador'];
$orientador=$_REQUEST['orientador'];

mysqli_set_charset($con,"utf8");

$query1="INSERT INTO historiaclinicap(genero,lugarnacimiento,
fechaingreso,remitido,motivoconsulta,descripcion,amedicos,afamiliares,apersonales,
condiciones,aspectos,tipologia,observaciones,personal,social,educativa,afectiva,
estrategias,observacionesgen,impresion,plan,orientador,cedorientador,idresidentes) 
VALUES ('$genero','$lugarn','$fecha','$remitido','$motivoconsulta',
'$descripcion','$amedicos','$afamiliares','$apersonales','$condiciones','$aspectos',
'$tipologia','$observaciones','$personal','$social','$educativa','$afectiva',
'$estrategias','$observacionesgen','$impresion','$plan','$orientador','$cedorientador',
'$idresidentes')";

$result1=mysqli_query($con,$query1);
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
<?php 
echo "<br><br>";
//echo $query1;

if($result1){
?>
<p><center><h2><u>Registro actualizado</u></h2></center></p><br>
<center><p>Ver detalle del registro.</p></center>
<?php
} 
?>
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