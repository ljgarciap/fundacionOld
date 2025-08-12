<!DOCTYPE html>
<html lang="es">

<?php
include("menutienda.html");
include_once('bas/conn.php');
mysqli_set_charset($con,"utf8");

$fecha = date("y-m-d");
$hoy="20$fecha";

$comercial=$_POST['comercial'];
$fabricante=$_POST['fabricante'];
$valorcompra=$_POST['valorcompra'];
$pvp=$_POST['pvp'];

$sql="INSERT INTO productos(detalle,valorcompra,valorventa,idproveedores,estado) 
VALUES ('$comercial','$valorcompra','$pvp','$fabricante','1')";	
$result = mysqli_query($con,$sql);

?>
<body>
  <div class="container"> 
<div class="jumbotron">
<br>
<?php
if($result){
?>
<center><h1>Producto creado</h1></center>
<div class="row">
			<div class="col-md-12">
            <h2><a href="product.php">Nuevo Producto</a></h2>
            <br>
			</div>		
</div>
<?php
}
else{
?>
<center><h2>No se creo el producto, verifique los datos</h2></center>
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