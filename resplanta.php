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
<th>Resumen</th>
<th>Evaluacion</th>
<th>Técnicas</th>
<th>Tarea</th>
<th>Orientador</th>
    </tr>
</thead>
<tfoot>
    <tr>
<th>Fecha</th>
<th>Hora</th>
<th>Residente</th>
<th>Resumen</th>
<th>Evaluacion</th>
<th>Técnicas</th>
<th>Tarea</th>
<th>Orientador</th>
    </tr>
</tfoot>			

<tbody>

<?php
mysqli_set_charset($con,"utf8");
$result1=mysqli_query($con,"select seguimientos.idseguimientos,seguimientos.fecha as fecha, seguimientos.hora as hora,seguimientos.resumen as resumen,seguimientos.evaluacion as evaluacion,seguimientos.tecnicas as tecnicas, seguimientos.tarea as tarea,seguimientos.idresidentes as idresidentes,seguimientos.idusuarios as idusuarios, residentes.nombresr as nombres,usuarios.nombres as nombresor,residentes.apellidosr as apellidos,usuarios.apellidos as apellidosor, residentes.nomfund from seguimientos join residentes on seguimientos.idresidentes=residentes.idresidentes join usuarios on seguimientos.idusuarios=usuarios.idusuarios;");
while ($resultx = mysqli_fetch_array($result1)) {
$fecha=$resultx['fecha'];
$hora=$resultx['hora'];
$resumen=$resultx['resumen'];
$evaluacion=$resultx['evaluacion'];
$tecnicas=$resultx['tecnicas'];
$tarea=$resultx['tarea'];
$idseguimientos=$resultx['idseguimientos'];
$idusuarios=$resultx['idusuarios'];
$nomfund=$resultx['nomfund'];
$nomr=$resultx['nombres'];
$apelr=$resultx['apellidos'];
$idresidentes="$nomr"." "."$apelr";
$nomor=$resultx['nombresor'];
$apelor=$resultx['apellidosor'];
$idorientador="$nomor"." "."$apelor";
if($nomfund=="FUNDACIÓN JESÚS ES MI ROCA"){$url="impterapiap.php?idt=$idseguimientos";}
else if($nomfund=="CENTRO JOREC"){$url="impterapiapj.php?idt=$idseguimientos";}
?>

<tr>
<td><?php echo "$fecha"; ?></td>
<td><?php echo "$hora"; ?></td>
<td><?php echo "$idresidentes"; ?></td>
<td><?php echo "$resumen"; ?></td>
<td><?php echo "$evaluacion"; ?></td>
<td><?php echo "$tecnicas"; ?></td>
<td><?php echo "$tarea"; ?></td>
<td><?php echo "$idorientador"; ?></td>
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
