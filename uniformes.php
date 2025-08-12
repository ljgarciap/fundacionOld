<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["sadmin"]==true){

$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
$apellidosess=$_SESSION["apellido"];
	
include_once('bas/conn.php');
include("menusadmin.html");

$hoy = date("y-m-d"); 
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
<th>Residente</th>
<th>Antiguo</th>
<th>Nuevo</th>
<th>Visita</th>
<th>Buzo</th>
<th>Valor inicial</th>
<th>Observaciones</th>
<th>Acción</th>
<th>Opciones</th>
    </tr>
</thead>
<tfoot>
    <tr>
<th>Residente</th>
<th>Antiguo</th>
<th>Nuevo</th>
<th>Visita</th>
<th>Buzo</th>
<th>Valor inicial</th>
<th>Observaciones</th>
<th>Acción</th>
<th>Opciones</th>
    </tr>
</tfoot>			

<tbody>

<?php
mysqli_set_charset($con,"utf8");
	
$result1=mysqli_query($con,"select iduniformes,fechacobro,nuevo,antiguo,visita,buzo,valorcobro,comentario,nombresr,apellidosr from uniformes join residentes on uniformes.idresidentes=residentes.idresidentes;");

while ($resultx = mysqli_fetch_array($result1)) {
$iduniformes=$resultx['iduniformes'];
$diacobro=$resultx['fechacobro'];
$nuevo=$resultx['nuevo'];
$antiguo=$resultx['antiguo'];
$visita=$resultx['visita'];
$buzo=$resultx['buzo'];
$valorcobro=$resultx['valorcobro'];
$nomr=$resultx['nombresr'];
$apelr=$resultx['apellidosr'];
$observaciones=$resultx['comentario'];
$idresidentes="$nomr"." "."$apelr";
?>
<tr>
<form id="pago" action = "pagouniformes.php" method = "post">
<td><?php echo "$idresidentes"; ?></td>
<td><select name="antiguo">
<option value="<?php echo "$antiguo"; ?>"><?php echo "$antiguo"; ?></option>
<option value="Entregado">Entregado</option>
<option value="Pendiente">Pendiente</option>
</select></td>
<td><select name="nuevo">
<option value="<?php echo "$nuevo"; ?>"><?php echo "$nuevo"; ?></option>
<option value="Entregado">Entregado</option>
<option value="Pendiente">Pendiente</option>
</select></td>
<td><select name="visita">
<option value="<?php echo "$visita"; ?>"><?php echo "$visita"; ?></option>
<option value="Entregado">Entregado</option>
<option value="Pendiente">Pendiente</option>
</select></td>
<td><select name="buzo">
<option value="<?php echo "$buzo"; ?>"><?php echo "$buzo"; ?></option>
<option value="Entregado">Entregado</option>
<option value="Pendiente">Pendiente</option>
</select></td>
<td><?php echo "$valorcobro"; ?></td>
<td><textarea id="observaciones" name="observaciones" cols="20" rows="2"><?php echo "$observaciones"; ?></textarea></td>
<td><button type="submit" class="btn btn-danger">Enviar</button></td>
<input type="hidden" id="idcobro" name="idcobro" value="<?php echo $iduniformes; ?>"/>
</form>
<td>
<select size="1" name="links" onchange="window.location.href=this.value;">
<option value="#">Click en la opción</option> 
<option value="editarunif.php?id=<?php echo $iduniformes; ?>">Cambiar valor</option>
<option value="labonosu.php?id=<?php echo $iduniformes; ?>">Ver abonos</option> 
<option value="abonosu.php?id=<?php echo $iduniformes; ?>">Realizar abono</option>
</select>
</td>
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
