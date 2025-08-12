<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["admin"]==true){

$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
$apellidosess=$_SESSION["apellido"];
	
include_once('bas/conn.php');
include("menuadmin.html");

$hoy = date("y-m-d"); 

$yhoy=date("y");
$mhoy=date("m");
$dhoy=date("d");
$mhoy=($mhoy-1);
$fechamin="20$yhoy-$mhoy-$dhoy";

$idcobrospension=$_REQUEST['id'];
?>

<div class="container">
<div class="jumbotron">
<br>
<center><h1>Abonar a pensión</h1></center>
<br><br>
<?php
mysqli_set_charset($con,"utf8");
	
$result1=mysqli_query($con,"select nombresr,apellidosr,diacobro,valorcobro from cobrospension join residentes on cobrospension.idresidentes=residentes.idresidentes where 
idcobrospension=$idcobrospension;");

while ($resultx = mysqli_fetch_array($result1)) {
$nombresr=$resultx['nombresr'];
$apellidosr=$resultx['apellidosr'];
$diacobro=$resultx['diacobro'];
$valorcobro=$resultx['valorcobro'];
$nomresidentes="$nombresr"." "."$apellidosr";
?>
<form id="pago" action = "pagopensionesa.php" method = "post">
<table class="display" cellspacing="0" width="100%">
<thead>
    <tr>
<th>Dia</th>
<th>Residente</th>
<th>Fecha abono</th>
<th>Valor abono</th>
<th>Comentario</th>
<th>Acción</th>
<th>Ver</th>
    </tr>
</thead>
<tr>
<td><?php echo "$diacobro"; ?></td>
<td><?php echo "$nomresidentes"; ?></td>
<td><input type="date" value='<?php echo "20$hoy"; ?>' min="<?php echo $fechamin; ?>" id="fechaa" name="fechaa"></input></td>
<td><input type="number" id="valora" name="valora"></input></td>
<td><input type="text" id="comentario" name="comentario"></input></td>
<input type="hidden" id="idcobrospension" name="idcobrospension" value="<?php echo $idcobrospension; ?>"/>
<td><button type="submit" class="btn btn-danger">Enviar</button></td>
<td><a href="labonospension.php?id=<?php echo $idcobrospension; ?>" target="blank">Listado</a></td>
</tr>
</table>
</form>
<?php
}
?>

</div>
</div>
<?php
include("footersadmin.html");
}
else {
header("Location:index.php");
}
?>
