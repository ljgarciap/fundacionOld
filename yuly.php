<!DOCTYPE html>
<html lang="es" class="no-js">

<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["sadmin"]==true){
	
$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];

include("menusadmin.html");
include_once('bas/conn.php');
mysqli_set_charset($con,"utf8");

$hoy = date("y-m-d");
$fecham="20$hoy"; 
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
  <script>
  $( function() {
    var availableTags = [
      "ABONO PENSION",
	  "SALDO PENSION",
      "ABONO SUELDO",
      "COMPRA",
	  "DIEZMO",
      "LAVADA",
      "GRAVAMEN FINANCIERO",
      "PENSION",
      "TIENDA",
      "ALMUERZO",
      "GASOLINA",
      "SALE A CUENTA",
      "PRIMA",
      "COMIDA",
      "VACACIONES",
	  "HONORARIOS", 
	  "COMISIONES",
	  "ABONO TRANSPORTE DE RESIDENTES",
	  "SALDO TRANSPORTE DE RESIDENTES", 
	  "EMOLUMENTOS ECLESIASTICOS", 
	  "ARRENDAMIENTO",
	  "ENERGIA",
	  "MERCADO",
	  "MATERIALES", 
	  "SERVICIOS", 
	  "SERVICIOS TÉCNICOS",
	  "CONCENTRADO", 
	  "MANTENIMIENTO",
      "SUELDO",
      "LUZ",
      "PAGO",
      "RETEFUENTE",
      "RENTA",
      "DIVERSOS",	  
      "UNIFORMES",
	  "PARA CUADRAR BANCO",
      "VENTA",
	  "REGISTRO ANULADO",
      "NN",
	  "INGRESO SIN CORFIRMAR",	  
      "SUPONGO",
	  "PEAJE",
	  "PAGO PARAFISCALES",
	  "ADELANTO",
	  "COMPRA TRATAMIENTO",
	  "CUOTA DE MANEJO"
	  ];
    $( "#concepto" ).autocomplete({
      source: availableTags
    });
  } );
  </script>

  <script type="text/javascript">
$(function() {
            $("#nombre").autocomplete({
			maxShowItems: 3,
                source: "actores.php",
                minLength: 1,
                select: function(event, ui) {
					event.preventDefault();
                    $('#idactores').val(ui.item.idactores);
					$('#nombre').val(ui.item.nombre);
			     }
            });
		});
</script>
<body>

<div class="container">
<div class="jumbotron">
<form id="movimientoex" action = "movimientoex.php" method = "post">
<br>
<p>
<div class="row">

<div class="col-md-3">
<label>Movimiento contable fecha:</label>
<input type="date" id="fecha" name="fecha" min="2018-05-02" class="form-control input-sm chat-input" value='<?php echo $fecham;?>' required/>
</div>

<div class="col-md-3">
<label>Tabla:</label>
<select id="tablax" name="tablax" class="form-control input-sm chat-input">
<option value="externa">Carolina</option>
</select><br>
</div>

<div class="col-md-3 ">
<label>Tipo:</label>
<select id="tipologia" name="tipologia" class="form-control input-sm chat-input">
<option value="1">Entrada</option>
<option value="2">Salida</option>
</select><br>
</div>

<div class="col-md-3">
<label>Valor:</label>
<input type="number" min="1" id="valor" name="valor" class="form-control input-sm chat-input"></input>
</div>
</div>
</br>

<div class="row">

<div class="col-md-6"  class="ui-widget">
<label>Concepto:</label>
<input type="text" id="concepto" name="concepto" class="form-control input-sm chat-input" placeholder="Ingrese el concepto" style="text-transform: uppercase;"></input>
</div>

<div class="col-md-6">
<label>Detalle asociado:</label>
<input type="text" id="nombre" name="nombre" class="form-control input-sm chat-input" placeholder="Ingrese el actor asociado" style="text-transform: uppercase;"></input>
</div>
</div>
</br></br>

<center>
<div class="wrapper">
<button type="submit" class="btn btn-default">Guardar y continuar</button>          
</div>
</center>
</form>
<hr>
<h3>Ultimo movimiento</h3><br>
<table width="100%">
<thead><tr>
<th style="width:10%;">Tabla</th><th style="width:10%;">Fecha</th><th style="width:20%;">Concepto</th>
<th style="width:20%;">Detalle</th><th style="width:10%;">Entrada</th><th style="width:10%;">Salida</th>
<th style="width:10%;">Acumulado</th><th style="width:10%;">Edición</th>
</tr></thead>
<?php
$query="select * from asientosex order by idasientosex DESC LIMIT 1";
$result=mysqli_query($con,"$query");
while ($resultx = mysqli_fetch_array($result)) {
$idasientos=$resultx['idasientosex'];
$fecha=$resultx['fecha'];
$concepto=$resultx['concepto'];
$detalle=$resultx['detalle'];
$query1="select * from externa where idasientosex='$idasientos'";
$result1=mysqli_query($con,"$query1");
while ($resultx3 = mysqli_fetch_array($result1)) {
	$tab="externa";
	$tabla="Externa";
	$idtabla=$resultx3['idexterna'];	
	$valorentrada=$resultx3['valorentrada'];
	$valorsalida=$resultx3['valorsalida'];
	$acumulado=$resultx3['acumulado'];	
	};
$url="editarasientoex.php?idt=$tab&idm=$idtabla&idas=$idasientos";
?>
<tr><td><?php echo $tabla; ?></td><td><?php echo $fecha; ?></td><td><?php echo $concepto; ?></td>
<td><?php echo $detalle; ?></td><td><?php echo $valorentrada; ?></td>
<td><?php echo $valorsalida; ?></td><td><?php echo $acumulado; ?></td>
<td><a href="<?php echo $url; ?>">Editar</a></td></tr>
<?php
}
?>

</table>
<!--resumen dia-->
<hr>
<h3>Movimientos del dia <?php echo $fecham; ?></h3><br>

<?php
$querya1="select * from externa join asientosex on externa.idasientosex=asientosex.idasientosex where fecha ='$fecham' order by asientosex.idasientosex asc";
$resulta1=mysqli_query($con,"$querya1");

if(mysqli_num_rows($resulta1)>0){
?>
<hr>
<h3>Movimientos Externa <?php echo $fecham; ?></h3><br>

<table width="100%">
<thead><tr>
<th style="width:10%;">Tabla</th><th style="width:10%;">Fecha</th><th style="width:20%;">Concepto</th>
<th style="width:20%;">Detalle</th><th style="width:10%;">Entrada</th><th style="width:10%;">Salida</th>
<th style="width:10%;">Acumulado</th>
</tr></thead>
<?php
while ($resultxa3 = mysqli_fetch_array($resulta1)) {
	$tabla="Carolina";
	$fechaa=$resultxa3['fecha'];
	$conceptoa=$resultxa3['concepto'];
	$detallea=$resultxa3['detalle'];	
	$valorentradaa=$resultxa3['valorentrada'];
	$valorsalidaa=$resultxa3['valorsalida'];
	$acumuladoa=$resultxa3['acumulado'];
?>	
<tr><td><?php echo $tabla; ?></td><td><?php echo $fechaa; ?></td><td><?php echo $conceptoa; ?></td>
<td><?php echo $detallea; ?></td><td><?php echo $valorentradaa; ?></td>
<td><?php echo $valorsalidaa; ?></td><td><?php echo $acumuladoa; ?></td>
</tr>
<?php
	}
?>
</table>	
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
</html>