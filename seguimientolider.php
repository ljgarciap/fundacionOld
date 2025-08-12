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
$compromiso=$_REQUEST['compromiso'];
$sesion=$_REQUEST['sesion'];
$tarea=$_REQUEST['tarea'];
$idresidentes=$_REQUEST['idresidentes'];

if($nomfund=="FUNDACIÓN JESÚS ES MI ROCA"){$nf="F";}
else if($nomfund=="CENTRO JOREC"){$nf="J";}

//se crea el residente con los datos y luego se crea el historial en este mismo archivo

mysqli_set_charset($con,"utf8");

$query="INSERT INTO terapialider(fecha,hora,evaluacion,trabajo,tarea,idresidentes) VALUES ('$fechar','$horar','$compromiso','$sesion','$tarea','$idresidentes')";

$result=mysqli_query($con,"$query");
	
header("Location:lider.php");
include("footersadmin.html");
}
else {
header("Location:index.php");
}
?>