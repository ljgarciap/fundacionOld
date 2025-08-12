<!DOCTYPE html>
<html lang="es" class="no-js">

<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["sadmin"]==true){
	
$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];

include("menusadmin.html");
include_once('bas/conn.php');
mysqli_set_charset($con,"utf8");

$abono=$_POST["abono"];
$valor=$abono;

$hoy = date("y-m-d"); 
?>

<style>
.wrapper {
    text-align: center;
}
.btn{
	background-color:#941524;
	border-color:transparent;
	color:white;
	font-size:1.5em;
}
.btn:hover{
	background-color:#523a18;
	border-color:transparent;
	color:white;
}
</style>

<body>

<div class="container">
<div class="jumbotron">
<center><h2>Abono al diezmo</h2></center><br>
<?php
$query0="INSERT into pagodiezmos(fechaabono,abono) values('20$hoy','$abono')";

$query="INSERT INTO asientos(fecha,concepto,detalle,idtipologia) 
VALUES('20$hoy','DIEZMO','','2')";
$result=mysqli_query($con,"$query");

$idmovimientos=mysqli_insert_id($con);

$query1="select acumulado from roca order by idroca DESC LIMIT 1;";
$result1=mysqli_query($con,"$query1");
while ($resultx = mysqli_fetch_array($result1)) {
$acum=$resultx['acumulado'];
}
$entrada=0;
$salida=$valor;
$acumulado=($acum+$entrada-$salida);
$query2="INSERT INTO roca(valorentrada,valorsalida,acumulado,idasientos) 
VALUES('$entrada','$salida','$acumulado','$idmovimientos')";
$result2=mysqli_query($con,"$query2");

$acump=0;	
$resultac=mysqli_query($con,"select asientos.idasientos as idasientos,roca.idroca as idtabla,fecha,concepto,detalle,valorentrada,valorsalida,acumulado from asientos join roca on asientos.idasientos=roca.idasientos order by fecha asc, idroca asc;");

while ($resultxac = mysqli_fetch_array($resultac)) {
$fechamac=$resultxac['fecha'];
$conceptmac=$resultxac['concepto'];
$detalmac=$resultxac['detalle'];
$valoreac=$resultxac['valorentrada'];
$valorsac=$resultxac['valorsalida'];
$acumac=$resultxac['acumulado'];
$idmac=$resultxac['idasientos'];
$idtablaac=$resultxac['idtabla'];
$acump=(($acump+$valoreac)-$valorsac);
$queryac1="update roca set acumulado='$acump' where roca.idasientos='$idmac'";
$resultac1=mysqli_query($con,"$queryac1");
}
echo "<br>";
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