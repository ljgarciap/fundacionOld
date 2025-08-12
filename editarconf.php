<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["sadmin"]==true){
	
$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
$apellidosess=$_SESSION["apellido"];

include_once('bas/conn.php');
$hoy = date("y-m-d"); 
$fecha="20$hoy";
$observaciones=$_REQUEST['observaciones'];
$ayudas=$_REQUEST['ayudas'];
$idterapias=$_REQUEST['idterapias'];

//se crea el residente con los datos y luego se crea el historial en este mismo archivo
mysqli_set_charset($con,"utf8");
$query="update terapiac set observaciones='$observaciones',ayudas='$ayudas' where idterapiac='$idterapias'";
echo $query;
$result=mysqli_query($con,"$query");
header("Location:rconf.php");

include("footersadmin.html");
}
else {
header("Location:index.php");
}
?>