<!DOCTYPE html>
<html lang="es">
<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["cajero"]==true){

$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
$apellidosess=$_SESSION["apellido"];

include("menucajero.html");
$fecha = date("y-m-d");
$hoy="20$fecha";

include_once('bas/conn.php');
mysqli_set_charset($con,"utf8");

$idfacturas=$_GET['idfacturas'];
?>
<body>
  <div class="container"> 
<div class="jumbotron">
<?php

$search="select * from venta join residentes on residentes.idresidentes=venta.idresidentes where idventa='$idfacturas'";
$resulta = mysqli_query($con,"$search");

if($resulta){

while ($resultx = mysqli_fetch_array($resulta)) {
$idfacturas=$resultx['idventa'];
$idresidentes=$resultx['idresidentes'];
$fecha=$resultx['fecha'];
$nombre=$resultx['nombresr'];
$apellido=$resultx['apellidosr'];
$valor=$resultx['valor'];

$queryur="select SUM(tienda.valorentrada) as valorentrada,
sum(tienda.valorsalida) as valorsalida from tienda join residentes on tienda.idresidentes=residentes.idresidentes where residentes.idresidentes=$idresidentes;";	

$result1r=mysqli_query($con,$queryur);

while ($resultxr = mysqli_fetch_array($result1r)) {
$entradas=$resultxr['valorentrada'];
$salidas=$resultxr['valorsalida'];
}

$saldo=$entradas-$salidas;
?>
<div class="row">
			<div class="col-md-12">
            <h2>Residente: <?php echo "$nombre $apellido<br>";?></h2>
            <br>
			</div>		
</div>
<hr>
<div class="row ui-widget" style="background:white;">
			<div class="col-md-4">
			<b>Resumen factura</b>	
			</div>	
			<div class="col-md-4">
			<b>Total Factura: <?php echo $valor;?></b>			
			</div>
			<div class="col-md-4">
			<b>Nuevo Saldo: <?php echo $saldo;?></b>			
			</div>			
</div>
<hr>
<?php
}
}else{
?>	
<p>Error en la base de datos.</p>
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