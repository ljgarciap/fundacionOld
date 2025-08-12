<?php
header ("Expires: Fri, 14 Mar 1980 20:53:00 GMT"); //la pagina expira en fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache"); //PARANOIA, NO GUARDAR EN CACHE 

include_once('bas/conn.php');
include("menutienda.html");

$fecha=$_REQUEST['fecha'];
$tipologia=$_REQUEST['tipologia'];
$valor=$_REQUEST['valor'];
$observaciones=$_REQUEST['obs'];
$idpagoproveedores=$_REQUEST['idpagoproveedores'];
$idproveedores=$_REQUEST['idproveedores'];

if($tipologia==1){
$entrada=$valor;
$salida=0;	
}
else if($tipologia==2){
$entrada=0;
$salida=$valor;
}

mysqli_set_charset($con,"utf8");

$query2="update pagoproveedores set fecha='$fecha',valorentrada='$entrada',valorsalida='$salida',observaciones='$observaciones' where idpagoproveedores='$idpagoproveedores'";
$result2=mysqli_query($con,"$query2");

if($result2){
	echo "<br><br><br><br>";
	echo "<center><h1 style='color:white;'>";
	echo "Movimiento completo";
	echo "</center></h1>";
	echo "<br><br>";
	echo "<center><h1>";
	echo "<a href='verlistap.php?idresX=$idproveedores'>Verificar saldo</a>";
	echo "<br><br>";
	echo "<a href='tienda.php'>Inicio</a>";
	echo "</h1></center>";
}

include("footersadmin.html");
?>
</body>
</html>