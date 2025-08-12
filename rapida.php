<?php
header ("Expires: Fri, 14 Mar 1980 20:53:00 GMT"); //la pagina expira en fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache"); //PARANOIA, NO GUARDAR EN CACHE 

include_once('bas/conn.php');
include("menutienda.html");

$hoy = date("y-m-d");
$fecham="20$hoy"; 
$idresidentes=$_REQUEST['idresX'];
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
<th>IDResidente</th>
<th>Residente</th>
<th>Saldo</th>
    </tr>
</thead>
<tfoot>
    <tr>
<th>IDResidente</th>	
<th>Residente</th>
<th>Saldo</th>
    </tr>
</tfoot>			

<tbody>

<?php
mysqli_set_charset($con,"utf8");
?>

<center><h2>Listado de residentes</h2></center>

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
sum(tienda.valorsalida) as valorsalida,residentes.idresidentes as idresidentes from tienda join residentes on tienda.idresidentes=residentes.idresidentes where residentes.idresidentes=$idresi;";	

$result1r=mysqli_query($con,$queryur);

while ($resultxr = mysqli_fetch_array($result1r)) {
$entradas=$resultxr['valorentrada'];
$salidas=$resultxr['valorsalida'];
$idresidentes=$resultxr['idresidentes'];
}

$saldototal=$entradas-$salidas;

?>
<tr>
<td><?php echo $idresidentes; ?></td>
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
