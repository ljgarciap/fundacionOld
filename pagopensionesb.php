<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["bda"]==true){
	
$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
$apellidosess=$_SESSION["apellido"];

include_once('bas/conn.php');
$hoy = date("y-m-d"); 
$fecha="20$hoy";
$idcobrospension=$_REQUEST['idcobrospension'];
$fechaa=$_REQUEST['fechaa'];
$valora=$_REQUEST['valora'];
$comentario=$_REQUEST['comentario'];

//se crea el residente con los datos y luego se crea el historial en este mismo archivo
mysqli_set_charset($con,"utf8");
$query="INSERT INTO abonopensiones(fechaabono,abono,comentario,idcobrospension) 
VALUES ('$fechaa','$valora','$comentario','$idcobrospension')";
$result=mysqli_query($con,"$query");
	
header("Location:pensionesb.php");
include("footersadmin.html");
}
else {
header("Location:index.php");
}
?>