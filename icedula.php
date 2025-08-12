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
<th>Nombre</th>
<th>Imprimir</th>
    </tr>
</thead>
<tfoot>
    <tr>
<th>Documento</th>
<th>Nombre</th>
<th>Imprimir</th>
    </tr>
</tfoot>			

<tbody>

<?php
mysqli_set_charset($con,"utf8");
	
$result1=mysqli_query($con,"select residentes.documentor as docr,residentes.nombresr as nomr,residentes.apellidosr as apelr,usuarios.documento as docu,usuarios.nombres as nomu,usuarios.apellidos as apelu from residentes join asociacion on residentes.idresidentes=asociacion.idresidentes join usuarios on usuarios.idusuarios=asociacion.idusuarios;");

while ($resultx = mysqli_fetch_array($result1)) {
$docr=$resultx['docr'];
$nomr=$resultx['nomr'];
$apelr=$resultx['apelr'];
$docu=$resultx['docu'];
$nomu=$resultx['nomu'];
$apelu=$resultx['apelu'];
?>
<tr>
<td><?php echo "$docr"; ?></td>
<td><?php echo "$nomr"." "."$apelr"; ?></td>
<td><a href="cedulas/<?php echo "$docr.pdf"; ?>" target="new">Ver documento</a></td>
</tr>
<tr>
<td><?php echo "$docu"; ?></td>
<td><?php echo "$nomu"." "."$apelu"; ?></td>
<td><a href="cedulas/<?php echo "$docu.pdf"; ?>" target="new">Ver documento</a></td>
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
