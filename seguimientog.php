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
$idresidentes=$_REQUEST['idresidentes'];
$fechar=$_REQUEST['fechar'];
$horar=$_REQUEST['colider'];
$nombrer=$_REQUEST['nombrer'];
$observaciones=$_REQUEST['observaciones'];
$compromiso="";
$sesion="";

foreach($_POST['fallas'] as $indice => $valor ) {
	  $compromiso=$compromiso." - ".$valor." ";
}

foreach($_POST['ayudas'] as $indice => $valor ) {
	  $sesion=$sesion." - ".$valor." ";
}

mysqli_set_charset($con,"utf8");

$query="INSERT INTO terapiac(fecha,colider,fallas,observaciones,ayudas,idresidentes) VALUES ('$fechar','$horar','$compromiso','$observaciones','$sesion','$idresidentes')";

$result=mysqli_query($con,"$query");
	
header("Location:terapeuta.php");
/* echo $query; */

include("footersadmin.html");
}
else {
header("Location:index.php");
}
?>