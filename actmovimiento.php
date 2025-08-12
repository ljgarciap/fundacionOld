<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["sadmin"]==true){
	
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
$idas=$_REQUEST['idas'];

mysqli_set_charset($con,"utf8");
$query="update asientos set fecha='$fecha',concepto='$concepto',detalle='$nombre',idtipologia='$tipologia' 
where idasientos='$idas'";
$result=mysqli_query($con,"$query");

$query1="select id$tablax as idt from $tablax where idasientos=$idas;";
$result1=mysqli_query($con,"$query1");
while ($resultx = mysqli_fetch_array($result1)) {
$idt=$resultx['idt'];
$idta=($idt-1);
}

$query2="select acumulado from $tablax where id$tablax=$idta;";
$result2=mysqli_query($con,"$query2");
while ($resultx2 = mysqli_fetch_array($result2)) {
$acum=$resultx2['acumulado'];
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

$query3="update $tablax set valorentrada='$entrada',valorsalida='$salida',acumulado='$acumulado' 
where idasientos='$idas'";
$result3=mysqli_query($con,"$query3");

$acump=0;	
$resultac=mysqli_query($con,"select asientos.idasientos as idasientos,$tablax.id$tablax as idtabla,fecha,concepto,detalle,valorentrada,valorsalida,acumulado from asientos join $tablax on asientos.idasientos=$tablax.idasientos order by fecha asc, id$tablax asc;");

while ($resultxac = mysqli_fetch_array($resultac)) {
$valoreac=$resultxac['valorentrada'];
$valorsac=$resultxac['valorsalida'];
$acumac=$resultxac['acumulado'];
$idmac=$resultxac['idasientos'];
$idtablaac=$resultxac['idtabla'];
$acump=(($acump+$valoreac)-$valorsac);
if($acump!=$acumac){
$queryac1="update $tablax set acumulado='$acump' where $tablax.id$tablax='$idtablaac'";
$resultac1=mysqli_query($con,"$queryac1");

}
}

header("Location:insertar.php");

include("footersadmin.html");
}
else {
header("Location:index.php");
}
?>
</body>
</html>