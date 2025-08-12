<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["sadmin"]==true){

$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
$apellidosess=$_SESSION["apellido"];
	
include_once('bas/conn.php');
include("menusadmin.html");
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
<th>Documento</th>
<th>Residente</th>
<th>Eps</th>
<th>Parentesco</th>
<th>Acudiente</th>
<th>Teléfono</th>
<th>Correo</th>
<th>Historial</th>
<th>Estado</th>
    </tr>
</thead>
<tfoot>
    <tr>
<th>Documento</th>
<th>Residente</th>
<th>Eps</th>
<th>Parentesco</th>
<th>Acudiente</th>
<th>Teléfono</th>
<th>Correo</th>
<th>Historial</th>
<th>Estado</th>
    </tr>
</tfoot>			

<tbody>

<?php
mysqli_set_charset($con,"utf8");
	
$result1=mysqli_query($con,"select residentes.idresidentes as idr, residentes.tipodocumento as tipor, residentes.documentor as cedr, residentes.nombresr as nomr, residentes.apellidosr as apelr, residentes.estado as estr, residentes.eps as eps, residentes.nomfund as nomfund, residentes.estado as estado, asociacion.idasociacion as idas, asociacion.parentesco as parent, usuarios.nombres as nomu, usuarios.apellidos as apelu, usuarios.telefono as telefono, usuarios.email as email from residentes join asociacion on asociacion.idresidentes = residentes.idresidentes join usuarios on asociacion.idusuarios = usuarios.idusuarios 
where residentes.estado='I' and residentes.nomfund='FUNDACIÓN JESÚS ES MI ROCA' order by nomr asc");

while ($resultx = mysqli_fetch_array($result1)) {
$idr=$resultx['idr'];
$tipor=$resultx['tipor'];
$cedr=$resultx['cedr'];
$nomr=$resultx['nomr'];
$apelr=$resultx['apelr'];
$estr=$resultx['estr'];
$eps=$resultx['eps'];
$nomfund=$resultx['nomfund'];
$idas=$resultx['idas'];
$parent=$resultx['parent'];
$nomu=$resultx['nomu'];
$apelu=$resultx['apelu'];
$telefono=$resultx['telefono'];
$email=$resultx['email'];
$estado=$resultx['estado'];

$url2="editar.php?idr=$idr";

$estad="Inactivo";	

$url="detallef.php?idresidente=$idr";	

?>
<tr>
<td><a href="<?php echo "$url2"; ?>" target="blank"><?php echo "$tipor"." "."$cedr"; ?></a></td>
<td><a href="<?php echo "$url"; ?>" target="blank"><?php echo "$nomr"." "."$apelr"; ?></a></td>
<td><?php echo "$eps"; ?></td>
<td><?php echo "$parent"; ?></td>
<td><?php echo "$nomu"." "."$apelu"; ?></td>
<td><?php echo "$telefono"; ?></td>
<td><?php echo "$email"; ?></td>
<td><a href='detalleretf.php?idresidente=<?php echo "$idr"; ?>' target="blank">Retiros</a></td>
<td><?php echo "<a href='cambiare.php?idr=$idr&estado=$estado'>$estad</a>"; ?></td>
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