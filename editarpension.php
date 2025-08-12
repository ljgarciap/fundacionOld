<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["sadmin"]==true){

$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
$apellidosess=$_SESSION["apellido"];
	
include_once('bas/conn.php');
include("menusadmin.html");

$hoy = date("y-m-d"); 
$idcobrospension=$_REQUEST['id'];
?>

<div class="container">
<div class="jumbotron">
<br>
<center><h1>Edición de datos pensión</h1></center>
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
<form id="pago" action = "editppension.php" method = "post">
<table class="display" cellspacing="0" width="100%">
<thead>
    <tr>
<th>Residente</th>
<th>Dia cobro</th>
<th>Valor cobro</th>
<th>Acción</th>
    </tr>
</thead>
<tr>
<td><?php echo "$nomresidentes"; ?></td>
<td><input type="number" value='<?php echo "$diacobro"; ?>' id="fechac" name="fechac"></input></td>
<td><input type="number" value='<?php echo "$valorcobro"; ?>' id="valorc" name="valorc"></input></td>
<input type="hidden" id="iduniformes" name="iduniformes" value="<?php echo $idcobrospension; ?>"/>
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
