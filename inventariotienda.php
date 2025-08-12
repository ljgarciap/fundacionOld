<?php
header ("Expires: Fri, 14 Mar 1980 20:53:00 GMT"); //la pagina expira en fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache"); //PARANOIA, NO GUARDAR EN CACHE 

include_once('bas/conn.php');
include("menutienda.html");

$hoy = date("y-m-d");
$fecham="20$hoy"; 
?>
<div id="preloader">
<br><br><br><br>
<center><img src="images/loader.gif" width="40%"/></center>
    <div id="loader">&nbsp;</div>
</div>

<div class="container">
<div class="jumbotron">
<center>

<div class="table-responsive">
<table id="tabla" class="display" cellspacing="0" width="100%">

<thead>
    <tr>
<th>Producto</th>
<th>Cantidad</th>
<th>Precio Venta</th>
<th>Proveedor</th>
    </tr>
</thead>
<tfoot>
    <tr>
<th>Producto</th>
<th>Cantidad</th>
<th>Precio Venta</th>
<th>Proveedor</th>
    </tr>
</tfoot>			

<tbody>

<?php
mysqli_set_charset($con,"utf8");
?>

<center><h2><a href="impinventario.php" target="new">Inventario actual</a></h2></center>

<?php
$queryu="select * from productos join proveedores on productos.idproveedores= proveedores.idproveedores where (proveedores.estado='1' and productos.estado='1')";	

$result1=mysqli_query($con,$queryu);

$total=0;

while ($resultax = mysqli_fetch_array($result1)) {
$idproductos=$resultax['idproductos'];	
$nombres=$resultax['detalle'];
$pvp=$resultax['valorventa'];
$proveedor=$resultax['nombre'];

$queryinv="SELECT SUM(cantidad) as inventario FROM detallepedido where idproductos='$idproductos'";
$resultinv=mysqli_query($con,$queryinv);
while ($resultainv = mysqli_fetch_array($resultinv)) {
$inventario=$resultainv['inventario'];	
}

$queryven="SELECT SUM(cantidad) as ventas FROM detalleventa where idproductos='$idproductos'";
$resultven=mysqli_query($con,$queryven);
while ($resultaven = mysqli_fetch_array($resultven)) {
$ventas=$resultaven['ventas'];	
}

$apellidos=$inventario-$ventas;
?>
<tr>
<td><?php echo $nombres; ?></td>
<td><?php echo $apellidos; ?></td>
<td><?php echo $pvp; ?></td>
<td><?php echo $proveedor; ?></td>
</tr>
<?php
}
?>
</tbody>

</table>
</div>
</center>

<script type="text/javascript">
$(window).load(function() {
	$('#preloader').fadeOut('slow');
	$('body').css({'overflow':'visible'});
})
</script>

</div>
</div>
<?php
include("footersadmin.html");
?>
