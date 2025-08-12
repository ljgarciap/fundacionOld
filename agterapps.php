<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["sadmin"]==true){
	
$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
$apellidosess=$_SESSION["apellido"];

$orientador="$nombresess"." "."$apellidosess";

include_once('bas/conn.php');
$hoy = date("y-m-d"); 
$nomfund=$_REQUEST['nomfund'];
$fechar=$_REQUEST['fechar'];
$horar=$_REQUEST['horar'];
$nombrer=$_REQUEST['nombrer'];
$idresidentes=$_REQUEST['idresidentes'];

//se crea el residente con los datos y luego se crea el historial en este mismo archivo

mysqli_set_charset($con,"utf8");

$query="INSERT INTO agenda(fecha,hora,encargado,idresidentes) 
VALUES('$fechar','$horar','$nomfund','$idresidentes')";

$result=mysqli_query($con,"$query");
	
header("Location:terapps.php");
include("footersadmin.html");
}
else {
header("Location:index.php");
}
?>