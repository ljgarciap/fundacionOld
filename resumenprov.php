<?php
header ("Expires: Fri, 14 Mar 1980 20:53:00 GMT"); //la pagina expira en fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache"); //PARANOIA, NO GUARDAR EN CACHE 

include_once('bas/conn.php');
include("menutienda.html");
mysqli_set_charset($con,"utf8");
$hoy = date("y-m-d");
$fecham="20$hoy"; 

$idproveedores=$_GET['idproveedores'];
?>

<div class="container">
<div class="jumbotron">

<?php
$query="select * from proveedores where idproveedores=$idproveedores";
$result=mysqli_query($con,$query);
while ($resultax = mysqli_fetch_array($result)) {
$nomprov=$resultax['nombre'];
}
?>
<center><h2><?php echo $nomprov; ?></h2></center>
<hr style="background: red; height: 3px; width: 100%; border: 0">
<?php
$queryp="select * from pedidos join proveedores on pedidos.idproveedores=proveedores.idproveedores 
where pedidos.idproveedores='$idproveedores' order by fecha asc";	
$resultp=mysqli_query($con,$queryp);
while ($resultxp = mysqli_fetch_array($resultp)) {
$fechafra=$resultxp['fecha'];
$fra=$resultxp['documento'];
$valorfra=$resultxp['valor'];
$idpedidos=$resultxp['idpedidos'];
//new
$queryacum="select sum(abono) as acumulado from pagos where idpedidos='$idpedidos'";	
$resultacum=mysqli_query($con,$queryacum);
while ($resultxacum = mysqli_fetch_array($resultacum)) {
$abonoacum=$resultxacum['acumulado'];
}
$saldoacum=$valorfra-$abonoacum;
if($saldoacum>0){
?>
<center><h2><?php echo "Movimientos factura: ".$fra; ?></h2></center>
<center><h4><?php echo "Saldo factura: ".$saldoacum; ?></h4></center><br>
<center>
<div class="table-responsive">
<table class="display" cellspacing="0" width="100%">
<thead>
    <tr>
<th>Fecha</th>
<th>Valor fra</th>
<th>Abono fra</th>
<th>Saldo</th>
<th>Observaciones</th>
    </tr>
</thead>
<tbody>
<?php
$queryu="select * from pagos where idpedidos='$idpedidos' order by fechaabono asc";	
$result1=mysqli_query($con,$queryu);

$acumab=0;

	while ($resultx = mysqli_fetch_array($result1)) {
		$fechaabono=$resultx['fechaabono'];
		$abono=$resultx['abono'];
		$obs=$resultx['obs'];
		$acumab=$acumab+$abono;
		$saldo=$valorfra-$acumab;
?>
	<tr>
	<td><?php echo "$fechaabono"; ?></td>
	<td><?php echo "$valorfra"; ?></td>
	<td style="color:green;"><?php echo "$abono"; ?></td>
	<td style="color:red;"><?php echo "$saldo"; ?></td>	
	<td><?php echo "$obs"; ?></td>
	</tr>
<?php
	}
?>
</tbody>
</table>
</div>
</center>
<br><br>
<?php
}
}
?>

</div>
</div>
<?php
include("footersadmin.html");
?>
