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

$fini=$_GET["fini"];
$ffin=$_GET["ffin"];
$diezmo=$_GET["diezmo"];

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
<form id="diezmo" action="abonod.php" method="post">
<div class="row">
<div class="col-md-5">
<?php
$query="select sum(abono) as positivo from pagodiezmos where fechaabono between '$fini' and '$ffin'";
$result=mysqli_query($con,"$query");
		while ($resultx = mysqli_fetch_array($result)) {
		$positivo=$resultx['positivo'];
		}
		
$total=($diezmo-$positivo);
if($total==0){
$mensaje="Pago al dia";	
?>
<h2><?php echo $mensaje; ?>.</h2>
<?php
}
else if($total>0){
$mensaje="Pago pendiente: $total";?>
<h2><?php echo $mensaje; ?>.</h2>
<?php
}
?>
</div>

<div class="col-md-4">
<label>Valor abono</label>
<input type="number" id="abono" name="abono" class="form-control input-sm chat-input"></input>
</div>
<div class="col-md-3">
<div class="wrapper">
<button type="submit" class="btn btn-default">Abonar</button>          
</div>
</div>
</div><br>
</form>
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