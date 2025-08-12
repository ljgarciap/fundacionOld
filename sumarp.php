<!DOCTYPE html>
<html lang="es">

<?php
include("menutienda.html");
include_once('bas/conn.php');
mysqli_set_charset($con,"utf8");

if (isset($_GET['indicador']))
{
$flag=$_GET['indicador'];
$idproductos=$_GET['idproductos'];
$cantidad=$_GET['cantidad'];
$precio=$_GET['precio'];
$idpedidos=$_GET['idpedido'];
$facturax=$_GET['facturax'];
$importe=($cantidad*$precio);

$sqlxr="UPDATE detallepedido SET idproductos='$idproductos',cantidad='$cantidad',valor='$importe' WHERE iddetallepedido='$flag'";
$resultxr = mysqli_query($con,$sqlxr);
}
else{
$idproductos=$_POST['idproductos'];
$idpedidos=$_POST['idpedidos'];
$cantidad=$_POST['cantidadp'];
$importe=$_POST['importep'];
$facturax=$_POST['facturax'];

$sql="INSERT INTO detallepedido(idproductos,cantidad,valor,idpedidos) 
VALUES ('$idproductos','$cantidad','$importe','$idpedidos')";	

$result = mysqli_query($con,"$sql");
$rs = mysqli_query($con,"SELECT @@identity AS id");
if ($row = mysqli_fetch_row($rs)) {
$idcl = trim($row[0]);
}
}
?>
<body>
  <div class="container"> 
<div class="jumbotron">
<?php
$search="select * from pedidos join proveedores on proveedores.idproveedores=pedidos.idproveedores where idpedidos='$idpedidos'";
$resulta = mysqli_query($con,"$search");

if($resulta){
while ($resultx = mysqli_fetch_array($resulta)) {
$nidpedidos=$resultx['idpedidos'];
$nfecha=$resultx['fecha'];
$nfactura=$resultx['documento'];
$nvalor=$resultx['valor'];
$razonsocial=$resultx['nombre'];
$idproveedores=$resultx['idproveedores'];
?>
<div class="row">
			<div class="col-md-4">
			<h2>Fecha : <?php echo "$nfecha";?></h2>
            <br>			
			</div>
			<div class="col-md-4">
			<h2>Factura # <?php echo "$nfactura";?></h2>
            <br>			
			</div>
			<div class="col-md-4"><br>
            Proveedor: <?php echo "$razonsocial<br>";?>
            <br>
			</div>		
</div>
<p>	
    <form id="sumar" action = "sumarp.php" method = "post" >
		<div class="row ui-widget" id="suma">
			<div class="col-md-3">
			<label for="comercialp">Nombre</label>
<select id="idproductos" name="idproductos" class="form-control input-sm chat-input">
<?php
$selectciudad=mysqli_query($con,"select * FROM productos where idproveedores='$idproveedores' order by detalle asc");
		while ($resultc = mysqli_fetch_array($selectciudad)) {
		$idproductos=$resultc['idproductos'];
		$detalle=$resultc['detalle'];
		$valorventa=$resultc['valorventa'];
		
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

$stock=$inventario-$ventas;
		echo "<option value='$idproductos'>$detalle | $stock disponibles | $$valorventa</option>";
		}
?>
</select>			
			</div>	
			<div class="col-md-2">
			<label for="cantidadp">Cantidad</label>
			<input type="number" step="0.01" min="0" id="cantidadp" name="cantidadp" class="form-control input-sm chat-input"  value="" required/>
            <br>
			</div>
			<div class="col-md-2">
			<label for="preciop">Precio </label>
			<input type="number" id="preciop" name="preciop" class="form-control input-sm chat-input" required/>
            <br>
			</div>
			<div class="col-md-2">
			<label for="importep">Total </label>
			<input type="number" id="importep" name="importep" class="form-control input-sm chat-input" value="" required/>
            <br>
			</div>
<input type="hidden" id="idpedidos" name="idpedidos" value="<?php echo "$idpedidos";?>">
<input type="hidden" id="facturax" name="facturax" value="<?php echo "$facturax";?>">    
            <div class="col-md-2"><br>
			<button type="submit" class="btn btn-primary">Añadir</button>          
            </div>			
			</form>
</div>		
</p>
<hr>
<?php
}
}else{
?>	
<p>Error en la base de datos.</p>
<?php	
}

?>

<div class="table-responsive" style="background:white;">
<p>&nbsp;Productos añadidos</p>
<table class="display" cellspacing="0" width="100%">
<thead>
<tr>
<th>Producto</th>	
<th>Cant</th>
<th>Precio</th>
<th>Total</th>
<th>Editar</th>
</tr>
</thead>
<tbody>
<?php
$totales="select productos.idproductos as idpr, productos.detalle as actividadx, productos.valorcompra as preciox, detallepedido.cantidad as medicionx, detallepedido.valor as importeclientex, detallepedido.iddetallepedido as indicador, detallepedido.idpedidos as idfra  from detallepedido join productos on detallepedido.idproductos=productos.idproductos where detallepedido.idpedidos='$nidpedidos'";

$totalimpcli=0;

$resultax = mysqli_query($con,$totales);

while ($resultxs = mysqli_fetch_array($resultax)) {
$idpr=$resultxs['idpr'];
$idfra=$resultxs['idfra'];
$actividadx=$resultxs['actividadx'];
$udsx=$resultxs['medicionx'];
$preciox=$resultxs['preciox'];
$importex=$resultxs['importeclientex'];
$indicador=$resultxs['indicador'];
?>
<form id="sumar2" action = "sumarp.php" method = "get" >
<tr>
<td>
<select id="idproductos" name="idproductos">
<option value="<?php echo $idpr;?>"><?php echo $actividadx;?></option>
<?php
$selcx="select * FROM productos where idproveedores='$idproveedores' order by detalle asc";
$selectciudadx=mysqli_query($con,$selcx);
		while ($resultcx = mysqli_fetch_array($selectciudadx)) {
		$idprx=$resultcx['idproductos'];
		$detalle=$resultcx['detalle'];
		$valorventa=$resultcx['valorventa'];
	
$queryinv="SELECT SUM(cantidad) as inventario FROM detallepedido where idproductos='$idprx'";
$resultinv=mysqli_query($con,$queryinv);
while ($resultainv = mysqli_fetch_array($resultinv)) {
$inventario=$resultainv['inventario'];	
}

$queryven="SELECT SUM(cantidad) as ventas FROM detalleventa where idproductos='$idprx'";
$resultven=mysqli_query($con,$queryven);
while ($resultaven = mysqli_fetch_array($resultven)) {
$ventas=$resultaven['ventas'];	
}

$stock=$inventario-$ventas;
		echo "<option value='$idprx'>$detalle | $stock disponibles | $$valorventa</option>";
		}
?>
</select>
</td><!--Detalle-->
<td><input type="number" id="cantidad" name="cantidad" class="form-control input-sm chat-input" value="<?php echo $udsx;?>"/></td><!--Cantidad-->
<td><input type="number" id="precio" name="precio" class="form-control input-sm chat-input" value="<?php echo $preciox;?>"/></td><!--Precio-->
<td><input type="number" id="total" name="total" class="form-control input-sm chat-input" value="<?php echo $importex;?>"/></td><!--Cantidad-->
<input type="hidden" id="indicador" name="indicador" value="<?php echo "$indicador";?>">
<input type="hidden" id="idpedido" name="idpedido" value="<?php echo "$idfra";?>">
<input type="hidden" id="facturax" name="facturax" value="<?php echo "$facturax";?>">
<td><button type="submit" class="btn btn-danger">Editar</button></td>          
</tr>			
</form>
<?php	
$totalimpcli=$totalimpcli+$importex;
}//fin for
?>
</tbody>
</table>
</div>
<hr>
	<div class="row ui-widget" style="background:cyan;">
			<div class="col-md-4">
			<b>Resumen pedido</b>	
			</div>	
			<div class="col-md-3">
			<b>Total: <?php echo $totalimpcli;?></b>			
			</div>	
			<div class="col-md-2">
			<?php $url="cerrarp.php?idproyectos=$nidpedidos&totalimportecl=$totalimpcli&factura=$facturax";?>
			<a href="<?php echo $url;?>"><button type="button" class="btn btn-danger">Finalizar</button></a>
			</div>			
	</div>

</div>
</div>

    <script type='text/javascript'>
        // Cada vez que se pulse una tecla, controlamos que sea numerica
        $("#suma input").keypress(function(event) {
            //obtenemos la tecla pulsada
            var valueKey=String.fromCharCode(event.which);
            //obtenemos el valor ascii de la tecla pulsada
            var keycode=event.which;
            
            // Si NO pulsamos un numero, un punto, la tecla suprimir
            // la tecla backspace o el simobolo "-" (45), cancelamos la pulsacion
            if(valueKey.search('[0-9|\.]')!=0 && keycode!=8 && keycode!=46 && keycode!=45)
            {
                // anulamos la pulsacion de la tecla
                return false;
            }
        });
        
        // evento que se ejecuta cada vez que se suelte la tecla en cualquiera de
        // los tres inputs
        $("#suma input").keyup(function(event) {
            calcular();
        });
        
        // Calculamos la suma de los dos valores
        function calcular()
        {
            var valor1=validarNumero('#cantidadp');
            var valor2=validarNumero('#preciop');

			var n = (valor1*valor2);
			var na=(parseFloat(n).toFixed(2));			
            
            $("#importep").val(na);	
        }
        
        // Funcion para validar que el numero sea correcto, y para cambiar el color
        // del marco en caso de error
        function validarNumero(id)
        {
            if($.isNumeric($(id).val()))
            {
                $(id).css('border-color','#808080');
                return parseFloat($(id).val());
            }else if($(id).val()==""){
                $(id).css('border-color','#808080');
                return 0;
            }else{
                $(id).css('border-color','#f00');
                return 0;
            }
        }
    </script>

</body>

<?php	
include("footersadmin.html");
?>
</body>
</html>