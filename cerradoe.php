<!DOCTYPE html>
<html lang="es">

<?php
$fecha = date("y-m-d");
$hoy="20$fecha";

include("menutienda.html");
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
			<div class="col-md-4">
            <h2>Residente: <?php echo "$nombre $apellido<br>";?></h2>
            <br>
			</div>		
			<div class="col-md-4">
			<h2><b>Resumen factura</b></h2>	
			</div>	
			<div class="col-md-4">
			<h2><b>Total Factura: <?php echo $valor;?></b></h2>			
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

</body>

<?php	
include("footersadmin.html");
?>
</body>
</html>