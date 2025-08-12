<!DOCTYPE html>
<html lang="es" class="no-js">
<head>
<meta charset="utf-8">
</head>
<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["sadmin"]==true){
	
$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];

include("menusadmin.html");
include_once('bas/conn.php');
mysqli_set_charset($con,"utf8");

$hoy = date("y-m-d");
$fecham="20$hoy"; 

$yhoy=date("y");
$mhoy=date("m");
$dhoy=date("d");
$mhoy=($mhoy-1);
$fechamin="20$yhoy-$mhoy-$dhoy";

$fechai=$_REQUEST['fechai'];
$fechaf=$_REQUEST['fechaf'];
$nombre=$_REQUEST['nombre'];

if($nombre=='CENTRO JOREC'){
	$tabla='jorec';	
}
else{
	$tabla='roca';
	}

$queryt="SELECT sum(valorsalida) as valorsalidas FROM asientos a join $tabla r on a.idasientos=r.idasientos 
WHERE r.valorsalida>0 and a.fecha between '$fechai' and '$fechaf' ";

$resultt=mysqli_query($con,"$queryt");

		while ($resultxt = mysqli_fetch_array($resultt)) {
		$valort=$resultxt['valorsalidas'];
		}

$queryc="SELECT c.valorcobro FROM residentes r join cobrospension c on r.idresidentes=c.idresidentes where r.nomfund='$nombre' and r.estado='A' ";

$resultc=mysqli_query($con,"$queryc");
$valorr=0;

		while ($resultcx = mysqli_fetch_array($resultc)) {
		$valorcobro=$resultcx['valorcobro'];
		$valorr=($valorr+$valorcobro);
		}

$dif=($valorr-$valort);
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
<center><b>Diferencia a ajustar : <input name="diferencia" id="diferencia" value="<?php echo $dif; ?>" readonly></input></b></center>
<br>
<div class="row">
<div class="col-md-6">
<b>Acumulados gastos</b> : <input name="total" id="total" value="<?php echo $valort; ?>" readonly></input>
<br><br>

<table class="table" border="1">
<?php
$query="SELECT distinct a.concepto FROM asientos a join $tabla r on a.idasientos=r.idasientos WHERE r.valorsalida>0 and a.fecha between '$fechai' and '$fechaf' order by a.concepto asc";

$result=mysqli_query($con,"$query");
mysqli_set_charset($con,"utf8");

echo "<tr><td>Valores adicionales</td><td><input value='0' class='importe_linea' onKeyUp='calcular_total()'></input></td></tr>";	

		while ($resultx = mysqli_fetch_array($result)) {
		$concepto=$resultx['concepto'];
		
$querye="SELECT sum(valorsalida) as valorsalidas FROM asientos a join $tabla r on a.idasientos=r.idasientos 
WHERE r.valorsalida>0 and a.fecha between '$fechai' and '$fechaf' and a.concepto='$concepto' ";

$resulte=mysqli_query($con,"$querye");
		
		while ($resultxe = mysqli_fetch_array($resulte)) {
		$valorsalidas=$resultxe['valorsalidas'];
		echo "<tr><td>$concepto</td><td><input value='$valorsalidas' class='importe_linea' onKeyUp='calcular_total()'></input></td></tr>";		
		}	
	}	
//echo $queryt;
//echo $query2;
?>
</table>
<br>
<b>Acumulados gastos</b> : <input name="total2" id="total2" value="<?php echo $valort; ?>" readonly></input>
</div>

<div class="row">
<div class="col-md-6">
<b>Estimado residentes</b> : <input name="totalr" id="totalr" value="<?php echo $valorr; ?>" readonly></input>
<br><br>

<table class="table" border="1">
<?php
echo "<tr><td>Adicionales</td><td><input value='0' class='importe_linea2' onKeyUp='calcular_total2()'></input></td></tr>";
$query="SELECT r.nombresr,r.apellidosr,r.idresidentes,c.valorcobro FROM residentes r join cobrospension c on r.idresidentes=c.idresidentes where r.nomfund='$nombre' and r.estado='A' ";

$result=mysqli_query($con,"$query");

		while ($resultx = mysqli_fetch_array($result)) {
		$valorcobro=$resultx['valorcobro'];
		$nombresr=$resultx['nombresr'];
		$apellidosr=$resultx['apellidosr'];
echo "<tr><td>$nombresr $apellidosr</td><td><input value='$valorcobro' class='importe_linea2' onKeyUp='calcular_total2()'></input></td></tr>";		
		}	
		
//echo $query2;
?>
</table>
<br>
<b>Estimado residentes</b> : <input name="totalr2" id="totalr2" value="<?php echo $valorr; ?>" readonly></input>
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

<script type='text/javascript'>
function calcular_total() {
	importe_total = 0
	$(".importe_linea").each(
		function(index, value) {
			importe_total = importe_total + eval($(this).val());
		}
	);
	$("#total").val(importe_total);
	$("#total2").val(importe_total);
	
	var entradas=document.getElementById("totalr").value;
	var salidas=document.getElementById("total").value;
	var diferencia=(entradas-salidas);

	if(diferencia<0){
	document.getElementById("diferencia").style.color = "red";
	}
	else{
	document.getElementById("diferencia").style.color = "green";	
	}
	
	$("#diferencia").val(diferencia);
}
</script>

<script type='text/javascript'>
function calcular_total2() {
	importe_total2 = 0
	$(".importe_linea2").each(
		function(index, value) {
			importe_total2 = importe_total2 + eval($(this).val());
		}
	);
	$("#totalr").val(importe_total2);
	$("#totalr2").val(importe_total2);

	
	var entradas=document.getElementById("totalr").value;
	var salidas=document.getElementById("total").value;
	var diferencia=(entradas-salidas);

	if(diferencia<0){
	document.getElementById("diferencia").style.color = "red";
	}
	
	$("#diferencia").val(diferencia);
}
 
function nueva_linea() {
	$("#lineas").append('<input type="text" class="importe_linea" value="0"/><br/>');
}
</script>

</body>
</html>