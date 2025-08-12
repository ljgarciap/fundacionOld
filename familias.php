<!DOCTYPE html>
<html lang="es" class="no-js">

<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["planta"]==true){
	
$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];

include("menuplanta.html");
include_once('bas/conn.php');
mysqli_set_charset($con,"utf8");

$fecha=$_REQUEST['fecha'];
$resumen=$_REQUEST['resumen'];
$idresidentes=$_REQUEST['idresidentes'];
?>
<body>

<div class="container">
<div class="jumbotron">

<?php
mysqli_set_charset($con,"utf8");

$query="INSERT INTO familias(fecha,mensaje,idresidentes) 
VALUES ('$fecha','$resumen','$idresidentes')";

$result=mysqli_query($con,"$query");

if($result){
echo "<center><h1>Reporte realizado</h1></center>";		
}
else{
echo "<center><h1>Oops, algo salió mal</h1></center>";
}
?>
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