<!DOCTYPE html>
<html lang="es">

<?php
include("menutienda.html");
include_once('bas/conn.php');
mysqli_set_charset($con,"utf8");

$fecha = date("y-m-d");
$hoy="20$fecha";
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
  <div class="container"><br>
<div class="jumbotron">
<center><h2>Producto Nuevo</h2></center>
		<form id="crearprod" action = "crearprod.php" method = "post">
		
<div class="row ui-widget">	
<div class="col-md-4">
<label for="comercial">Nombre comercial</label><br>
<input type="text" id="comercial" name="comercial" class="form-control input-sm chat-input" placeholder="Nombre comercial del producto" required/>
</div>	
<div class="col-md-4">
<label for="fabricante">Proveedor</label>
<select id="fabricante" name="fabricante" class="form-control input-sm chat-input">
<?php
$result1=mysqli_query($con,"select * from proveedores where estado='1' order by nombre asc");
while ($resultx = mysqli_fetch_array($result1)) {
$idfabricante=$resultx['idproveedores'];
$nomfabricante=$resultx['nombre'];
?>
<option value="<?php echo $idfabricante;?>"><?php echo $nomfabricante;?></option>
<?php
}
?>
</select></br>
	</div>
			<div class="col-md-2">
			<label for="valorcompra">Valor compra</label>
			<input type="number" id="valorcompra" name="valorcompra" class="form-control input-sm chat-input" placeholder="Valor compra" required/>
            </br>
			</div>	
			<div class="col-md-2">
			<label for="pvp">Precio venta</label>
			<input type="number" id="pvp" name="pvp" class="form-control input-sm chat-input" placeholder="Precio venta" required/>
            </br>
			</div>
</div>
            <div class="wrapper">
			<button type="submit" class="btn btn-primary">Crear</button>          
            </div>
			</form>
</div>
</div>
<?php	
include("footersadmin.html");
?>
</body>
</html>