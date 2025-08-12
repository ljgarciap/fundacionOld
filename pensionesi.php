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
<th>Estado</th>	
<th>Residente</th>
<th>Fundación</th>
<th>Dia de pago</th>
<th>Costo pensión</th>
<th>Valor pendiente</th>
<th>Opciones</th>    </tr>
</thead>
<tfoot>
    <tr>
<th>Estado</th>		
<th>Residente</th>
<th>Fundación</th>
<th>Dia de pago</th>
<th>Costo pensión</th>
<th>Valor pendiente</th>
<th>Opciones</th>
    </tr>
</tfoot>			

<tbody>

<?php
mysqli_set_charset($con,"utf8");
	
$result1=mysqli_query($con,"select idcobrospension,diacobro,valorcobro,nombresr,apellidosr,estado,nomfund from cobrospension join residentes on cobrospension.idresidentes=residentes.idresidentes where residentes.estado='I'");
$ordinal=0;

while ($resultx = mysqli_fetch_array($result1)) {
$estado=$resultx['estado'];
$idcobrospension=$resultx['idcobrospension'];
$diacobro=$resultx['diacobro'];
$valorcobro=$resultx['valorcobro'];
$nomr=$resultx['nombresr'];
$nomfund=$resultx['nomfund'];
$apelr=$resultx['apellidosr'];
$idresidentes="$nomr"." "."$apelr";

$ultimovalor="SELECT sum(valorinicial) as valoriniciales,sum(abono) as abonos  FROM abonopensiones where idcobrospension='$idcobrospension' ORDER by idabonopensiones DESC LIMIT 1";
$resultv1=mysqli_query($con,"$ultimovalor");

		while ($resultvx = mysqli_fetch_array($resultv1)) {
		$valoriniciales=$resultvx['valoriniciales'];
		$abonos=$resultvx['abonos'];
}
$saldos=($valoriniciales-$abonos);
$ordinal=($ordinal+1);
/* Este if-else es el que mostraba solo los que no estaban en lista
if($estado=='E'){
	$valorcobro=0;
	$saldos=0;
}
else{
	$saldos=$saldos;
	$valorcobro=$valorcobro;
}
*/
	$saldos=$saldos;
	$valorcobro=$valorcobro;
	
if($estado=='E'){
?>
<tr style="color:red;">
<td><b><i>No Contabilizar</i></b></td>
<?php
}
else{
?>
<tr>
<td style="color:green;">Contabilizar</td>
<?php
}	
?>
<td><?php echo "$idresidentes"; ?></td>
<td><?php echo "$nomfund"; ?></td>
<td><?php echo "$diacobro"; ?></td>
<td><?php echo "$valorcobro"; ?></td>

<?php
if($saldos>0){
?>
<td style="color:red;"><b><?php echo "$saldos"; ?></b></td>
<?php	
}
else{
?>
<td><?php echo "$saldos"; ?></td>
<?php	
}
?>
<input type="hidden" id="idcobro" name="idcobro" value="<?php echo $idcobrospension;?>"/>
<td>
<select size="1" name="links" onchange="window.location.href=this.value;">
<option value="#">Click en la opción</option> 
<option value="editarpension.php?id=<?php echo $idcobrospension; ?>">Cambiar valor</option>
<option value="labonospension.php?id=<?php echo $idcobrospension; ?>">Ver abonos</option> 
<option value="abonospension.php?id=<?php echo $idcobrospension; ?>">Realizar abono</option>
</select>
</td>
</form>
</tr>
<?php
}
?>

</tbody>

</table>
Total de residentes activos: <?php echo "$ordinal"; ?>
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
