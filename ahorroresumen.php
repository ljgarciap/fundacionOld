<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["sadmin"]==true){

$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
$apellidosess=$_SESSION["apellido"];
	
include_once('bas/conn.php');
include("menusadmin.html");

mysqli_set_charset($con,"utf8");
$diezmo=0;
$diezmomenos=0;
$diezmototal=0;


$resultadi=mysqli_query($con,"select sum(diezmo) as diezmo from ahorro");

while ($resultxd = mysqli_fetch_array($resultadi)) {
$diezmo=$resultxd['diezmo'];
}

$resultadia=mysqli_query($con,"select sum(valorsalida) as diezmomenos from ahorro join asientosahorro on ahorro.idasientosahorro=asientosahorro.idasientosahorro where asientosahorro.concepto='DIEZMO'");

while ($resultxdia = mysqli_fetch_array($resultadia)) {
$diezmomenos=$resultxdia['diezmomenos'];
}

$diezmototal=$diezmo-$diezmomenos;
?>

<div id="preloader">
<br><br><br><br>
<center><img src="images/loader.gif" width="40%"/></center>
    <div id="loader">&nbsp;</div>
</div>

<div class="container">
<div class="jumbotron">

<center><h4 style="color:red;">El valor del diezmo pendiente es de <?php echo $diezmototal; ?>; se ha diezmado un total de <?php echo $diezmomenos; ?>, y el total de diezmos según ingresos era de <?php echo $diezmo; ?></h4></center><br>

<div class="table-responsive">
<table id="tabla" class="display" cellspacing="0" width="100%">

<thead>
<tr>
<th>Fecha</th>	
<th>Asiento</th>
<th>Concepto</th>
<th>Detalle</th>
<th>Entrada</th>
<th>Salida</th>
<th>Acumulado</th>
<th>Diezmo</th>
<!--<th>Asiento</th>-->
    </tr>
</thead>
<tfoot>
    <tr>
<th>Fecha</th>	
<th>Asiento</th>
<th>Concepto</th>
<th>Detalle</th>
<th>Entrada</th>
<th>Salida</th>
<th>Acumulado</th>
<th>Diezmo</th>
<!--<th>Asiento</th>-->
    </tr>
</tfoot>			

<tbody>

<?php
$acump=0;	
$result1=mysqli_query($con,"select asientosahorro.idasientosahorro as idasientos,ahorro.idahorro as idtabla,fecha,concepto,detalle,valorentrada,
valorsalida,acumulado,diezmo from asientosahorro join ahorro on asientosahorro.idasientosahorro=ahorro.idasientosahorro order by fecha asc, idahorro asc;");

while ($resultx = mysqli_fetch_array($result1)) {
$fecham=$resultx['fecha'];
$conceptm=$resultx['concepto'];
$detalm=$resultx['detalle'];
$valore=$resultx['valorentrada'];
$valors=$resultx['valorsalida'];
$acum=$resultx['acumulado'];
$idm=$resultx['idasientos'];
$idtabla=$resultx['idtabla'];
$diezmo=$resultx['diezmo'];
$acump=(($acump+$valore)-$valors);
if($acum==$acump){$url="ahorroeditarasiento.php?idt=ahorro&idm=$idtabla&idas=$idm";}
else{$url="ahorroeditarasiento.php?idt=ahorro&idm=$idtabla&idas=$idm";
$query1="update ahorro set acumulado='$acump' where ahorro.idasientosahorro='$idm'";
$result1=mysqli_query($con,"$query1");};
?>
<tr>
<td><?php echo "$fecham"; ?></td>
<td><a href="<?php echo "$url"; ?>"><?php echo "$idm"; ?></a></td>
<td><?php echo "$conceptm"; ?></td>
<td><?php echo "$detalm"; ?></td>
<td><?php echo "$valore"; ?></td>
<td><?php echo "$valors"; ?></td>
<td><?php echo "$acum"; ?></td>
<td><?php echo "$diezmo"; ?></td>
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
<?php
include("footersadmin.html");
}
else {
header("Location:index.php");
}
?>