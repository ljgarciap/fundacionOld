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
<th>Fecha</th>
<th>Residente</th>
<th>Resumen</th>
<th>Acudiente</th>
<th>Celular</th>
<th>Enviar</th>
    </tr>
</thead>
<tfoot>
    <tr>
<th>Fecha</th>
<th>Residente</th>
<th>Resumen</th>
<th>Acudiente</th>
<th>Celular</th>
<th>Enviar</th>    </tr>
</tfoot>			

<tbody>

<?php
mysqli_set_charset($con,"utf8");
	
$result1=mysqli_query($con,"select familias.fecha as fecha, familias.mensaje as mensaje,residentes.nombresr as nombres,residentes.apellidosr as apellidos,usuarios.nombres as nombresu, usuarios.apellidos as apellidosu, usuarios.telefono as telefono from familias join residentes on familias.idresidentes=residentes.idresidentes join asociacion on residentes.idresidentes=asociacion.idresidentes join usuarios on asociacion.idusuarios=usuarios.idusuarios order by fecha desc;");

while ($resultx = mysqli_fetch_array($result1)) {
$fecha=$resultx['fecha'];
$mensaje=$resultx['mensaje'];
$nomr=$resultx['nombres'];
$apelr=$resultx['apellidos'];
$idresidentes="$nomr"." "."$apelr";
$nomu=$resultx['nombresu'];
$apelu=$resultx['apellidosu'];
$idusuarios="$nomu"." "."$apelu";
$telefono=$resultx['telefono'];
$url="https://api.whatsapp.com/send?phone=57$telefono&text=$mensaje"
?>
<tr>
<td><?php echo "$fecha"; ?></td>
<td><?php echo "$idresidentes"; ?></td>
<td>Resumen semanal del residente.<br><br><?php echo "$mensaje"; ?></td>
<td><?php echo "$idusuarios"; ?></td>
<td><?php echo "$telefono"; ?></td>
<td><a href="<?php echo $url; ?>" target="new">Mensaje</a></td>
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
