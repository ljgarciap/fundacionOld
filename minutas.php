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
<th>Documento visitante</th>
<th>Nombre visitante</th>
<th>Residente</th>
<th>Asunto</th>
    </tr>
</thead>
<tfoot>
    <tr>
<th>Fecha</th>
<th>Documento visitante</th>
<th>Nombre visitante</th>
<th>Residente</th>
<th>Asunto</th>
    </tr>
</tfoot>			

<tbody>

<?php
mysqli_set_charset($con,"utf8");
	
$result1=mysqli_query($con,"select minutas.idminutas as idminutas,minutas.fecha as fecha,minutas.cedula as cedula,minutas.visitante as visitante,minutas.asunto as asunto,residentes.nombresr as nomr,residentes.apellidosr as apelr from minutas join residentes on minutas.idresidentes=residentes.idresidentes");

while ($resultx = mysqli_fetch_array($result1)) {
$idminutas=$resultx['idminutas'];
$fecha=$resultx['fecha'];
$visitante=$resultx['visitante'];
$cedula=$resultx['cedula'];
$nomr=$resultx['nomr'];
$apelr=$resultx['apelr'];
$asunto=$resultx['asunto'];
$idresidentes="$nomr"." "."$apelr";
?>
<tr>
<td><?php echo "$fecha"; ?></td>
<td><?php echo "$cedula"; ?></td>
<td><?php echo "$visitante"; ?></td>
<td><?php echo "$idresidentes"; ?></td>
<td><?php echo "$asunto"; ?></td>
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
