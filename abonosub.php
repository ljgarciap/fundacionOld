<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["bda"]==true){

$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
$apellidosess=$_SESSION["apellido"];
	
include_once('bas/conn.php');
include("menubda.html");

$hoy = date("y-m-d"); 
$iduniformes=$_REQUEST['id'];
?>

<div class="container">
<div class="jumbotron">
<br>
<center><h1>Abonar a uniformes</h1></center>
<br><br>
<?php
mysqli_set_charset($con,"utf8");
	
$result1=mysqli_query($con,"select nombresr,apellidosr,fechacobro,valorcobro from uniformes join residentes on uniformes.idresidentes=residentes.idresidentes where 
iduniformes=$iduniformes;");

while ($resultx = mysqli_fetch_array($result1)) {
$nombresr=$resultx['nombresr'];
$apellidosr=$resultx['apellidosr'];
$fechacobro=$resultx['fechacobro'];
$nomresidentes="$nombresr"." "."$apellidosr";
?>
<form id="pago" action = "crearabonoub.php" method = "post">
<table class="display" cellspacing="0" width="100%">
<thead>
    <tr>
<th>Residente</th>
<th>Fecha cobro</th>
<th>Fecha abono</th>
<th>Valor abono</th>
<th>Enviar</th>
<th>Ver abonos</th>
    </tr>
</thead>
<tfoot>
    <tr>
<th>Residente</th>
<th>Fecha cobro</th>
<th>Fecha abono</th>
<th>Valor abono</th>
<th>Enviar</th>
<th>Ver abonos</th>
    </tr>	
</tfoot>
<tr>
<td><?php echo "$nomresidentes"; ?></td>
<td><?php echo "$fechacobro"; ?></td>
<td><input type="date" value='<?php echo "20$hoy"; ?>' id="fechaa" name="fechaa"></input></td>
<td><input type="number" id="valora" name="valora"></input></td>
<input type="hidden" id="iduniformes" name="iduniformes" value="<?php echo $iduniformes; ?>"/>
<td><button type="submit" class="btn btn-danger">Enviar</button></td>
<td><a href="labonosub.php?id=<?php echo $iduniformes; ?>" target="blank">Listado</a></td>
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
