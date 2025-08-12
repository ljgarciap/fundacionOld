<!DOCTYPE html>
<html lang="es" class="no-js">

<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["bda"]==true){
	
$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];

include("menubda.html");
include_once('bas/conn.php');
mysqli_set_charset($con,"utf8");

$hoy = date("y-m-d");
$fecham="20$hoy"; 

$yhoy=date("y");
$mhoy=date("m");
$dhoy=date("d");
$mhoy=($mhoy-1);
$fechamin="20$yhoy-$mhoy-$dhoy";

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
<!--
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
-->
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
<form id="movimiento" action = "movimientob.php" method = "post">
<br>
<p>
<div class="row">
<div class="col-md-3">
<label>Movimiento contable fecha:</label>
<input type="date" id="fecha" name="fecha" min="<?php echo $fechamin; ?>" class="form-control input-sm chat-input" value='<?php echo $fecham;?>' required/>
</div>

<div class="col-md-3">
<label>Tabla:</label>
<select id="tablax" name="tablax" class="form-control input-sm chat-input">
<option value="roca">Jesús es mi roca</option>
<option value="jorec">Jorec</option>
<option value="yuly">Yuly</option>
<option value="asteriscos">Efectivo</option>
<option value="diezmos">Diezmos</option>
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
<select id="concepto" name="concepto" class="form-control input-sm chat-input">
<?php
$query0="select * from conceptos";
$result0=mysqli_query($con,"$query0");
while ($resultx0 = mysqli_fetch_array($result0)) {
	$concepto=$resultx0['nombre'];	
	$idconceptos=$resultx0['idconceptos'];	

echo "<option value='$concepto'>$concepto</option>";
}
?>
</select>
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
<th style="width:10%;">Tabla</th>
<th style="width:10%;">Fecha</th>
<th style="width:25%;">Concepto</th>
<th style="width:25%;">Detalle</th>
<th style="width:10%;">Entrada</th>
<th style="width:10%;">Salida</th>
<th style="width:10%;">Acumulado</th>
</tr></thead>
<?php
$query="select * from asientos order by idasientos DESC LIMIT 1";
$result=mysqli_query($con,"$query");
while ($resultx = mysqli_fetch_array($result)) {
$idasientos=$resultx['idasientos'];
$fecha=$resultx['fecha'];
$concepto=$resultx['concepto'];
$detalle=$resultx['detalle'];
$query1="select * from yuly where idasientos='$idasientos'";
$query2="select * from roca where idasientos='$idasientos'";
$query3="select * from jorec where idasientos='$idasientos'";
$query4="select * from asteriscos where idasientos='$idasientos'";
$query5="select * from diezmos where idasientos='$idasientos'";
$result1=mysqli_query($con,"$query1");
$result2=mysqli_query($con,"$query2");
$result3=mysqli_query($con,"$query3");
$result4=mysqli_query($con,"$query4");
$result5=mysqli_query($con,"$query5");
if(mysqli_num_rows($result1)>0){
while ($resultx1 = mysqli_fetch_array($result1)) {
	$tabla="Yuly";
	$tab="yuly";	
	$idtabla=$resultx1['idyuly'];	
	$valorentrada=$resultx1['valorentrada'];
	$valorsalida=$resultx1['valorsalida'];
	$acumulado=$resultx1['acumulado'];
	}	
}
else if(mysqli_num_rows($result2)>0){
while ($resultx2 = mysqli_fetch_array($result2)) {
	$tab="roca";
	$tabla="Jesús es mi roca";
	$idtabla=$resultx2['idroca'];	
	$valorentrada=$resultx2['valorentrada'];
	$valorsalida=$resultx2['valorsalida'];
	$acumulado=$resultx2['acumulado'];	
	}	
}
else if(mysqli_num_rows($result3)>0){
while ($resultx3 = mysqli_fetch_array($result3)) {
	$tab="jorec";
	$tabla="Jorec";
	$idtabla=$resultx3['idjorec'];	
	$valorentrada=$resultx3['valorentrada'];
	$valorsalida=$resultx3['valorsalida'];
	$acumulado=$resultx3['acumulado'];	
	}	
}
else if(mysqli_num_rows($result4)>0){
while ($resultx4 = mysqli_fetch_array($result4)) {
	$tab="asteriscos";
	$tabla="Efectivo";
	$idtabla=$resultx4['idasteriscos'];	
	$valorentrada=$resultx4['valorentrada'];
	$valorsalida=$resultx4['valorsalida'];
	$acumulado=$resultx4['acumulado'];	
	}	
}
else if(mysqli_num_rows($result5)>0){
while ($resultx5 = mysqli_fetch_array($result5)) {
	$tab="diezmos";
	$tabla="Diezmos";
	$idtabla=$resultx5['iddiezmos'];	
	$valorentrada=$resultx5['valorentrada'];
	$valorsalida=$resultx5['valorsalida'];
	$acumulado=$resultx5['acumulado'];	
	}	
};
?>
<tr>
<td><?php echo $tabla; ?></td>
<td><?php echo $fecha; ?></td>
<td><?php echo $concepto; ?></td>
<td><?php echo $detalle; ?></td>
<td><?php echo $valorentrada; ?></td>
<td><?php echo $valorsalida; ?></td>
<td><?php echo $acumulado; ?></td>
</tr>
<?php
}
?>

</table>
<!--resumen dia-->
<hr>
<h3>Movimientos del dia <?php echo $fecham; ?></h3><br>

<?php
$querya1="select * from yuly join asientos on yuly.idasientos=asientos.idasientos where fecha ='$fecham' order by asientos.idasientos asc";
$querya2="select * from roca join asientos on roca.idasientos=asientos.idasientos where fecha ='$fecham' order by asientos.idasientos asc";
$querya3="select * from jorec join asientos on jorec.idasientos=asientos.idasientos where fecha ='$fecham' order by asientos.idasientos asc";
$querya4="select * from asteriscos join asientos on asteriscos.idasientos=asientos.idasientos where fecha ='$fecham' order by asientos.idasientos asc";
$querya5="select * from diezmos join asientos on diezmos.idasientos=asientos.idasientos where fecha ='$fecham' order by asientos.idasientos asc";

$resulta1=mysqli_query($con,"$querya1");
$resulta2=mysqli_query($con,"$querya2");
$resulta3=mysqli_query($con,"$querya3");
$resulta4=mysqli_query($con,"$querya4");
$resulta5=mysqli_query($con,"$querya5");
if(mysqli_num_rows($resulta1)>0){
?>
<hr>
<h3>Movimientos Yuly <?php echo $fecham; ?></h3><br>

<table width="100%">
<thead><tr>
<th style="width:10%;">Tabla</th>
<th style="width:10%;">Fecha</th>
<th style="width:20%;">Concepto</th>
<th style="width:20%;">Detalle</th>
<th style="width:10%;">Entrada</th>
<th style="width:10%;">Salida</th>
<th style="width:10%;">Acumulado</th>
</tr></thead>
<?php
while ($resultxa1 = mysqli_fetch_array($resulta1)) {
	$tablaa="Yuly";
	$fechaa=$resultxa1['fecha'];
	$conceptoa=$resultxa1['concepto'];
	$detallea=$resultxa1['detalle'];	
	$valorentradaa=$resultxa1['valorentrada'];
	$valorsalidaa=$resultxa1['valorsalida'];
	$acumuladoa=$resultxa1['acumulado'];
?>
<tr>
<td><?php echo $tabla; ?></td>
<td><?php echo $fechaa; ?></td>
<td><?php echo $conceptoa; ?></td>
<td><?php echo $detallea; ?></td>
<td><?php echo $valorentradaa; ?></td>
<td><?php echo $valorsalidaa; ?></td>
<td><?php echo $acumuladoa; ?></td>
</tr>
<?php
	}
?>
</table>	
<?php
}

if(mysqli_num_rows($resulta2)>0){
?>
<hr>
<h3>Movimientos Jesús es mi roca <?php echo $fecham; ?></h3><br>

<table width="100%">
<thead><tr>
<th style="width:10%;">Tabla</th><th style="width:10%;">Fecha</th><th style="width:20%;">Concepto</th>
<th style="width:20%;">Detalle</th><th style="width:10%;">Entrada</th><th style="width:10%;">Salida</th>
<th style="width:10%;">Acumulado</th>
</tr></thead>
<?php
while ($resultxa2 = mysqli_fetch_array($resulta2)) {
	$tabla="Jesús es mi roca";
	$fechaa=$resultxa2['fecha'];
	$conceptoa=$resultxa2['concepto'];
	$detallea=$resultxa2['detalle'];	
	$valorentradaa=$resultxa2['valorentrada'];
	$valorsalidaa=$resultxa2['valorsalida'];
	$acumuladoa=$resultxa2['acumulado'];
?>	
<tr>
<td><?php echo $tabla; ?></td>
<td><?php echo $fechaa; ?></td>
<td><?php echo $conceptoa; ?></td>
<td><?php echo $detallea; ?></td>
<td><?php echo $valorentradaa; ?></td>
<td><?php echo $valorsalidaa; ?></td>
<td><?php echo $acumuladoa; ?></td>
</tr>
<?php
	}
?>
</table>	
<?php
}

if(mysqli_num_rows($resulta3)>0){
?>
<hr>
<h3>Movimientos Jorec <?php echo $fecham; ?></h3><br>

<table width="100%">
<thead><tr>
<th style="width:10%;">Tabla</th><th style="width:10%;">Fecha</th><th style="width:20%;">Concepto</th>
<th style="width:20%;">Detalle</th><th style="width:10%;">Entrada</th><th style="width:10%;">Salida</th>
<th style="width:10%;">Acumulado</th>
</tr></thead>
<?php
while ($resultxa3 = mysqli_fetch_array($resulta3)) {
	$tabla="Jorec";
	$fechaa=$resultxa3['fecha'];
	$conceptoa=$resultxa3['concepto'];
	$detallea=$resultxa3['detalle'];	
	$valorentradaa=$resultxa3['valorentrada'];
	$valorsalidaa=$resultxa3['valorsalida'];
	$acumuladoa=$resultxa3['acumulado'];
?>	
<tr>
<td><?php echo $tabla; ?></td>
<td><?php echo $fechaa; ?></td>
<td><?php echo $conceptoa; ?></td>
<td><?php echo $detallea; ?></td>
<td><?php echo $valorentradaa; ?></td>
<td><?php echo $valorsalidaa; ?></td>
<td><?php echo $acumuladoa; ?></td>
</tr>
<?php
	}
?>
</table>	
<?php
}

if(mysqli_num_rows($resulta4)>0){
?>
<hr>
<h3>Movimientos Efectivo <?php echo $fecham; ?></h3><br>

<table width="100%">
<thead><tr>
<th style="width:10%;">Tabla</th><th style="width:10%;">Fecha</th><th style="width:20%;">Concepto</th>
<th style="width:20%;">Detalle</th><th style="width:10%;">Entrada</th><th style="width:10%;">Salida</th>
<th style="width:10%;">Acumulado</th>
</tr></thead>
<?php
while ($resultxa4 = mysqli_fetch_array($resulta4)) {
	$tabla="asteriscos";
	$fechaa=$resultxa4['fecha'];
	$conceptoa=$resultxa4['concepto'];
	$detallea=$resultxa4['detalle'];	
	$valorentradaa=$resultxa4['valorentrada'];
	$valorsalidaa=$resultxa4['valorsalida'];
	$acumuladoa=$resultxa4['acumulado'];
?>	
<tr>
<td><?php echo $tabla; ?></td>
<td><?php echo $fechaa; ?></td>
<td><?php echo $conceptoa; ?></td>
<td><?php echo $detallea; ?></td>
<td><?php echo $valorentradaa; ?></td>
<td><?php echo $valorsalidaa; ?></td>
<td><?php echo $acumuladoa; ?></td>
</tr>
<?php
	}
?>
</table>	
<?php
}

if(mysqli_num_rows($resulta5)>0){
?>
<hr>
<h3>Movimientos Diezmos <?php echo $fecham; ?></h3><br>

<table width="100%">
<thead><tr>
<th style="width:10%;">Tabla</th>
<th style="width:10%;">Fecha</th>
<th style="width:25%;">Concepto</th>
<th style="width:25%;">Detalle</th>
<th style="width:10%;">Entrada</th>
<th style="width:10%;">Salida</th>
<th style="width:10%;">Acumulado</th>
</tr></thead>
<?php
while ($resultxa5 = mysqli_fetch_array($resulta5)) {
	$tabla="diezmos";
	$fechaa=$resultxa5['fecha'];
	$conceptoa=$resultxa5['concepto'];
	$detallea=$resultxa5['detalle'];	
	$valorentradaa=$resultxa5['valorentrada'];
	$valorsalidaa=$resultxa5['valorsalida'];
	$acumuladoa=$resultxa5['acumulado'];
?>	
<tr>
<td><?php echo $tabla; ?></td>
<td><?php echo $fechaa; ?></td>
<td><?php echo $conceptoa; ?></td>
<td><?php echo $detallea; ?></td>
<td><?php echo $valorentradaa; ?></td>
<td><?php echo $valorsalidaa; ?></td>
<td><?php echo $acumuladoa; ?></td>
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