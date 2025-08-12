<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["sadmin"]==true){

$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
$apellidosess=$_SESSION["apellido"];
	
include_once('bas/conn.php');
include("menutere.html");
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
<th>Hora</th>
<th>Residente</th>
<th>Evaluación</th>
<th>Técnicas</th>
<th>Tarea</th>
<th>Profesional</th>
    </tr>
</thead>
<tfoot>
    <tr>
<th>Fecha</th>
<th>Hora</th>
<th>Residente</th>
<th>Evaluación</th>
<th>Técnicas</th>
<th>Tarea</th>
<th>Profesional</th>
    </tr>
</tfoot>			

<tbody>

<?php
mysqli_set_charset($con,"utf8");
	
$result1=mysqli_query($con,"SELECT seguimientos.fecha AS fecha,seguimientos.hora AS hora,seguimientos.resumen AS resumen,seguimientos.evaluacion AS evaluacion,
seguimientos.tecnicas AS tecnicas,seguimientos.tarea AS tarea,CONCAT(residentes.nombresr,' ',residentes.apellidosr) AS nomres,CONCAT(usuarios.nombres,' ',usuarios.apellidos) AS nomprof 
FROM seguimientos JOIN residentes ON seguimientos.idresidentes=residentes.idresidentes 
JOIN usuarios ON seguimientos.idusuarios=usuarios.idusuarios ORDER BY seguimientos.fecha DESC;");


while ($resultx = mysqli_fetch_array($result1)) {
$fecha=$resultx['fecha'];
$hora=$resultx['hora'];
$evaluacion=$resultx['evaluacion'];
$tecnicas=$resultx['tecnicas'];
$tarea=$resultx['tarea'];
$nomr=$resultx['nomres'];
$nomp=$resultx['nomprof'];
?>
<tr>
<td><?php echo "$fecha"; ?></td>
<td><?php echo "$hora"; ?></td>
<td><?php echo "$nomr"; ?></td>
<td><?php echo "$evaluacion"; ?></td>
<td><?php echo "$tecnicas"; ?></td>
<td><?php echo "$tarea"; ?></td>
<td><?php echo "$nomp"; ?></td>
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
