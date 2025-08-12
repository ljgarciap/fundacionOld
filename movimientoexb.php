<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["bda"]==true){
	
$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
$apellidosess=$_SESSION["apellido"];

include_once('bas/conn.php');
$fecha=$_REQUEST['fecha'];
$concepto=$_REQUEST['concepto'];
$nombre=$_REQUEST['nombre'];
$tipologia=$_REQUEST['tipologia'];
$valor=$_REQUEST['valor'];
$tablax=$_REQUEST['tablax'];

mysqli_set_charset($con,"utf8");
$query="INSERT INTO asientosex(fecha,concepto,detalle,idtipologia) 
VALUES('$fecha','$concepto','$nombre','$tipologia')";
$result=mysqli_query($con,"$query");

$idmovimientos=mysqli_insert_id($con);

$query1="select acumulado from $tablax order by id$tablax DESC LIMIT 1;";
$result1=mysqli_query($con,"$query1");
while ($resultx = mysqli_fetch_array($result1)) {
$acum=$resultx['acumulado'];
}
if($tipologia==1){
$entrada=$valor;
$salida=0;	
}
else if($tipologia==2){
$entrada=0;
$salida=$valor;
}
$acumulado=($acum+$entrada-$salida);
$query2="INSERT INTO $tablax(valorentrada,valorsalida,acumulado,idasientosex) 
VALUES('$entrada','$salida','$acumulado','$idmovimientos')";
$result2=mysqli_query($con,"$query2");

$acump=0;	
$resultac=mysqli_query($con,"select asientosex.idasientosex as idasientos,$tablax.id$tablax as idtabla,fecha,concepto,detalle,valorentrada,valorsalida,acumulado from asientosex join $tablax on asientosex.idasientosex=$tablax.idasientosex order by fecha asc, id$tablax asc;");

while ($resultxac = mysqli_fetch_array($resultac)) {
$fechamac=$resultxac['fecha'];
$conceptmac=$resultxac['concepto'];
$detalmac=$resultxac['detalle'];
$valoreac=$resultxac['valorentrada'];
$valorsac=$resultxac['valorsalida'];
$acumac=$resultxac['acumulado'];
$idmac=$resultxac['idasientosex'];
$idtablaac=$resultxac['idtabla'];
$acump=(($acump+$valoreac)-$valorsac);
$queryac1="update $tablax set acumulado='$acump' where $tablax.idasientosex='$idmac'";
$resultac1=mysqli_query($con,"$queryac1");
}

header("Location:yuly.php");

include("footersadmin.html");
}
else {
header("Location:index.php");
}
?>
</body>
</html>