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
<th>Hora</th>
<th>Residente</th>
<th>Evaluación</th>
<th>Trabajo</th>
<th>Tarea</th>
<th>Practicante</th>
    </tr>
</thead>
<tfoot>
    <tr>
<th>Fecha</th>
<th>Hora</th>
<th>Residente</th>
<th>Evaluación</th>
<th>Trabajo</th>
<th>Tarea</th>
<th>Practicante</th>
    </tr>
</tfoot>			

<tbody>

<?php
mysqli_set_charset($con,"utf8");
	
$result1=mysqli_query($con,"select terapiae.fecha as fecha, terapiae.hora as hora, terapiae.evaluacion as evaluacion, terapiae.trabajo as trabajo, terapiae.tarea as tarea, terapiae.idresidentes as idresidentes, residentes.nombresr as nombres, residentes.apellidosr as apellidos, usuarios.nombres as nomu, usuarios.apellidos as apu from terapiae join residentes on terapiae.idresidentes=residentes.idresidentes join usuarios on terapiae.idusuarios=usuarios.idusuarios;");

while ($resultx = mysqli_fetch_array($result1)) {
$fecha=$resultx['fecha'];
$hora=$resultx['hora'];
$evaluacion=$resultx['evaluacion'];
$trabajo=$resultx['trabajo'];
$tarea=$resultx['tarea'];
$nomr=$resultx['nombres'];
$apelr=$resultx['apellidos'];
$nomu=$resultx['nomu'];
$apu=$resultx['apu'];
$idresidentes="$nomr"." "."$apelr";
$idpracticante="$nomu"." "."$apu";
?>
<tr>
<td><?php echo "$fecha"; ?></td>
<td><?php echo "$hora"; ?></td>
<td><?php echo "$idresidentes"; ?></td>
<td><?php echo "$evaluacion"; ?></td>
<td><?php echo "$trabajo"; ?></td>
<td><?php echo "$tarea"; ?></td>
<td><?php echo "$idpracticante"; ?></td>
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
