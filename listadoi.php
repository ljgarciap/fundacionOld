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
<th>Residente</th>
<th>Documento</th>
<th>Fundación</th>
<th>Fecha Retiro</th>
<th>Motivo Retiro</th>
<th>Opciones</th>
    </tr>
</thead>
<tfoot>
    <tr>
<th>Residente</th>	
<th>Documento</th>
<th>Fundación</th>
<th>Fecha Retiro</th>
<th>Motivo Retiro</th>
<th>Opciones</th>
    </tr>
</tfoot>			

<tbody>

<?php
mysqli_set_charset($con,"utf8");
	
$result1=mysqli_query($con,"select residentes.idresidentes as idr, residentes.tipodocumento as tipor, residentes.documentor as cedr, residentes.nombresr as nomr, residentes.apellidosr as apelr, residentes.nomfund as nomfund, residentes.estado as estado, asociacion.idasociacion as idas, historiali.fecharetiro as fecharetiro, historiali.idhistoriali as idhistoriali, historiali.motivo as motivor from residentes join asociacion on asociacion.idresidentes = residentes.idresidentes join historiali on historiali.idresidentes=residentes.idresidentes join usuarios on asociacion.idusuarios = usuarios.idusuarios where residentes.estado='I' and historiali.idhistoriali IN (select max(idhistoriali) from historiali group by idresidentes) order by nomr ASC");

while ($resultx = mysqli_fetch_array($result1)) {
$idr=$resultx['idr'];
$tipor=$resultx['tipor'];
$cedr=$resultx['cedr'];
$nomr=$resultx['nomr'];
$apelr=$resultx['apelr'];
$nomfund=$resultx['nomfund'];
$idas=$resultx['idas'];
$fecharetiro=$resultx['fecharetiro'];
$motivor=$resultx['motivor'];
$idhistoriali=$resultx['idhistoriali'];
$estado=$resultx['estado'];

$url2="editar.php?idr=$idr";

if($estado==="A"){
$estad="Activo";	
}
else{
$estad="Inactivo";	
}

if($nomfund==="FUNDACIÓN JESÚS ES MI ROCA"){
$url="detallef.php?idresidente=$idr";	
}
else{
$url="detallej.php?idresidente=$idr";	
}

$urlfu="editarmotivo.php?idh=$idhistoriali";
$urlestado="cambiare.php?idr=$idr&estado=$estado";
?>
<tr>
<td><?php echo "$nomr"." "."$apelr"; ?></td>
<td><?php echo "$tipor"." "."$cedr"; ?></td>
<td><?php echo "$nomfund"; ?></td>
<td><?php echo "$fecharetiro"; ?></td>
<td><?php echo "$motivor"; ?></td>
<td>
<select size="1" name="links" onchange="window.location.href=this.value;">
<option value="#">Click en la opción</option> 
<option value="<?php echo "$url"; ?>">Ver formularios</option>
<option value="<?php echo "$url2"; ?>">Editar residente</option> 
<option value="<?php echo "$urlfu"; ?>">Editar motivo</option>
<option value="<?php echo "$urlestado"; ?>">Reactivar</option>
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