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
<center><h2>Calculo del diezmo</h2></center><br>
<form id="diezmo" action="diezmo.php" method="post">
<div class="row">
<div class="col-md-6">
<label>Fecha inicial:</label>
<input type="date" id="fechaini" name="fechaini" class="form-control input-sm chat-input"></input>
</div>
<div class="col-md-6">
<label>Fecha final:</label>
<input type="date" id="fechafin" name="fechafin" class="form-control input-sm chat-input"></input>
</div>
</div><br>
<center>
<div class="wrapper">
<button type="submit" class="btn btn-default">Calcular</button>          
</div>
</center>
</form>
<?php
if (isset($_POST["fechaini"]) && !empty($_POST["fechafin"])){
$fechaini=$_POST["fechaini"];
$fechafin=$_POST["fechafin"];	

$query="select sum(roca.valorentrada) as positivo from roca join asientos on roca.idasientos=asientos.idasientos 
where valorentrada!='0' and asientos.fecha between '$fechaini' and '$fechafin'";
$result=mysqli_query($con,"$query");
		while ($resultx = mysqli_fetch_array($result)) {
		$positivo1=$resultx['positivo'];
		}
$query2="select sum(roca.valorsalida) as negativo from roca join asientos on roca.idasientos=asientos.idasientos 
where valorsalida!='0' and asientos.fecha between '$fechaini' and '$fechafin'";
$result2=mysqli_query($con,"$query2");
		while ($resultx2 = mysqli_fetch_array($result2)) {
		$negativo1=$resultx2['negativo'];
		}
		
$query1="select sum(jorec.valorentrada) as positivo from jorec join asientos on jorec.idasientos=asientos.idasientos 
where valorentrada!='0' and asientos.fecha between '$fechaini' and '$fechafin'";
$result1=mysqli_query($con,"$query1");
		while ($resultx1 = mysqli_fetch_array($result1)) {
		$positivo2=$resultx1['positivo'];
		}
$query3="select sum(jorec.valorsalida) as negativo from jorec join asientos on jorec.idasientos=asientos.idasientos 
where valorsalida!='0' and asientos.fecha between '$fechaini' and '$fechafin'";
$result3=mysqli_query($con,"$query3");
		while ($resultx3 = mysqli_fetch_array($result3)) {
		$negativo2=$resultx3['negativo'];
		}		
$positivo=($positivo1+$positivo2);
//$negativo=($negativo1+$negativo2);	
//$total=($positivo-$negativo);
$total=$positivo;
$diezmo=(($total*10)/100);
?>
<br><h3>En el intervalo de fechas entre <?php echo $fechaini; ?> y <?php echo $fechafin; ?> hay unos ingresos de <?php echo $positivo; ?>
<!-- y unos egresos de <?php echo $negativo; ?> para un total de <?php echo $total; ?>-->.<br>El diezmo para este intervalo de fechas es de <?php echo $diezmo; ?>.</h3><br>
<h2><a href="diezm.php?fini=<?php echo $fechaini;?>&ffin=<?php echo $fechafin;?>&diezmo=<?php echo $diezmo;?>">Realizar abono.</a></h2>
<?php	
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