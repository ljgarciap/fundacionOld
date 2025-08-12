<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["sadmin"]==true){

$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
$apellidosess=$_SESSION["apellido"];
	
include_once('bas/conn.php');
include("menusadmin.html");

$hoy = date("y-m-d"); 
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
<th>Dia</th>
<th>Residente</th>
<th>Valor pendiente</th>
<th>Fecha abono</th>
<th>Valor abono</th>
<th>Saldo</th>
<th>Observaciones</th>
<th>Abonar</th>
    </tr>
</thead>
<tfoot>
    <tr>
<th>Dia</th>
<th>Residente</th>
<th>Valor pendiente</th>
<th>Fecha abono</th>
<th>Valor abono</th>
<th>Saldo</th>
<th>Observaciones</th>
<th>Abonar</th>
    </tr>
</tfoot>			

<tbody>

<?php
mysqli_set_charset($con,"utf8");
	
$result1=mysqli_query($con,"select idcobroalmuerzos,fechaventa,valorinicial,fechaabono,
	abono,saldo,observaciones,nombresr,apellidosr from cobroalmuerzos join residentes 
	on cobroalmuerzos.idresidentes=residentes.idresidentes where residentes.estado='A' 
	or residentes.estado='E' and saldo>0 order by residentes.idresidentes asc");

while ($resultx = mysqli_fetch_array($result1)) {
$idcobroalmuerzos=$resultx['idcobroalmuerzos'];
$diacobro=$resultx['fechaventa'];
$valorinicial=$resultx['valorinicial'];
$fechaabono=$resultx['fechaabono'];
$abono=$resultx['abono'];
$nuevosaldo=$resultx['saldo'];
$fundacion=$resultx['observaciones'];
$nomr=$resultx['nombresr'];
$apelr=$resultx['apellidosr'];
$idresidentes="$nomr"." "."$apelr";
?>
<tr>
<form id="pago" action = "pagoalmuerzos.php" method = "post">
<td><?php echo "$diacobro"; ?></td>
<td><?php echo "$idresidentes"; ?></td>
<td><?php echo "$valorinicial"; ?></td>
<td><?php echo "$fechaabono"; ?></td>
<td><input type="number" id="abono" name="abono" value='<?php echo "$abono"; ?>'></input></td>
<td><?php echo "$nuevosaldo"; ?></td>
<td><textarea id="observaciones" name="observaciones" cols="30" rows="3"><?php echo "$fundacion"; ?></textarea></td>
<input type="hidden" id="idcobro" name="idcobro" value="<?php echo $idcobroalmuerzos; ?>"/>
<input type="hidden" id="valorinicial" name="valorinicial" value="<?php echo $valorinicial; ?>"/>
<td><button type="submit" class="btn btn-danger">Pago</button> </td>
</form>
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
