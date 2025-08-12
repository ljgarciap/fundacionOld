<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["bda"]==true){

$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
$apellidosess=$_SESSION["apellido"];
	
include_once('bas/conn.php');
include("menubda.html");

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
<th>Número</th>	
<th>Residente</th>
<th>Dia de pago</th>
<th>Costo pensión</th>
<th>Valor pendiente</th>
<th>Opciones</th>    </tr>
</thead>
<tfoot>
    <tr>
<th>Número</th>		
<th>Residente</th>
<th>Dia de pago</th>
<th>Costo pensión</th>
<th>Valor pendiente</th>
<th>Opciones</th>
    </tr>
</tfoot>			

<tbody>

<?php
mysqli_set_charset($con,"utf8");
	
$result1=mysqli_query($con,"select idcobrospension,diacobro,valorcobro,nombresr,apellidosr from cobrospension join residentes on cobrospension.idresidentes=residentes.idresidentes where residentes.estado='E';");
$ordinal=0;

while ($resultx = mysqli_fetch_array($result1)) {
$idcobrospension=$resultx['idcobrospension'];
$diacobro=$resultx['diacobro'];
$valorcobro=$resultx['valorcobro'];
$nomr=$resultx['nombresr'];
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
?>
<tr>
<td><?php echo "$ordinal"; ?></td>
<td><?php echo "$idresidentes"; ?></td>
<td><?php echo "$diacobro"; ?></td>
<td><?php echo "$valorcobro"; ?></td>
<td><?php echo "$saldos"; ?></td>
<input type="hidden" id="idcobro" name="idcobro" value="<?php echo $idcobrospension;?>"/>
<td>
<select size="1" name="links" onchange="window.location.href=this.value;">
<option value="#">Click en la opción</option> 
<option value="labonospensionb.php?id=<?php echo $idcobrospension; ?>">Ver abonos</option> 
<option value="abonospensionb.php?id=<?php echo $idcobrospension; ?>">Realizar abono</option>
</select>
</td>
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
