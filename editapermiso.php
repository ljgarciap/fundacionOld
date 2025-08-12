<!DOCTYPE html>
<html lang="es" class="no-js">

<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["sadmin"]==true){

$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
$apellidosess=$_SESSION["apellido"];

$idt=$_REQUEST['idt'];	
	
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

<?php
mysqli_set_charset($con,"utf8");

$queryu="select residentes.idresidentes,residentes.nombresr,residentes.apellidosr,permisos.idpermisos,
permisos.motivo,permisos.fechasalida,permisos.fechaingreso,permisos.observaciones from permisos join residentes on permisos.idresidentes=residentes.idresidentes where permisos.idpermisos=$idt;
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
$idr=$resultx['idresidentes'];
}
?>
<br>
<center><h2>Editar permiso <?php echo $nombre; ?></h2></center>
<br>
<center>
<div class="row">
<form id="permison" action = "editap.php" method = "get"> 
<div class="col-md-2">
<label>Fecha Salida:</label>
<input type="date" id="fechas" name="fechas" value="<?php echo $fechasalida; ?>" class="form-control input-sm chat-input" required/>
</div>
<div class="col-md-3">
<label>Motivo:</label>
<input type="text" id="mot" name="mot" class="form-control input-sm chat-input" value="<?php echo $motivo; ?>"></input>
</div>
<div class="col-md-2">
<label>Fecha Ingreso:</label>
<input type="date" id="fechai" name="fechai" value="<?php echo $fechaentrada; ?>"  class="form-control input-sm chat-input"/>
</div>
<div class="col-md-3">
<label>Observaciones:</label>
<input type="text" id="obs" name="obs" class="form-control input-sm chat-input" value="<?php echo $observaciones; ?>"></input>
</div>
<input type="hidden" id="idresidentes" name="idresidentes" value="<?php echo $idr; ?>"/>
<input type="hidden" id="idpermisos" name="idpermisos" value="<?php echo $idpermisos; ?>"/>
<div class="wrapper col-md-2"><br>
<button type="submit" class="btn btn-danger">Actualizar</button>          
</div>
</form>
</div></center>
<br><br>
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
