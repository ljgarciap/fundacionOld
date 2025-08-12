<?php
if (isset($_GET['term'])){

$flag=$_GET['term'];

header('Content-type: application/json');
include_once('bas/conn.php');
mysqli_set_charset($con,"utf8");

$sqld="select residentes.idresidentes as idresidentes,residentes.nombresr as nombresr,residentes.apellidosr as apellidosr,residentes.estado as estado,residentes.tipodocumento as tipodocumento,residentes.documentor as documentor,residentes.nomfund as nomfund from residentes where (nombresr like '%" . $_GET['term'] . "%' and (residentes.estado='A' or residentes.estado='E')) or (apellidosr like '%" . $_GET['term'] . "%' and (residentes.estado='A' or residentes.estado='E')) LIMIT 0 ,50";
	/* Recuperar y almacenar en conjunto los resultados de la consulta.*/
$selectd=mysqli_query($con,$sqld);

$resultd = array();
$total=0;

	while ($row = mysqli_fetch_assoc($selectd)) {
		$row_array['value'] = $row['nombresr']." ".$row['apellidosr'];
		$row_array['idresidentes']=$row['idresidentes'];
		$row_array['nomfund']=$row['nomfund'];
		$row_array['nombrer']=$row['nombresr']." ".$row['apellidosr'];
		$row_array['docr']=$row['tipodocumento'].": ".$row['documentor'];

		array_push($resultd,$row_array);
}
echo json_encode($resultd);
}
?>