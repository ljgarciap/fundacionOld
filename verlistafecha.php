<?php
header ("Expires: Fri, 14 Mar 1980 20:53:00 GMT"); //la pagina expira en fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache"); //PARANOIA, NO GUARDAR EN CACHE 

include_once('bas/conn.php');
include("menutienda.html");

$fecha=$_GET['idresidentes'];

mysqli_set_charset($con,"utf8");
$hoy = date("y-m-d");
$fecham="20$hoy"; 
?>

<div class="container">
<div class="jumbotron">

<hr style="background: red; height: 3px; width: 100%; border: 0">
<?php
$ventadia=0;

$queryp="select * from venta join residentes on venta.idresidentes=residentes.idresidentes 
where venta.fecha='$fecha' order by fecha desc";	
$resultp=mysqli_query($con,$queryp);
while ($resultxp = mysqli_fetch_array($resultp)) {
$fechafra=$resultxp['fecha'];
$valorfra=$resultxp['valor'];
$idventa=$resultxp['idventa'];
//new
$acumpagofl=0;

$nompv=$resultxp['nombresr'];
$apv=$resultxp['apellidosr'];
$nomprov=$nompv." ".$apv;
$idresidentes=$resultxp['idresidentes'];
?>
<center><h2><?php echo "Fecha Venta: - ".$fechafra; ?></h2></center><br>
<center><h2><?php echo "Cliente: - ".$nomprov; ?></h2></center><br>
<center>
<div class="table-responsive">
<table class="display" cellspacing="0" width="100%">
<thead>
    <tr>
<th>Producto</th>
<th>Cantidad</th>
<th>Valor</th>
    </tr>
</thead>
<tbody>
<?php
$queryfl="select * from detalleventa join productos on detalleventa.idproductos=productos.idproductos where idventa='$idventa'";	
$resultfl=mysqli_query($con,$queryfl);

while ($resultxfl = mysqli_fetch_array($resultfl)) {
$producto=$resultxfl['detalle'];
$cantidad=$resultxfl['cantidad'];
$valorpago=$resultxfl['valor'];
$acumpagofl=$acumpagofl+$valorpago;
?>
<tr>
<td><?php echo "$producto"; ?></td>
<td><?php echo "$cantidad"; ?></td>
<td style="color:green;"><?php echo "$valorpago"; ?></td>
</tr>
<?php
}
?>
</tbody>
</table>
	<div class="row ui-widget" style="background:cyan;">
			<div class="col-md-6">
			<b>Resumen factura</b>	
			</div>	
			<div class="col-md-6">
			<b>Total: <?php echo $acumpagofl;?></b>			
			</div>		
	</div>
</div>
</center>
<br>
<hr style="background: red; height: 3px; width: 100%; border: 0">
<br>
<?php
$ventadia=$ventadia+$acumpagofl;
}
?>
	<div class="row ui-widget" style="background:yellow;">
			<div class="col-md-6">
			<b>Resumen dia</b>	
			</div>	
			<div class="col-md-6">
			<b>Total: <?php echo $ventadia;?></b>			
			</div>		
	</div>
</div>
</div>
<?php
include("footersadmin.html");
?>
