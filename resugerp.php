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
<th>Sugerencia</th>
<th>Sugerido por</th>
<th>Estado</th>
<th>Reportar</th>
    </tr>
</thead>
<tfoot>
    <tr>
<th>Fecha</th>
<th>Hora</th>
<th>Residente</th>
<th>Sugerencia</th>
<th>Sugerido por</th>
<th>Estado</th>
<th>Reportar</th>
    </tr>
</tfoot>			

<tbody>

<?php
mysqli_set_charset($con,"utf8");
	
$result1=mysqli_query($con,"SELECT idsugeridos,fecha,hora,sugerencia,sugeridos.estado as estado,nombresr,apellidosr,nombres,apellidos FROM sugeridos join residentes on sugeridos.idresidentes=residentes.idresidentes join usuarios on sugeridos.idespecialista=usuarios.idusuarios where sugeridos.idsugiere='$iduser' and sugeridos.estado='E'");

while ($resultx = mysqli_fetch_array($result1)) {
$idsugeridos=$resultx['idsugeridos'];
$fecha=$resultx['fecha'];
$hora=$resultx['hora'];
$sugerencia=$resultx['sugerencia'];
$nomr=$resultx['nombresr'];
$apelr=$resultx['apellidosr'];
$nom=$resultx['nombres'];
$apel=$resultx['apellidos'];
$nomres="$nomr"." "."$apelr";
$nomesp="$nom"." "."$apel";
?>
<tr>
<form id="pago" action = "cierresugerp.php" method = "post">
<td><?php echo "$fecha"; ?></td>
<td><?php echo "$hora"; ?></td>
<td><?php echo "$nomres"; ?></td>
<td><?php echo "$sugerencia"; ?></td>
<td><?php echo "$nomesp"; ?></td>
<td><select id="valorinicial" name="valorinicial">
<option value="E">En espera</option>
<option value="L">Leido</option>
</select></td>
<input type="hidden" id="idcobro" name="idcobro" value="<?php echo $idsugeridos; ?>"/>
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
