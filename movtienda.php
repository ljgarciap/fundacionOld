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
$idresidentes=$_REQUEST['idresidentes'];
$cuenta=$_REQUEST['cuenta'];
if($cuenta==1){
$tabla="colpatria";	
}
else if($cuenta==2){
$tabla="colombia";	
}
else{
$tabla="efectivo";	
}

mysqli_set_charset($con,"utf8");

$querr="select nombresr,apellidosr from residentes where idresidentes='$idresidentes'";
$resultr=mysqli_query($con,"$querr");
while ($resultxr = mysqli_fetch_array($resultr)) {
$nombresr=$resultxr['nombresr'];
$apellidosr=$resultxr['apellidosr'];
}
$detallec="Tienda de ".$nombresr." ".$apellidosr;

$entrada=$valor;
$salida=0;	

$query2="INSERT INTO tienda(fecha,valorentrada,valorsalida,idresidentes) 
VALUES('$fecha','$entrada','$salida','$idresidentes')";
$result2=mysqli_query($con,"$query2");



$query1="select acumulado from $tabla order by fecha DESC,id$tabla DESC LIMIT 1;";
$acum=0;
$result1=mysqli_query($con,"$query1");
while ($resultx = mysqli_fetch_array($result1)) {
$acum=$resultx['acumulado'];
}
$entrada=$valor;
$salida=0;	
$acumulado=($acum+$entrada-$salida);

$queryc2="INSERT INTO $tabla(fecha,concepto,valorentrada,valorsalida,acumulado) 
VALUES('$fecha','$detallec','$entrada','$salida','$acumulado')";
$resultc2=mysqli_query($con,"$queryc2");


if($result2){
	echo "<br><br><br><br>";
	echo "<center><h1 style='color:white;'>";
	echo "Movimiento completo";
	echo "</center></h1>";
	echo "<br><br>";
	echo "<center><h1>";
	echo "<a href='verlista.php?idresX=$idresidentes'>Verificar saldo</a>";
	echo "<br><br>";
	echo "<a href='movimientos.php'>Buscar nuevo residente</a>";
	echo "</h1></center>";
}

include("footersadmin.html");
?>
</body>
</html>