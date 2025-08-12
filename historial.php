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
<th>Estado</th>
<th>Fundación</th>
<th>Acudiente</th>
<th>Parentesco</th>
<th>Teléfono</th>
<th>Historial</th>
    </tr>
</thead>
<tfoot>
    <tr>
<th>Documento</th>
<th>Residente</th>
<th>Estado</th>
<th>Fundación</th>
<th>Acudiente</th>
<th>Parentesco</th>
<th>Teléfono</th>
<th>Historial</th>
    </tr>
</tfoot>			

<tbody>

<?php
mysqli_set_charset($con,"utf8");
	
$result1=mysqli_query($con,"select residentes.idresidentes as idr, residentes.tipodocumento as tipor, residentes.documentor as cedr, residentes.nombresr as nomr, residentes.apellidosr as apelr, residentes.nomfund as nomfund, residentes.estado as estado, asociacion.parentesco as parent, usuarios.idusuarios as idu, usuarios.nombres as nomu, usuarios.apellidos as apelu, usuarios.telefono as telefono from residentes join asociacion on asociacion.idresidentes = residentes.idresidentes join usuarios on asociacion.idusuarios = usuarios.idusuarios order by nomr asc");

while ($resultx = mysqli_fetch_array($result1)) {
$idr=$resultx['idr'];
$tipor=$resultx['tipor'];
$cedr=$resultx['cedr'];
$nomr=$resultx['nomr'];
$apelr=$resultx['apelr'];
$nomfund=$resultx['nomfund'];
$parent=$resultx['parent'];
$idu=$resultx['idu'];
$nomu=$resultx['nomu'];
$apelu=$resultx['apelu'];
$telefono=$resultx['telefono'];
$estado=$resultx['estado'];

if($estado==="A"){
$estad="Activo";	
}
else{
$estad="Inactivo";	
}

$url="dhistorial.php?idr=$idr";	

?>
<tr>
<td><?php echo "$tipor"." "."$cedr"; ?></td>
<td><?php echo "$nomr"." "."$apelr"; ?></td>
<td><?php echo "$estad"; ?></td>
<td><?php echo "$nomfund"; ?></td>
<td><?php echo "$nomu"." "."$apelu"; ?></td>
<td><?php echo "$parent"; ?></td>
<td><?php echo "$telefono"; ?></td>
<td><a href="<?php echo "$url";?>">Ver</a></td>
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