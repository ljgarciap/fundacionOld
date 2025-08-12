<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["planta"]==true){
	
$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
$apellidosess=$_SESSION["apellido"];

$iduser=$_SESSION["cons"];

$orientador="$nombresess"." "."$apellidosess";

include_once('bas/conn.php');
$hoy = date("y-m-d"); 
$nomfund=$_REQUEST['nomfund'];
$fechar=$_REQUEST['fechar'];
$horar=$_REQUEST['horar'];
$nombrer=$_REQUEST['nombrer'];
$area=$_REQUEST['area'];
$sesion=$_REQUEST['sesion'];
$idresidentes=$_REQUEST['idresidentes'];

//se crea el residente con los datos y luego se crea el historial en este mismo archivo

mysqli_set_charset($con,"utf8");

$query="INSERT INTO sugeridos(fecha,hora,sugerencia,idresidentes,idespecialista,idsugiere) 
VALUES ('$fechar','$horar','$sesion','$idresidentes','$iduser','$area')";

$result=mysqli_query($con,"$query");

header("Location:sugerp.php");
include("footersadmin.html");
}
else {
header("Location:index.php");
}
?>