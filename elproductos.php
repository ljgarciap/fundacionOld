<?php
header ("Expires: Fri, 14 Mar 1980 20:53:00 GMT"); //la pagina expira en fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache"); //PARANOIA, NO GUARDAR EN CACHE 

include_once('bas/conn.php');
include("menutienda.html");

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

<thead>
    <tr>
<th>Producto</th>
<th>Desactivar</th>
    </tr>
</thead>
<tfoot>
    <tr>
<th>Producto</th>
<th>Desactivar</th>
    </tr>
</tfoot>			

<tbody>

<center><h2>Productos activos</h2></center>

<?php
mysqli_set_charset($con,"utf8");
$query="select * from productos where estado='1';";

$result=mysqli_query($con,$query);
while ($resultax = mysqli_fetch_array($result)) {
$idproveedores=$resultax['idproductos'];
$nomresidente=$resultax['detalle'];
?>
<tr>
<td><?php echo "$nomresidente"; ?></td>
<td><a href='elimproductos.php?idt=<?php echo "$idproveedores"; ?>'>Desactivar</a></td>
</tr>
<?php
}
?>
</tbody>

</table>
</div>
</center>
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
?>
