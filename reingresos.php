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
<th>Documento</th>
<th>Residente</th>
<th>Estado</th>
<th>Fundación</th>
<th>Ingreso</th>
<th>Retiro</th>
<th>Motivo</th>
    </tr>
</thead>
<tfoot>
    <tr>
<th>Documento</th>
<th>Residente</th>
<th>Estado</th>
<th>Fundación</th>
<th>Ingreso</th>
<th>Retiro</th>
<th>Motivo</th>
    </tr>
</tfoot>			

<tbody>

<?php
mysqli_set_charset($con,"utf8");
	
$result1=mysqli_query($con,"select residentes.tipodocumento as tipod,residentes.documentor as docr,residentes.nombresr as nomr,residentes.apellidosr as apelr,residentes.estado as est,residentes.nomfund as nomfund,historiali.fechaingreso as fechai,historiali.fecharetiro as fechar,historiali.motivo as motivor from residentes join historiali on residentes.idresidentes=historiali.idresidentes where historiali.fecharetiro!='0000-00-00';");

while ($resultx = mysqli_fetch_array($result1)) {
$tipod=$resultx['tipod'];
$docr=$resultx['docr'];
$nomr=$resultx['nomr'];
$apelr=$resultx['apelr'];
$est=$resultx['est'];
$nomfund=$resultx['nomfund'];
$fechai=$resultx['fechai'];
$fechar=$resultx['fechar'];
$motivo=$resultx['motivor'];

if($est==="A"){
$estad="Activo";	
}
else{
$estad="Inactivo";	
}
?>
<tr>
<td><?php echo "$tipod"." "."$docr"; ?></td>
<td><?php echo "$nomr"." "."$apelr"; ?></td>
<td><?php echo "$estad"; ?></td>
<td><?php echo "$nomfund"; ?></td>
<td><?php echo "$fechai"; ?></td>
<td><?php echo "$fechar"; ?></td>
<td><?php echo "$motivo"; ?></td>
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
