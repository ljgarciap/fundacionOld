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
<th>Colider</th>
<th>Residente</th>
<th>Fallas</th>
<th>Observaciones</th>
<th>Ayudas</th>
<th>Editar</th>
<th>Imprimir</th>
    </tr>
</thead>
<tfoot>
    <tr>
<th>Fecha</th>
<th>Colider</th>
<th>Residente</th>
<th>Fallas</th>
<th>Observaciones</th>
<th>Ayudas</th>
<th>Editar</th>
<th>Imprimir</th>
    </tr>
</tfoot>			

<tbody>

<?php
mysqli_set_charset($con,"utf8");
	
$result1=mysqli_query($con,"select terapiac.idterapiac as idterapia,terapiac.fecha as fecha, terapiac.colider as colider, terapiac.fallas as fallas, terapiac.observaciones as observaciones, terapiac.ayudas as ayudas, terapiac.idresidentes as idresidentes, residentes.nombresr as nombres, residentes.apellidosr as apellidos from terapiac join residentes on terapiac.idresidentes=residentes.idresidentes order by fecha desc");

while ($resultx = mysqli_fetch_array($result1)) {
$fecha=$resultx['fecha'];
$hora=$resultx['colider'];
$evaluacion=$resultx['fallas'];
$trabajo=$resultx['observaciones'];
$tarea=$resultx['ayudas'];
$nomr=$resultx['nombres'];
$apelr=$resultx['apellidos'];
$idt=$resultx['idterapia'];
$idresidentes="$nomr"." "."$apelr";
?>
<tr>
<form id="pago" action = "editarconf.php" method = "post">
<td><?php echo "$fecha"; ?></td>
<td><?php echo "$hora"; ?></td>
<td><?php echo "$idresidentes"; ?></td>
<td><?php echo "$evaluacion"; ?></td>
<td><textarea id="observaciones" name="observaciones" cols="30" rows="8"><?php echo "$trabajo"; ?></textarea></td>
<td><textarea id="ayudas" name="ayudas" cols="30" rows="8"><?php echo "$tarea"; ?></textarea></td>
<input type="hidden" id="idterapias" name="idterapias" value="<?php echo $idt; ?>"/>
<td><button type="submit" class="btn btn-danger">Editar</button> </td>
</form>
<td><a href="imprimiray.php?idterapias=<?php echo $idt; ?>" target="blank">Imprimir</a></td>
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
