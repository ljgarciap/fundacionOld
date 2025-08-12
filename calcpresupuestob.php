<!DOCTYPE html>
<html lang="es" class="no-js">
<head>
<meta charset="utf-8">
</head>
<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["bda"]==true){
	
$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
$apellidosess=$_SESSION["apellido"];

$orientador="$nombresess"." "."$apellidosess";
	
include("menubda.html");
include_once('bas/conn.php');
$hoy = date("y-m-d");
$dia = "20$hoy"; 

$fechai=$_REQUEST['fechai'];
$fechaf=$_REQUEST['fechaf'];
$centro=$_REQUEST['centro'];

if($centro=='J'){
	$tabla='jorec';
	$nombre='CENTRO JOREC';	
}
else if($centro=='R'){
	$tabla='roca';
	$nombre='FUNDACIÓN JESÚS ES MI ROCA';
	}

//Acumulado de gastos entre fechas
/*
$query1="SELECT sum(r.valorsalida) as gastos FROM asientos a join $tabla r on a.idasientos=r.idasientos 
WHERE a.concepto IN ('REVISORIA FISCAL','ALIMENTACION RESIDENTES','GASOLINA GUADAÑA','ARRENDAMIENTO SEDE','PSICOLOGIA','CONTRATO TRANSPORTE','SERVICIO ENERGIA','SERVICIO GAS BOMBONA','COMIDA GALLINAS','GRAVAMEN FINANCIERO','CUOTA MANEJO TARJETA DEBITO','RETENCION EN LA FUENTE','OTROS','DIEZMOS','MANTENIMIENTO Y REPARACIONES','DOTACION','SUELDOS','PRIMA SERVICIOS','CESANTIAS','VACACIONES','APORTES PARAFISCALES','PEAJES','COMBUSTIBLE','PARQUEADERO','UTILES Y PAPELERIA') 
and a.fecha between '$fechai' and '$fechaf'";
*/

$query1="SELECT sum(r.valorsalida) as gastos FROM asientos a join $tabla r on a.idasientos=r.idasientos 
WHERE a.fecha between '$fechai' and '$fechaf'";
 
$result1=mysqli_query($con,"$query1");

		while ($resultx1 = mysqli_fetch_array($result1)) {
		$gastos=$resultx1['gastos'];
		}	

//Acumulado de abonos

$query3="SELECT sum(a.abono) as valor FROM abonopensiones a join cobrospension c on a.idcobrospension=c.idcobrospension join residentes r 
on c.idresidentes=r.idresidentes where abono>0 and r.nomfund='$nombre'  and r.estado='A' and (a.fechaabono between '$fechai' and '$fechaf')";
 
$result3=mysqli_query($con,"$query3");

		while ($resultx3 = mysqli_fetch_array($result3)) {
		$valor=$resultx3['valor'];
		}	

//echo $query3;

//Acumulado de pensiones activas

$query4="SELECT sum(c.valorcobro) as valor FROM cobrospension c join residentes r on c.idresidentes=r.idresidentes 
where r.nomfund='$nombre'  and r.estado='A'";
 
$result4=mysqli_query($con,"$query4");

		while ($resultx4 = mysqli_fetch_array($result4)) {
		$pensiones=$resultx4['valor'];
		}	

//echo $query3;
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
<CENTER><H2>RESUMEN <?php echo $nombre; ?> desde  <?php echo $fechai; ?> hasta  <?php echo $fechaf; ?></H2></CENTER>
<center><a href="simulacionb.php?fechai=<?php echo $fechai; ?>&fechaf=<?php echo $fechaf; ?>&nombre=<?php echo $nombre; ?>">Simulación</a></center><br>
<table class="table">
<tr><td>
<?php echo "Los ingresos suman: $valor"; ?>
</td><td>
<?php echo "Los gastos suman: $gastos"; ?>
</td><td>
<?php $rentabilidad=$valor-$gastos;
echo "La rentabilidad suma: $rentabilidad"; ?>
</td>
<td>
<?php 
echo "Las pensiones suman: $pensiones"; ?>
</td>
<td>
<?php $diezmo=intval(($rentabilidad*10)/100);
echo "El diezmo se estima en: $diezmo"; ?>
</td></tr>
</table>
<hr>
<!--Para editar desde este punto ojo-->
<div class="row">
<div class="col-md-6">
<b>Acumulados abonos</b>
<br><br>
<table class="table" border="1">
<?php
//Detallado abonos

$query2="SELECT distinct r.idresidentes FROM abonopensiones a join cobrospension c on a.idcobrospension=c.idcobrospension join residentes r 
on c.idresidentes=r.idresidentes where abono>0 and r.nomfund='$nombre' and r.estado='A' and (a.fechaabono between '$fechai' and '$fechaf') 
order by r.nombresr asc";

$result2=mysqli_query($con,"$query2");

		while ($resultx2 = mysqli_fetch_array($result2)) {
		$idresidentesa=$resultx2['idresidentes'];

$query2a="SELECT sum(a.abono) as abonos,r.nombresr,r.apellidosr FROM abonopensiones a join cobrospension c on a.idcobrospension=c.idcobrospension join residentes r on c.idresidentes=r.idresidentes where abono>0 and r.idresidentes='$idresidentesa' and (a.fechaabono between '$fechai' and '$fechaf')";

$result2a=mysqli_query($con,"$query2a");

		while ($resultx2a = mysqli_fetch_array($result2a)) {
		$abonos=$resultx2a['abonos'];
		$nombresra=$resultx2a['nombresr'];
		$apellidosra=$resultx2a['apellidosr'];
		
echo "<tr><td>$nombresra $apellidosra</td><td>$abonos</td></tr>";	
		}
	}	
	
//echo $query1;
//echo $query2;
?>
</table>
</div>
<div class="col-md-6">
<b>Acumulados gastos</b>
<br><br>
<table class="table" border="1">
<?php
//Detallado gastos
 
$query="SELECT distinct a.concepto FROM asientos a join $tabla r on a.idasientos=r.idasientos WHERE r.valorsalida>0 and a.fecha between '$fechai' and '$fechaf' order by a.concepto asc";

mysqli_set_charset($con,"utf8");

$result=mysqli_query($con,"$query");

		while ($resultx = mysqli_fetch_array($result)) {
		$concepto=$resultx['concepto'];
		
$querye="SELECT sum(valorsalida) as valorsalidas FROM asientos a join $tabla r on a.idasientos=r.idasientos 
WHERE r.valorsalida>0 and a.fecha between '$fechai' and '$fechaf' and a.concepto='$concepto' ";

$resulte=mysqli_query($con,"$querye");

		while ($resultxe = mysqli_fetch_array($resulte)) {
		$valorsalidas=$resultxe['valorsalidas'];
		
echo "<tr><td>$concepto</td><td>$valorsalidas</td></tr>";		
		}	
	}	

//echo $query;
//echo "<br>";
?>
</table>

</div>
</div>

<br><hr><br>

<div class="row">
<div class="col-md-6">
<b>Detallado abonos por concepto</b>
<br><br>
<table class="table" border="1">
<?php
//Para editar hasta este punto ojo

//Detallado abonos

$querya2="SELECT a.fechaabono,a.abono,a.comentario,r.nombresr,r.apellidosr,r.nomfund,r.idresidentes 
FROM abonopensiones a join cobrospension c on a.idcobrospension=c.idcobrospension join residentes r 
on c.idresidentes=r.idresidentes where abono>0 and r.nomfund='$nombre' and r.estado='A' and (a.fechaabono between '$fechai' and '$fechaf') 
order by r.nombresr asc";

$resulta2=mysqli_query($con,"$querya2");

		while ($resultxa2 = mysqli_fetch_array($resulta2)) {
		$aidresidentes=$resultxa2['idresidentes'];
		$anombresr=$resultxa2['nombresr'];
		$aapellidosr=$resultxa2['apellidosr'];
		$aabono=$resultxa2['abono'];
		$afechaabono=$resultxa2['fechaabono'];
		
echo "<tr><td>$afechaabono</td><td>$anombresr $aapellidosr</td><td>$aabono</td></tr>";	
		}	

//echo $query2;
?>
</table>
</div>
<div class="col-md-6">
<b>Detallado gastos por concepto</b>
<br><br>
<table class="table" border="1">
<?php
//Detallado gastos
 
$querya="SELECT * FROM asientos a join $tabla r on a.idasientos=r.idasientos 
WHERE r.valorsalida>0 and a.fecha between '$fechai' and '$fechaf' order by a.concepto,a.fecha asc";

mysqli_set_charset($con,"utf8");

$resulta=mysqli_query($con,"$querya");

		while ($resultxa = mysqli_fetch_array($resulta)) {
		$aidasientos=$resultxa['idasientos'];
		$aconcepto=$resultxa['concepto'];
		$avalorsalida=$resultxa['valorsalida'];
		$afecha=$resultxa['fecha'];
		
echo "<tr><td>$afecha</td><td>$aconcepto</td><td>$avalorsalida</td></tr>";		
		}	

//echo $query;
//echo "<br>";
?>
</table>

</div>
</div>

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