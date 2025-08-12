<?php
if (isset($_GET['term'])){

$flag=$_GET['term'];

header('Content-type: application/json');
include_once('bas/conn.php');
mysqli_set_charset($con,"utf8");

$sqld="select distinct residentes.idresidentes as idresidentes,residentes.nombresr as nombresr,residentes.apellidosr as apellidosr,residentes.estado as estado from tienda join residentes on tienda.idresidentes=residentes.idresidentes where (nombresr like '%" . $_GET['term'] . "%' and (residentes.estado='A' or residentes.estado='E')) or (apellidosr like '%" . $_GET['term'] . "%' and (residentes.estado='A' or residentes.estado='E')) LIMIT 0 ,50";
	/* Recuperar y almacenar en conjunto los resultados de la consulta.*/
$selectd=mysqli_query($con,$sqld);

$resultd = array();
$total=0;

	while ($row = mysqli_fetch_assoc($selectd)) {
		$row_array['value'] = $row['nombresr']." ".$row['apellidosr'];
		$row_array['idresidentes']=$row['idresidentes'];
		$row_array['nombrer']=$row['nombresr']." ".$row['apellidosr'];
		$idresi=$row['idresidentes'];

$queryur="select SUM(tienda.valorentrada) as valorentrada,
sum(tienda.valorsalida) as valorsalida from tienda join residentes on tienda.idresidentes=residentes.idresidentes where residentes.idresidentes=$idresi;";	
$result1r=mysqli_query($con,$queryur);
while ($resultxr = mysqli_fetch_array($result1r)) {
$entradas=$resultxr['valorentrada'];
$salidas=$resultxr['valorsalida'];
}
$saldototal=$entradas-$salidas;
		$row_array['saldototal']=$saldototal;

		array_push($resultd,$row_array);
}
echo json_encode($resultd);
}
?>