<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["sadmin"]==true){

$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
$apellidosess=$_SESSION["apellido"];
	
include_once('bas/conn.php');
include("menusadmin.html");

$hoy = date("y-m-d"); 
$idcobrospension=$_REQUEST['id'];
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
<th>Residente</th>
<th>Fecha</th>
<th>Pension</th>
<th>Abono</th>
<th>Saldo al dia</th>
<th>Comentario</th>
    </tr>
</thead>
<tfoot>
    <tr>
<th>Residente</th>
<th>Fecha</th>
<th>Pension</th>
<th>Abono</th>
<th>Saldo al dia</th>
<th>Comentario</th>
    </tr>
</tfoot>			

<tbody>

<?php
mysqli_set_charset($con,"utf8");
	

$queryu="select residentes.idresidentes,residentes.nombresr,residentes.apellidosr,
abonopensiones.idabonopensiones,abonopensiones.fechaabono,
abonopensiones.valorinicial,abonopensiones.abono,abonopensiones.comentario from abonopensiones join cobrospension on abonopensiones.idcobrospension=cobrospension.idcobrospension 
join residentes on cobrospension.idresidentes=residentes.idresidentes where abonopensiones.idcobrospension=$idcobrospension order by abonopensiones.fechaabono asc;";	

//echo "$queryu";
$acumval=0;
$acumab=0;

$result1=mysqli_query($con,$queryu);

while ($resultx = mysqli_fetch_array($result1)) {
$nombresr=$resultx['nombresr'];
$apellidosr=$resultx['apellidosr'];
$fechaabono=$resultx['fechaabono'];
$valorinicial=$resultx['valorinicial'];
$abono=$resultx['abono'];
$comentario=$resultx['comentario'];
$idresidentes=$resultx['idresidentes'];
$idabonopensiones=$resultx['idabonopensiones'];
$nomresidentes="$nombresr"." "."$apellidosr";
$acumval=$acumval+$valorinicial;
$acumab=$acumab+$abono;
$saldo=$acumval-$acumab;
$url="editaabonos.php?idr=$idresidentes&idab=$idabonopensiones";
?>
<tr>
<td><a href='<?php echo "$url"; ?>'><?php echo "$nomresidentes"; ?></a></td>
<td><?php echo "$fechaabono"; ?></td>
<td><?php echo "$valorinicial"; ?></td>
<td><?php echo "$abono"; ?></td>
<td><?php echo "$saldo"; ?></td>
<td><?php echo "$comentario"; ?></td>
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
