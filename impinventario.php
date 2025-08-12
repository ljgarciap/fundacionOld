<?php 
include_once('bas/conn.php');
?>

<html>
<head>
<script>
function imprimir(){
  window.print();
}
</script>
<style>
@media print{
  .oculto-impresion, .oculto-impresion *{
    display: none !important;
  }
}
</style>
<center>
<h2>Reporte de inventarios Fecha: <?php
        date_default_timezone_set('UTC');
        echo date("Y-m-d");
?><h2></center>
</head>
<body>

<center><br><form>
<button class="oculto-impresion" onclick="imprimir()">Imprimir</button>
</form></center>


<?php
mysqli_set_charset($con,"utf8");
?>

<center><h2>Inventario actual</h2>
<table id="tabla" border="1" cellspacing="0" width="80%">

<thead>
    <tr>
<th>Producto</th>
<th>Inv Inicial</th>
<th>Inv Final</th>
    </tr>
</thead>

<tbody>

<?php
$queryu="select * from productos join proveedores on productos.idproveedores= proveedores.idproveedores where (proveedores.estado='1' and productos.estado='1')";	

$result1=mysqli_query($con,$queryu);

$total=0;

while ($resultax = mysqli_fetch_array($result1)) {
$idproductos=$resultax['idproductos'];	
$nombres=$resultax['detalle'];

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
<td><center><?php echo $apellidos; ?></center></td>
<td></td>
</tr>
<?php
}
?>
</tbody>
</table>
</center>
</body>
</html>