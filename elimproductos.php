<!DOCTYPE html>
<html lang="es" class="no-js">

<?php
header ("Expires: Fri, 14 Mar 1980 20:53:00 GMT"); //la pagina expira en fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache"); //PARANOIA, NO GUARDAR EN CACHE 
$idcolpatria=$_REQUEST['idt'];

include("menutienda.html");
include_once('bas/conn.php');

$idproveedores=$_REQUEST['idt'];

mysqli_set_charset($con,"utf8");
?>
<body>

<div class="container">
<div class="jumbotron">
<?php

$query2="update productos set estado='0' where idproductos='$idproveedores'";
$result2=mysqli_query($con,"$query2");

if($result2){
	echo "<br><br><br><br>";
	echo "<center><h1 style='color:red;'>";
	echo "Producto desactivado";
	echo "</center></h1>";
	echo "<br><br>";
	echo "<center><h1>";
	echo "<a href='tienda.php'>Inicio</a>";
	echo "</h1></center>";
}
?>
</div>
</div>

<?php	
include("footersadmin.html");
?>
</body>
</html>