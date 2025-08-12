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
<th>Encargado</th>
<th>Residente</th>
<th>Estado</th>
    </tr>
</thead>
<tfoot>
    <tr>
<th>Fecha</th>
<th>Hora</th>
<th>Encargado</th>
<th>Residente</th>
<th>Estado</th>
    </tr>
</tfoot>			

<tbody>

<?php
mysqli_set_charset($con,"utf8");
	
$result1=mysqli_query($con,"select agenda.fecha as fecha, agenda.hora as hora, agenda.encargado as encargado, agenda.estado as estado, agenda.idresidentes as idresidentes, residentes.nombresr as nombres, residentes.apellidosr as apellidos from agenda join residentes on agenda.idresidentes=residentes.idresidentes where agenda.encargado='PSICOLOGA' order by hora asc;");

while ($resultx = mysqli_fetch_array($result1)) {
$fecha=$resultx['fecha'];
$hora=$resultx['hora'];
$encargado=$resultx['encargado'];
$nomr=$resultx['nombres'];
$apelr=$resultx['apellidos'];
$estado=$resultx['estado'];
$idresidentes="$nomr"." "."$apelr";

if($estado=='E'){$estadox="En espera";}
else if($estado=='N'){$estadox="No asistió";}
else if($estado=='A'){$estadox="Atendido";}
?>
<tr>
<td><?php echo "$fecha"; ?></td>
<td><?php echo "$hora"; ?></td>
<td><?php echo "$encargado"; ?></td>
<td><?php echo "$idresidentes"; ?></td>
<td><?php echo "$estadox"; ?></td>
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
