<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["sadmin"]==true){

$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
$apellidosess=$_SESSION["apellido"];
	
include_once('bas/conn.php');
include("menusadmin.html");

$hoy = date("y-m-d"); 
$iduniformes=$_REQUEST['id'];
?>

<div class="container">
<div class="jumbotron">
<br>
<center><h1>Edición de datos uniformes</h1></center>
<br><br>
<?php
mysqli_set_charset($con,"utf8");
	
$result1=mysqli_query($con,"select iduniformes,nombresr,apellidosr,fechacobro,valorcobro from uniformes join residentes on uniformes.idresidentes=residentes.idresidentes where 
iduniformes=$iduniformes;");

while ($resultx = mysqli_fetch_array($result1)) {
$nombresr=$resultx['nombresr'];
$apellidosr=$resultx['apellidosr'];
$fechacobro=$resultx['fechacobro'];
$valorcobro=$resultx['valorcobro'];
$nomresidentes="$nombresr"." "."$apellidosr";
?>
<form id="pago" action = "editpunif.php" method = "post">
<table class="display" cellspacing="0" width="100%">
<thead>
    <tr>
<th>Residente</th>
<th>Fecha cobro</th>
<th>Valor cobro</th>
<th>Enviar</th>
    </tr>
</thead>
<tfoot>
    <tr>
<th>Residente</th>
<th>Fecha cobro</th>
<th>Valor cobro</th>
<th>Enviar</th>
    </tr>	
</tfoot>
<tr>
<td><?php echo "$nomresidentes"; ?></td>
<td><input type="date" value='<?php echo "$fechacobro"; ?>' id="fechac" name="fechac"></input></td>
<td><input type="number" value='<?php echo "$valorcobro"; ?>' id="valorc" name="valorc"></input></td>
<input type="hidden" id="iduniformes" name="iduniformes" value="<?php echo $iduniformes; ?>"/>
<td><button type="submit" class="btn btn-danger">Enviar</button></td>
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
