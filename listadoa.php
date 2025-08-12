<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["planta"]==true){

$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
$apellidosess=$_SESSION["apellido"];
	
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
<th>Documento</th>
<th>Residente</th>
<th>Eps</th>
<th>Fundación</th>
<th>Parentesco</th>
<th>Acudiente</th>
<th>Teléfono</th>
<th>Correo</th>
<th>Estado</th>
    </tr>
</thead>
<tfoot>
    <tr>
<th>Documento</th>
<th>Residente</th>
<th>Eps</th>
<th>Fundación</th>
<th>Parentesco</th>
<th>Acudiente</th>
<th>Teléfono</th>
<th>Correo</th>
<th>Estado</th>
    </tr>
</tfoot>			

<tbody>

<?php
mysqli_set_charset($con,"utf8");
	
$result1=mysqli_query($con,"select residentes.idresidentes as idr, residentes.tipodocumento as tipor, residentes.documentor as cedr, residentes.nombresr as nomr, residentes.apellidosr as apelr, residentes.estado as estr, residentes.eps as eps, residentes.nomfund as nomfund, residentes.estado as estado, asociacion.idasociacion as idas, asociacion.parentesco as parent, usuarios.idusuarios as idu, usuarios.documento as docu, usuarios.nombres as nomu, usuarios.apellidos as apelu, usuarios.telefono as telefono, usuarios.email as email from residentes join asociacion on asociacion.idresidentes = residentes.idresidentes join usuarios on asociacion.idusuarios = usuarios.idusuarios 
where residentes.estado='A' or residentes.estado='E'  order by nomr asc");

while ($resultx = mysqli_fetch_array($result1)) {
$idr=$resultx['idr'];
$tipor=$resultx['tipor'];
$cedr=$resultx['cedr'];
$nomr=$resultx['nomr'];
$apelr=$resultx['apelr'];
$estr=$resultx['estr'];
$eps=$resultx['eps'];
$nomfund=$resultx['nomfund'];
$idas=$resultx['idas'];
$parent=$resultx['parent'];
$idu=$resultx['idu'];
$docu=$resultx['docu'];
$nomu=$resultx['nomu'];
$apelu=$resultx['apelu'];
$telefono=$resultx['telefono'];
$email=$resultx['email'];
$estado=$resultx['estado'];

$urlfr="firmaca.php?idr=$idr&cedula=$cedr";
$urlfu="firmaca.php?idr=$idu&cedula=$docu";

if($estado==="A"){
$estad="Activo";	
}
else{
$estad="Inactivo";	
}

if($nomfund==="FUNDACIÓN JESÚS ES MI ROCA"){
$url="detallefa.php?idresidente=$idr";	
}
else{
$url="detalleja.php?idresidente=$idr";	
}
?>
<tr>
<td><?php echo "$tipor"." "."$cedr"; ?></td>
<td><a href="<?php echo "$url"; ?>" target="blank"><?php echo "$nomr"." "."$apelr"; ?></a></td>
<td><?php echo "$eps"; ?></td>
<td><a href="<?php echo "$urlfr"; ?>" target="blank"><?php echo "$nomfund"; ?></a></td>
<td><?php echo "$parent"; ?></td>
<td><a href="<?php echo "$urlfu"; ?>" target="blank"><?php echo "$nomu"." "."$apelu"; ?></a></td>
<td><?php echo "$telefono"; ?></td>
<td><?php echo "$email"; ?></td>
<td><?php echo "$estad"; ?></td>
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