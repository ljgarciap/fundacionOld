<HTML>
<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["sadmin"]==true){

$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
$apellidosess=$_SESSION["apellido"];

include("menusadmin.html");
include_once('bas/conn.php');
$fecha = date("y-m-d");
$hoy="20$fecha";

$result2=@mysqli_query($con,"select sum(d.valorsalida) as acumsalida, sum(d.valorentrada) as acumentrada from diezmos d");
while ($resultx2 = @mysqli_fetch_array($result2)) {
$acentradas=$resultx2['acumentrada'];
$acsalidas=$resultx2['acumsalida'];
}
$saldo=$acentradas-$acsalidas;
if($saldo>0){
	$colb="orange";
	$mess="-- Hay mas entradas que salidas --";
}
elseif($saldo==0){
	$colb="green";
	$mess="-- Va al dia con el diezmo --";
}
elseif($saldo<0){
	$colb="red";
	$mess="-- Hay mas salidas que entradas --";
}
?>

<div id="preloader">
<br><br><br><br>
<center><img src="images/loader.gif" width="40%"/></center>
    <div id="loader">&nbsp;</div>
</div>

<div class="container">
<div class="jumbotron">

<div>El total de entradas es : $<?php echo number_format($acentradas,'0', ',','.'); ?> 
y el total de salidas es : <b style="color:red;">$<?php echo number_format($acsalidas,'0', ',','.'); ?></b>; 
hay una diferencia de : <b style="color:<?php echo $colb; ?>;">$<?php echo number_format($saldo,'0', ',','.'); ?> 
<?php echo $mess; ?></b></div><br>

<div class="table-responsive">
<table id="tabla" class="display" cellspacing="0" width="100%">

<thead>
    <tr>
<th>Asiento</th>
<th>Fecha</th>
<th>Concepto</th>
<th>Detalle</th>
<th>Entrada</th>
<th>Salida</th>
    </tr>
</thead>
<tfoot>
    <tr>
<th>Asiento</th>
<th>Fecha</th>
<th>Concepto</th>
<th>Detalle</th>
<th>Entrada</th>
<th>Salida</th>
    </tr>
</tfoot>			

<tbody>

<?php
mysqli_set_charset($con,"utf8");
	
$result1=@mysqli_query($con,"select a.idasientos as idasientos, a.fecha as fecha, a.concepto as concepto, a.detalle as detalle, d.iddiezmos as idroca, d.valorsalida as valorsalida, d.valorentrada as valorentrada from asientos a join diezmos d on a.idasientos=d.idasientos where a.concepto like 'DIEZMOS'");

/*
$result1=@mysqli_query($con,"select asientos.idasientos as idasientos,asientos.fecha as fecha, asientos.concepto as concepto,asientos.detalle as detalle,roca.idroca as idroca,roca.valorsalida as valor from asientos join roca on asientos.idasientos=roca.idasientos where asientos.concepto like 'DIEZMO'");
*/  //versión vieja busca el pago en la tabla roca, ahora se genera en la tabla diezmos como quedó en la query anterior

while ($resultx = @mysqli_fetch_array($result1)) {
$idasientos=$resultx['idasientos'];
$fecha=$resultx['fecha'];
$detalle=$resultx['detalle'];
$valorentrada=$resultx['valorentrada'];
$valorsalida=$resultx['valorsalida'];
$concepto=$resultx['concepto'];
$idroca=$resultx['idroca'];

$url2="editarasiento.php?idt=diezmos&idm=$idroca&idas=$idasientos";

?>
<tr>
<td><a href="<?php echo "$url2"; ?>" target="blank"><?php echo "$idasientos"; ?></a></td>
<td><?php echo "$fecha"; ?></td>
<td><?php echo "$concepto"; ?></td>
<td><?php echo "$detalle"; ?></td>
<td><?php echo "$valorentrada"; ?></td>
<td><?php echo "$valorsalida"; ?></td>
</tr>
<?php
}
?>

</tbody>

</table>
</div>

<script type="text/javascript">
$(window).load(function() {
	$('#preloader').fadeOut('slow');
	$('body').css({'overflow':'visible'});
})
</script>

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