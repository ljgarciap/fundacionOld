<!DOCTYPE html>
<html lang="es" class="no-js">

<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["planta"]==true){
	
$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];

$idresidentes=$_REQUEST['idt'];

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
<th>Fecha</th>
<th>Resumen</th>
<th>Evaluacion</th>
<th>Técnicas</th>
<th>Tareas</th>
    </tr>
</thead>
<tfoot>
    <tr>
<th>Fecha</th>
<th>Resumen</th>
<th>Evaluacion</th>
<th>Técnicas</th>
<th>Tareas</th>
    </tr>
</tfoot>			

<tbody>

<?php
mysqli_set_charset($con,"utf8");

$queryre="select nombresr,apellidosr from residentes where idresidentes='$idresidentes'";	

$resultre=mysqli_query($con,$queryre);

while ($resultare = mysqli_fetch_array($resultre)) {
$nomr=$resultare['nombresr'];
$aper=$resultare['apellidosr'];
}

?>

<center><h2>Resumen de atenciones con psicólogo <?php echo $nomr." ".$aper; ?></h2></center><br>

<?php
$queryu="select fecha,hora,resumen,evaluacion,tecnicas,tarea from seguimientos where idresidentes='$idresidentes'";	

$result1=mysqli_query($con,$queryu);

while ($resultax = mysqli_fetch_array($result1)) {
$fecha=$resultax['fecha'];
$hora=$resultax['hora'];
$resumen=$resultax['resumen'];
$evaluacion=$resultax['evaluacion'];
$tecnicas=$resultax['tecnicas'];
$tarea=$resultax['tarea'];
?>
<tr>
<td><?php echo $fecha; echo "<br>"; echo $hora; ?></td>
<td><?php echo $resumen; ?></td>
<td><?php echo $evaluacion; ?></td>
<td><?php echo $tecnicas; ?></td>
<td><?php echo $tarea; ?></td>
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
