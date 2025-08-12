<HTML>
<?php
header ("Expires: Fri, 14 Mar 1980 20:53:00 GMT"); //la pagina expira en fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache"); //PARANOIA, NO GUARDAR EN CACHE 

include("menutienda.html");
include_once('bas/conn.php');
$fecha = date("y-m-d");
$hoy="20$fecha";
?>
<HEAD>
  <script type="text/javascript">
$(function() {
            $("#nombre").autocomplete({
			maxShowItems: 5,
                source: "residentesc.php",
                minLength: 1,
                select: function(event, ui) {
					event.preventDefault();
					$('#nombre').val(ui.item.nombrer);
					$('#saldo').val(ui.item.saldototal);
					$('#idclientes').val(ui.item.idresidentes);
			     }
            });
		});
</script>
</HEAD>

  <div class="container">  
<div class="jumbotron">
<body>
<center><h2>Ventas tienda</h2></center>

		<form id="crearp" action = "crearp.php" method = "post" >
		
<div class="row ui-widget">
	
			<div class="col-md-2">
			<label for="fechaf">Fecha</label>
		<input type="date" class="form-control input-sm" id="fechaf" name="fechaf" value="<?php echo $hoy;?>"/>	</div>
			<div class="col-md-5">
			<label for="nombre">Nombre</label>
			<input type="text" id="nombre" name="nombre" class="form-control input-sm chat-input" placeholder="Nombre cliente" required/>
            </br>
			</div>
			<div class="col-md-3">
			<label for="saldo">Saldo</label>
			<input type="text" id="saldo" name="saldo" class="form-control input-sm chat-input" placeholder="saldo cliente" required/>
            </br>
			</div>			
		<input type="hidden" id="idclientes" name="idclientes">	
			<div class="col-md-2"><br>
			<button type="submit" class="btn btn-primary">Facturar</button>         
			</div>
			</form>
		</div>	

<hr style="background: red; height: 3px; width: 100%; border: 0">
<hr style="background: red; height: 3px; width: 100%; border: 0">

<div class="row ui-widget">
			<div class="col-md-6">
<center><h2>Ventas en efectivo</h2></center>
		
<div class="row ui-widget">
<form id="crearpe" action = "crearpe.php" method = "post" >
			<div class="col-md-8">
			<label for="nombre">Nombre</label>
<select id="idclientese" name="idclientese" class="form-control input-sm chat-input">
<option value='7'>Venta POS</option>
</select>
            </br>
			</div>	
			<div class="col-md-4"><br>
			<button type="submit" class="btn btn-warning">Facturar</button>         
			</div>
			</form>
		</div>	

</div>
<div class="col-md-6">
<h2>Internas</h2>
<div class="row ui-widget">
<form id="crearpe" action = "crearpe.php" method = "post" >
			<div class="col-md-8">
			<label for="nombre">Nombre</label>
<select id="idclientese" name="idclientese" class="form-control input-sm chat-input">
<option value='1'>Venta Interna</option>
</select>
            </br>
			</div>	
			<div class="col-md-4"><br>
			<button type="submit" class="btn btn-danger">Facturar</button>         
			</div>
			</form>
		</div>	
</div>	

</div>	

</div>
</div>

</body>
</html>
<?php
include("footersadmin.html");
?>