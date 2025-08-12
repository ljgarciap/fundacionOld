<!DOCTYPE html>
<html lang="es" class="no-js">

<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["planta"]==true){
	
$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];

header ("Expires: Fri, 14 Mar 1980 20:53:00 GMT"); //la pagina expira en fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache"); //PARANOIA, NO GUARDAR EN CACHE 

include_once('bas/conn.php');
include("menuplanta.html");

$hoy = date("y-m-d");
$fecham="20$hoy"; 
?>
<div id="preloader">
<br><br><br><br>
<center><img src="images/loader.gif" width="40%"/></center>
    <div id="loader">&nbsp;</div>
</div>

<div class="container">
<div class="jumbotron">
<center>
<div class="table-responsive">
<table id="tabla" class="display" cellspacing="0" width="100%">

<thead>
    <tr>
<th>Residente</th>
<th>Documento</th>
<th>Eps</th>
<th>Generar</th>
<th>Generar</th>
    </tr>
</thead>
<tfoot>
    <tr>
<th>Residente</th>
<th>Documento</th>
<th>Eps</th>
<th>Generar</th>
<th>Generar</th>
    </tr>
</tfoot>			

<tbody>

<?php
mysqli_set_charset($con,"utf8");
?>

<center><h2>Listado de residentes adultos</h2></center>

<?php
$queryu="select residentes.idresidentes,residentes.nombresr,residentes.apellidosr,
residentes.documentor,residentes.expedicionr,residentes.tipodocumento,residentes.eps from residentes where (residentes.estado='A' or residentes.estado='E') and residentes.tipodocumento='C.C'";	

$result1=mysqli_query($con,$queryu);

$total=0;

while ($resultax = mysqli_fetch_array($result1)) {
$nombres=$resultax['nombresr'];
$apellidos=$resultax['apellidosr'];
$documento=$resultax['documentor'];
$expedicion=$resultax['expedicionr'];
$tipo=$resultax['tipodocumento'];
$eps=$resultax['eps'];
$idresi=$resultax['idresidentes'];
$nomresidente="$nombres"." "."$apellidos";
$docresidente="$tipo".": "."$documento"." de "."$expedicion";
$url="consentadul.php?idt=$idresi";
$url2="consentadulf.php?idt=$idresi";;
?>
<tr>
<td><?php echo $nomresidente; ?></td>
<td><?php echo $docresidente; ?></td>
<td><?php echo $eps; ?></td>
<td><a href="<?php echo $url; ?>" target="new">Firmado</a></td>
<td><a href="<?php echo $url2; ?>" target="new">Para Firmar</a></td>
</tr>
<?php
}
?>
</tbody>

</table>
</div>
</center>

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
</body>
</html>
