<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["bda"]==true){

$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
$apellidosess=$_SESSION["apellido"];
	
include_once('bas/conn.php');
include("menubda.html");
?>
<div id="preloader">
<br><br><br><br>
<center><img src="images/loader.gif" width="40%"/></center>
    <div id="loader">&nbsp;</div>
</div>

<div class="container">
<div class="jumbotron">

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
<!--<th>Asiento</th>-->
    </tr>
</tfoot>			

<tbody>

<?php
mysqli_set_charset($con,"utf8");
$acump=0;	
$result1=mysqli_query($con,"select asientosex.idasientosex as idasientos,externa.idexterna as idtabla,fecha,concepto,detalle,valorentrada,valorsalida,acumulado from asientosex join externa on asientosex.idasientosex=externa.idasientosex order by fecha asc, idexterna asc;");

while ($resultx = mysqli_fetch_array($result1)) {
$fecham=$resultx['fecha'];
$conceptm=$resultx['concepto'];
$detalm=$resultx['detalle'];
$valore=$resultx['valorentrada'];
$valors=$resultx['valorsalida'];
$acum=$resultx['acumulado'];
$idm=$resultx['idasientos'];
$idtabla=$resultx['idtabla'];
?>
<tr>
<td><?php echo "$fecham"; ?></td>
<td><?php echo "$idm"; ?></td>
<td><?php echo "$conceptm"; ?></td>
<td><?php echo "$detalm"; ?></td>
<td><?php echo "$valore"; ?></td>
<td><?php echo "$valors"; ?></td>
<td><?php echo "$acum"; ?></td>
<!--<td><?php echo "$idm"; ?></td>-->
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