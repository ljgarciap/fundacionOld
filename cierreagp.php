<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["planta"]==true){
	
$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
$apellidosess=$_SESSION["apellido"];

$orientador="$nombresess"." "."$apellidosess";

include_once('bas/conn.php');
$idcobro=$_REQUEST['idcobro'];
$valorinicial=$_REQUEST['valorinicial'];

//se crea el residente con los datos y luego se crea el historial en este mismo archivo
mysqli_set_charset($con,"utf8");
$query="update agenda set estado='$valorinicial' where idagenda='$idcobro'";
/*echo $query;*/
$result=mysqli_query($con,"$query");
	
header("Location:agendp.php");

include("footersadmin.html");
}
else {
header("Location:index.php");
}
?>