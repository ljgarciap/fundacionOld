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

<!-- Inicio ventana flotante aviso !-->

<div id='ventana-flotante'>

   <a class='cerrar' href='javascript:void(0);' onclick='document.getElementById(&apos;ventana-flotante&apos;).className = &apos;oculto&apos;'><b>X</b></a>

   <div id='contenedor'>

       <div class='contenido'>

<center><h1>Próximos a cumplir (7 dias)</h1></center><br>	   
	   
<table cellspacing="0" border="1" width="100%">

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

   </div>

</div>

<style>
#ventana-flotante {
width: 1100px;  /* Ancho de la ventana */
height: 500px;  /* Alto de la ventana */
background: rgba(255,255,255,0.8);  /* Color de fondo */
position: fixed;
overflow: auto: /* Esta es la clave del scroll*/
top: 70px;
left: 30%;
margin-left: -260px;
border: 1px solid transparent;  /* Borde de la ventana */
box-shadow: 0 5px 25px rgba(0,0,0,.1);  /* Sombra */
z-index:999;
}
#ventana-flotante #contenedor {
padding: 25px 10px 10px 10px;
overflow: auto: /* Esta es la clave del scroll*/
}
#ventana-flotante .cerrar {
float: right;
border: 2px solid red;
color: red;
background: white;
line-height: 17px;
text-decoration: none;
padding: 10px 14px;
font-family: Arial;
border-radius:50%;
font-size: 25px;
-webkit-transition: .3s;
-moz-transition: .3s;
-o-transition: .3s;
-ms-transition: .3s;
}
#ventana-flotante .cerrar:hover {
background: #ff6868;
color: white;
text-decoration: none;
text-shadow: -1px -1px red;
border-bottom: 1px solid red;
border-left: 1px solid red;
}
#ventana-flotante #contenedor .contenido {
padding: 15px;
background: transparent;  /* Fondo del mensaje */
border: 1px solid transparent;  /* Borde del mensaje */
font-size: 20px;  /* Tamaño del texto del mensaje */
color: #555;  /* Color del texto del mensaje */
text-shadow: 1px 1px white;
margin: 0 auto;
border-radius: 4px;
}
.oculto {-webkit-transition:1s;-moz-transition:1s;-o-transition:1s;-ms-transition:1s;opacity:0;-ms-opacity:0;-moz-opacity:0;visibility:hidden;}
</style>

<!-- Cierre de ventana superpuesta !-->

<div class="container">
<div class="jumbotron">

<div class="table-responsive">
<table id="tabla" class="display" cellspacing="0" width="100%">

<thead>
    <tr>
<th>Estado</th>	
<th>Residente</th>
<th>Fundación</th>
<th>Dia de pago</th>
<th>Costo pensión</th>
<th>Valor pendiente</th>
<th>Acudiente Registrado</th>    </tr>
</thead>
<tfoot>
    <tr>
<th>Estado</th>		
<th>Residente</th>
<th>Fundación</th>
<th>Dia de pago</th>
<th>Costo pensión</th>
<th>Valor pendiente</th>
<th>Acudiente Registrado</th>
    </tr>
</tfoot>			

<tbody>

<?php
mysqli_set_charset($con,"utf8");
	
$result1=mysqli_query($con,"select idcobrospension,diacobro,valorcobro,nombresr,apellidosr,residentes.estado as estado,nomfund,nombres,apellidos,usuarios.telefono as telefono from cobrospension join residentes on cobrospension.idresidentes=residentes.idresidentes join asociacion on asociacion.idresidentes=residentes.idresidentes join usuarios on asociacion.idusuarios=usuarios.idusuarios where residentes.estado='A' or residentes.estado='E'");
$ordinal=0;

while ($resultx = mysqli_fetch_array($result1)) {
$estado=$resultx['estado'];
$idcobrospension=$resultx['idcobrospension'];
$diacobro=$resultx['diacobro'];
$valorcobro=$resultx['valorcobro'];
$nomr=$resultx['nombresr'];
$nomfund=$resultx['nomfund'];
$apelr=$resultx['apellidosr'];
$idresidentes="$nomr"." "."$apelr";
$nomu=$resultx['nombres'];
$apelu=$resultx['apellidos'];
$telefono=$resultx['telefono'];
$idacudiente="$nomu"." "."$apelu"."-"."$telefono";

$ultimovalor="SELECT sum(valorinicial) as valoriniciales,sum(abono) as abonos  FROM abonopensiones where idcobrospension='$idcobrospension' ORDER by idabonopensiones DESC LIMIT 1";
$resultv1=mysqli_query($con,"$ultimovalor");

		while ($resultvx = mysqli_fetch_array($resultv1)) {
		$valoriniciales=$resultvx['valoriniciales'];
		$abonos=$resultvx['abonos'];
}
$saldos=($valoriniciales-$abonos);
$ordinal=($ordinal+1);
/* Este if-else es el que mostraba solo los que no estaban en lista
if($estado=='E'){
	$valorcobro=0;
	$saldos=0;
}
else{
	$saldos=$saldos;
	$valorcobro=$valorcobro;
}
*/
	$saldos=$saldos;
	$valorcobro=$valorcobro;
	
if($estado=='E'){
?>
<tr style="color:red;">
<td><b><i>No Contabilizar</i></b></td>
<?php
}
else{
?>
<tr>
<td style="color:green;">Contabilizar</td>
<?php
}	
?>
<td><?php echo "$idresidentes"; ?></td>
<td><?php echo "$nomfund"; ?></td>
<td><?php echo "$diacobro"; ?></td>
<td><?php echo "$valorcobro"; ?></td>

<?php
if($saldos>0){
?>
<td style="color:red;"><b><?php echo "$saldos"; ?></b></td>
<?php	
}
else{
?>
<td><?php echo "$saldos"; ?></td>
<?php	
}
?>
<td><?php echo "$idacudiente"; ?></td>
</tr>
<?php
}
?>

</tbody>

</table>
Total de residentes activos: <?php echo "$ordinal"; ?>
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
