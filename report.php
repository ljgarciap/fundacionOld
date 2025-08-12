<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["psico"]==true){

$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
$apellidosess=$_SESSION["apellido"];
	
include_once('bas/conn.php');
include("menupsico.html");
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
<th>Formato</th>
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
<th>Formato</th>
    </tr>
</tfoot>			

<tbody>

<?php
mysqli_set_charset($con,"utf8");
	
$result1=mysqli_query($con,"select terapiap.idterapiap,terapiap.fecha as fecha, terapiap.hora as hora,terapiap.evaluacion as evaluacion,terapiap.trabajo as trabajo, terapiap.tarea as tarea,terapiap.idresidentes as idresidentes,residentes.nombresr as nombres,residentes.apellidosr as apellidos,residentes.nomfund from terapiap join residentes on terapiap.idresidentes=residentes.idresidentes;");

while ($resultx = mysqli_fetch_array($result1)) {
$fecha=$resultx['fecha'];
$hora=$resultx['hora'];
$evaluacion=$resultx['evaluacion'];
$trabajo=$resultx['trabajo'];
$tarea=$resultx['tarea'];
$idterapiap=$resultx['idterapiap'];
$nomfund=$resultx['nomfund'];
$nomr=$resultx['nombres'];
$apelr=$resultx['apellidos'];
$idresidentes="$nomr"." "."$apelr";
if($nomfund=="FUNDACIÓN JESÚS ES MI ROCA"){$url="impterapiap.php?idt=$idterapiap";}
else if($nomfund=="CENTRO JOREC"){$url="impterapiapj.php?idt=$idterapiap";}
?>
<tr>
<td><?php echo "$fecha"; ?></td>
<td><?php echo "$hora"; ?></td>
<td><?php echo "$idresidentes"; ?></td>
<td><?php echo "$evaluacion"; ?></td>
<td><?php echo "$trabajo"; ?></td>
<td><?php echo "$tarea"; ?></td>
<td><a href="<?php echo $url; ?>" target="blank">Imprimir terapia</a></td>
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
