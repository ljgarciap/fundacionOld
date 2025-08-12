<!DOCTYPE html>
<html lang="es" class="no-js">

<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["sadmin"]==true){

$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
$apellidosess=$_SESSION["apellido"];

$idr=$_REQUEST['idr'];	
	
header ("Expires: Fri, 14 Mar 1980 20:53:00 GMT"); //la pagina expira en fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache"); //PARANOIA, NO GUARDAR EN CACHE 

include_once('bas/conn.php');
include("menusadmin.html");

$hoy = date("y-m-d");
$fecham="20$hoy"; 
?>
<div id="preloader">
<br><br><br><br>
<center><img src="images/loader.gif" width="40%"/></center>
    <div id="loader">&nbsp;</div>
</div>

<div class="container">
<div class="jumbotron">
<center>
<div class="table-responsive">
<table id="tabla" class="display" cellspacing="0" width="100%">

<thead>
    <tr>
<th>Residente</th>
<th>Salida</th>
<th>Motivo</th>
<th>Entrada</th>
<th>Observaciones</th>
    </tr>
</thead>
<tfoot>
    <tr>
<th>Residente</th>
<th>Salida</th>
<th>Motivo</th>
<th>Entrada</th>
<th>Observaciones</th>
    </tr>
</tfoot>			

<tbody>

<?php
mysqli_set_charset($con,"utf8");
?>

<center><h2>Registro de salidas</h2></center>

<?php
$queryu="select residentes.nombresr,residentes.apellidosr,permisos.idpermisos,permisos.motivo,
permisos.fechasalida,permisos.fechaingreso,permisos.observaciones from permisos join residentes on permisos.idresidentes=residentes.idresidentes where permisos.idresidentes=$idr order by permisos.fechasalida;
";	

//echo "$queryu";

$result1=mysqli_query($con,$queryu);

while ($resultx = mysqli_fetch_array($result1)) {
$nombresr=$resultx['nombresr'];
$apellidosr=$resultx['apellidosr'];
$nombre="$nombresr"." "."$apellidosr";
$motivo=$resultx['motivo'];
$fechasalida=$resultx['fechasalida'];
$fechaentrada=$resultx['fechaingreso'];
$observaciones=$resultx['observaciones'];
$idpermisos=$resultx['idpermisos'];
?>
<tr>
<td><a href='editapermiso.php?idt=<?php echo "$idpermisos"; ?>'><?php echo "$nombre"; ?></a></td>
<td><?php echo "$fechasalida"; ?></td>
<td><?php echo "$motivo"; ?></td>
<td><?php echo "$fechaentrada"; ?></td>
<td><?php echo "$observaciones"; ?></td>
</tr>
<?php
}
?>
</tbody>

</table>
</div>
</center>
<br>
<center><h2>Nuevo permiso</h2></center>
<br>
<center>
<div class="row">
<form id="permison" action = "permison.php" method = "get"> 
<div class="col-md-2">
<label>Fecha Salida:</label>
<input type="date" id="fechas" name="fechas" min="2018-01-01" class="form-control input-sm chat-input" required/>
</div>
<div class="col-md-3">
<label>Motivo:</label>
<input type="text" id="mot" name="mot" class="form-control input-sm chat-input"></input>
</div>
<div class="col-md-2">
<label>Fecha Ingreso:</label>
<input type="date" id="fechai" name="fechai" min="2018-01-01" class="form-control input-sm chat-input"/>
</div>
<div class="col-md-3">
<label>Observaciones:</label>
<input type="text" id="obs" name="obs" class="form-control input-sm chat-input"></input>
</div>
<input type="hidden" id="idresidentes" name="idresidentes" value="<?php echo $idr; ?>"/>
<div class="wrapper col-md-2"><br>
<button type="submit" class="btn btn-danger">Registrar</button>          
</div>
</form>
</div></center>

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
