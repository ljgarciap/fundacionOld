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
<th>Fecha</th>
<th>Entrada</th>
<th>Salida</th>
<th>Saldo</th>
<th>Observaciones</th>
    </tr>
</thead>
<tfoot>
    <tr>
<th>Fecha</th>
<th>Entrada</th>
<th>Salida</th>
<th>Saldo</th>
<th>Observaciones</th>
    </tr>
</tfoot>			

<tbody>

<?php
mysqli_set_charset($con,"utf8");
$query="select nombre from proveedores where idproveedores=$idresidentes;";

$result=mysqli_query($con,$query);
while ($resultax = mysqli_fetch_array($result)) {
$nomresidente=$resultax['nombre'];
}
?>

<center><h2><?php echo $nomresidente; ?></h2></center>

<?php
$queryu="select pagoproveedores.idpagoproveedores,pagoproveedores.idproveedores,
pagoproveedores.fecha,pagoproveedores.valorentrada,pagoproveedores.valorsalida,
pagoproveedores.observaciones from pagoproveedores join proveedores on pagoproveedores.idproveedores=proveedores.idproveedores where proveedores.idproveedores=$idresidentes order by fecha asc;";	

//echo "$queryu";

$result1=mysqli_query($con,$queryu);

$acumval=0;
$acumab=0;

while ($resultx = mysqli_fetch_array($result1)) {
$fecha=$resultx['fecha'];
$valorentrada=$resultx['valorentrada'];
$valorsalida=$resultx['valorsalida'];
$observaciones=$resultx['observaciones'];
$idtienda=$resultx['idpagoproveedores'];
$idresidentes=$resultx['idproveedores'];
$acumval=$acumval+$valorentrada;
$acumab=$acumab+$valorsalida;
$saldo=$acumval-$acumab;
?>
<tr>
<td><?php echo "$fecha"; ?></td>
<td><?php echo "$valorentrada"; ?></td>
<td style="color:red;"><?php echo "$valorsalida"; ?></td>
<?php
if($saldo>0){
?>
<td><?php echo "$saldo"; ?></td>
<?php	
}
else{
?>	
<td style="color:red;"><?php echo "$saldo"; ?></td>	
<?php
}
?>
<td><?php echo "$observaciones"; ?></td>
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
