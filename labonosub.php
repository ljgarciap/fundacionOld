<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["bda"]==true){

$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
$apellidosess=$_SESSION["apellido"];
	
include_once('bas/conn.php');
include("menubda.html");

$hoy = date("y-m-d"); 
$iduniformes=$_REQUEST['id'];
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
<th>Valor cobro</th>
<th>Fecha abono</th>
<th>Valor abonado</th>
<th>Saldo al dia</th>
    </tr>
</thead>
<tfoot>
    <tr>
<th>Residente</th>
<th>Valor cobro</th>
<th>Fecha abono</th>
<th>Valor abonado</th>
<th>Saldo al dia</th>
    </tr>
</tfoot>			

<tbody>

<?php
mysqli_set_charset($con,"utf8");
	

$queryu="select residentes.nombresr,residentes.apellidosr,abonouniformes.fechaabono,abonouniformes.abono,
uniformes.idresidentes,uniformes.valorcobro from abonouniformes join uniformes on abonouniformes.iduniformes=uniformes.iduniformes join residentes on 
uniformes.idresidentes=residentes.idresidentes where uniformes.iduniformes=$iduniformes 
order by fechaabono asc;";	

//echo "$queryu";

$result1=mysqli_query($con,$queryu);

$total=0;

while ($resultx = mysqli_fetch_array($result1)) {
$nombresr=$resultx['nombresr'];
$apellidosr=$resultx['apellidosr'];
$fechaabono=$resultx['fechaabono'];
$abono=$resultx['abono'];
$valorcobro=$resultx['valorcobro'];
$idresidentes=$resultx['idresidentes'];
$nomresidentes="$nombresr"." "."$apellidosr";
$total=$total+$abono;
$saldo=$valorcobro-$total;
?>
<tr>
<td><?php echo "$nomresidentes"; ?></td>
<td><?php echo "$valorcobro"; ?></td>
<td><?php echo "$fechaabono"; ?></td>
<td><?php echo "$abono"; ?></td>
<td><?php echo "$saldo"; ?></td>
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
