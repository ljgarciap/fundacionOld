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
<th>Residente</th>
<th>Saldo</th>
    </tr>
</thead>
<tfoot>
    <tr>
<th>Residente</th>
<th>Saldo</th>
    </tr>
</tfoot>			

<tbody>

<?php
mysqli_set_charset($con,"utf8");
?>

<center><h2><a href="impsaldos.php" target="new">Listado de residentes</a></h2></center>

<?php
$queryu="select distinct residentes.idresidentes,residentes.nombresr,residentes.apellidosr from tienda join residentes on tienda.idresidentes=residentes.idresidentes where residentes.estado='A' or residentes.estado='E'";	

$result1=mysqli_query($con,$queryu);

$total=0;

while ($resultax = mysqli_fetch_array($result1)) {
$nombres=$resultax['nombresr'];
$apellidos=$resultax['apellidosr'];
$idresi=$resultax['idresidentes'];
$nomresidente="$nombres"." "."$apellidos";

$queryur="select SUM(tienda.valorentrada) as valorentrada,
sum(tienda.valorsalida) as valorsalida from tienda join residentes on tienda.idresidentes=residentes.idresidentes where residentes.idresidentes=$idresi;";	

$result1r=mysqli_query($con,$queryur);

while ($resultxr = mysqli_fetch_array($result1r)) {
$entradas=$resultxr['valorentrada'];
$salidas=$resultxr['valorsalida'];
}

$saldototal=$entradas-$salidas;

?>
<tr>
<td><?php echo $nomresidente; ?></td>
<td><?php echo $saldototal; ?></td>
</tr>
<?php
}
?>
</tbody>

</table>
</div>
</center>
<br><br>
<center>
<div class="row" style="width:80%;">
<form id="movtienda" action = "movtienda.php" method = "get"> 
<div class="col-md-3">
<label>Fecha:</label>
<input type="date" id="fecha" name="fecha" min="2018-01-01" class="form-control input-sm chat-input" value='<?php echo $fecham;?>' required/>
</div>
<div class="col-md-2">
<label>Tipo:</label> 
<select id="tipologia" name="tipologia" class="form-control input-sm chat-input">
<option value="2">Salida</option>
<option value="1">Entrada</option>
</select><br>
</div>
<div class="col-md-3">
<label>Valor:</label>
<input type="number" min="1" id="valor" name="valor" class="form-control input-sm chat-input"></input>
</div>
  <input type="hidden" id="idresidentes" name="idresidentes" value="<?php echo $idresidentes?>"></input>
<div class="wrapper col-md-2"><br>
<button type="submit" class="btn btn-danger">Ingresar movimiento</button>          
</div>
</form>
</div></center>

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
