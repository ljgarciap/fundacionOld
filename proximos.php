<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["bda"]==true){

$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
$apellidosess=$_SESSION["apellido"];
	
include_once('bas/conn.php');
include("menubda.html");

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
<center><h1>Próximos a cumplir (7 dias)</h1></center><br>	   

<thead>
    <tr>
<th>Residente</th>
<th>Dia de pago</th>
<th>Costo pensión</th>
<th>Valor pendiente</th>
<th>Acudiente</th>    
<th>Teléfono</th>
	</tr>
</thead>
<tbody>
<?php	
mysqli_set_charset($con,"utf8");
	
$resultx1=mysqli_query($con,"select idcobrospension,diacobro,valorcobro,nombresr,apellidosr,residentes.estado as estado,nomfund,nombres,apellidos,usuarios.telefono as telefono from cobrospension join residentes on cobrospension.idresidentes=residentes.idresidentes join asociacion on asociacion.idresidentes=residentes.idresidentes join usuarios on asociacion.idusuarios=usuarios.idusuarios where residentes.estado='A' or residentes.estado='E' order by diacobro asc");

while ($resultxx = mysqli_fetch_array($resultx1)) {
$xidcobrospension=$resultxx['idcobrospension'];
$xdiacobro=$resultxx['diacobro'];
$xvalorcobro=$resultxx['valorcobro'];
$xnomr=$resultxx['nombresr'];
$xnomfund=$resultxx['nomfund'];
$xapelr=$resultxx['apellidosr'];
$xidresidentes="$xnomr"." "."$xapelr";
$xnomu=$resultxx['nombres'];
$xapelu=$resultxx['apellidos'];
$xtelefono=$resultxx['telefono'];
$xidacudiente="$xnomu"." "."$xapelu";

$xultimovalor="SELECT sum(valorinicial) as valoriniciales,sum(abono) as abonos  FROM abonopensiones where idcobrospension='$xidcobrospension' ORDER by idabonopensiones DESC LIMIT 1";
$resultv1x=mysqli_query($con,"$xultimovalor");

		while ($resultvxx = mysqli_fetch_array($resultv1x)) {
		$xvaloriniciales=$resultvxx['valoriniciales'];
		$xabonos=$resultvxx['abonos'];
}
$xsaldos=($xvaloriniciales-$xabonos);
$xsaldos=$xsaldos;
$xvalorcobro=$xvalorcobro;
$diahoy = date("d");

if(($xvalorcobro>0) and (($diahoy<$xdiacobro) and ($diahoy>=$xdiacobro-7))){
?>
	
<tr>
<td><?php echo "$xidresidentes"; ?></td>
<td><center><?php echo "$xdiacobro"; ?></center></td>
<td><center><?php  echo "$ ".number_format($xvalorcobro, 0, ".", ".")."=";  ?></center></td>
<?php
if($xsaldos==0){
?>
<td><b  style="color:green;"><center><?php echo "$ ".number_format($xsaldos, 0, ".", ".")."="; ?></center></b></td>
<?php
}
else{
?>
<td><b  style="color:orange;"><center><?php echo "$ ".number_format($xsaldos, 0, ".", ".")."="; ?></center></b></td>
<?php
}
?>
<td><?php echo "$xidacudiente"; ?></td>
<td><?php echo "$xtelefono"; ?></td>
</tr>
<?php
}
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
