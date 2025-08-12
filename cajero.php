<HTML>
<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["cajero"]==true){

$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
$apellidosess=$_SESSION["apellido"];

header ("Expires: Fri, 14 Mar 1980 20:53:00 GMT"); //la pagina expira en fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache"); //PARANOIA, NO GUARDAR EN CACHE 

include("menucajero.html");
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

		<form id="crearp" action = "crearpc.php" method = "post" >
		
<div class="row ui-widget">
			<div class="col-md-6">
			<label for="nombre">Nombre</label>
			<input type="text" id="nombre" name="nombre" class="form-control input-sm chat-input" placeholder="Nombre cliente" required/>
            </br>
			</div>
			<div class="col-md-4">
			<label for="saldo">Saldo</label>
			<input type="text" id="saldo" name="saldo" class="form-control input-sm chat-input" placeholder="saldo cliente" required/>
            </br>
			</div>			
		<input type="hidden" id="idclientes" name="idclientes">	
			<div class="col-md-2"><br>
			<button type="submit" class="btn btn-primary">Facturar</button>         
			</div>
		</div>	
			</form>

</div>
</div>

</body>
</html>
<?php
include("footersadmin.html");
}
else {
header("Location:index.php");
}
?>