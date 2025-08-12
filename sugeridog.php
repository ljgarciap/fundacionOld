<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["terg"]==true){
	
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
$area=$_REQUEST['area'];
$sesion=$_REQUEST['sesion'];
$idresidentes=$_REQUEST['idresidentes'];

if($nomfund=="FUNDACIÓN JESÚS ES MI ROCA"){$nf="F";}
else if($nomfund=="CENTRO JOREC"){$nf="J";}

//se crea el residente con los datos y luego se crea el historial en este mismo archivo

mysqli_set_charset($con,"utf8");
$query1="select idusuarios from usuarios where documento='$usuariosess'";
$result1=mysqli_query($con,"$query1");
while ($resultx1 = mysqli_fetch_array($result1)) {
$usuarioa=$resultx1['idusuarios'];
}

$query="INSERT INTO sugeridos(fecha,hora,sugerencia,idresidentes,idespecialista,idsugiere) VALUES ('$fechar','$horar','$sesion','$idresidentes','$usuarioa','$area')";

$result=mysqli_query($con,"$query");

header("Location:sugerg.php");
include("footersadmin.html");
}
else {
header("Location:index.php");
}
?>