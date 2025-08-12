<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["planta"]==true){

$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
$apellidosess=$_SESSION["apellido"];

$iduser=$_SESSION["cons"];
	
include_once('bas/conn.php');
include("menuplanta.html");
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
<th>Estado</th>
<th>Reportar</th>
    </tr>
</thead>
<tfoot>
    <tr>
<th>Fecha</th>
<th>Hora</th>
<th>Residente</th>
<th>Estado</th>
<th>Reportar</th>
    </tr>
</tfoot>			

<tbody>

<?php
mysqli_set_charset($con,"utf8");
	
$result1=mysqli_query($con,"select agenda.idagenda as idagenda,agenda.fecha as fecha, agenda.hora as hora, agenda.estado as estado, agenda.idresidentes as idresidentes, residentes.nombresr as nombres, residentes.apellidosr as apellidos from agenda join residentes on agenda.idresidentes=residentes.idresidentes where agenda.idusuarios='$iduser' and agenda.estado='E' order by hora asc;");

while ($resultx = mysqli_fetch_array($result1)) {
$fecha=$resultx['fecha'];
$hora=$resultx['hora'];
$nomr=$resultx['nombres'];
$apelr=$resultx['apellidos'];
$idagenda=$resultx['idagenda'];
$idresidentes="$nomr"." "."$apelr";
?>
<tr>
<form id="pago" action = "cierreage.php" method = "post">
<td><?php echo "$fecha"; ?></td>
<td><?php echo "$hora"; ?></td>
<td><?php echo "$idresidentes"; ?></td>
<td><select id="valorinicial" name="valorinicial">
<option value="E">En espera</option>
<option value="A">Atendido</option>
<option value="N">No asistió</option>
</select></td>
<input type="hidden" id="idcobro" name="idcobro" value="<?php echo $idagenda; ?>"/>
<td><button type="submit" class="btn btn-danger">Reportar</button> </td>
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
