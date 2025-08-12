<?php
if (isset($_GET['term'])){

$flag=$_GET['term'];

header('Content-type: application/json');
include_once('bas/conn.php');
mysqli_set_charset($con,"utf8");

$sqld="select residentes.idresidentes as idresidentes,residentes.nombresr as nombresr,residentes.apellidosr as apellidosr,residentes.estado as estado,residentes.tipodocumento as tipodocumento,residentes.documentor as documentor,residentes.expedicionr as expr,residentes.nomfund as nomfund,residentes.fechanacimiento as fechan,
residentes.estudios as estudios,residentes.profesion as profesion,residentes.direccionf as direccionf,
residentes.telefono as telefono,residentes.celular as celular,residentes.eps as eps,historial.fechaingreso as fechai,
YEAR(residentes.fechanacimiento) as annon from residentes join historial on residentes.idresidentes=historial.idresidentes where (residentes.nombresr like '%" . $_GET['term'] . "%' and (residentes.estado='A' or residentes.estado='E')) or (residentes.apellidosr like '%" . $_GET['term'] . "%' and (residentes.estado='A' or residentes.estado='E')) LIMIT 0 ,50";
	/* Recuperar y almacenar en conjunto los resultados de la consulta.*/
	
$selectd=mysqli_query($con,$sqld);

$resultd = array();
$total=0;

	while ($row = mysqli_fetch_assoc($selectd)) {
		$row_array['value'] = $row['nombresr']." ".$row['apellidosr'];
		$row_array['nombrer']=$row['nombresr']." ".$row['apellidosr'];
		$row_array['docr']=$row['tipodocumento'].": ".$row['documentor'];
		$row_array['idresidentes']=$row['idresidentes'];
		$row_array['nomfund']=$row['nomfund'];
		$row_array['expr']=$row['expr'];
		$row_array['fechai']=$row['fechai'];
		$row_array['fechan']=$row['fechan'];
		$row_array['estudios']=$row['estudios'];
		$row_array['profesion']=$row['profesion'];
		$row_array['direccionf']=$row['direccionf'];
		$row_array['telefono']=$row['telefono']." - ".$row['celular'];
		$row_array['eps']=$row['eps'];
		
$hoy=date("Y");		
$nacido=$row['annon'];
$edad=$hoy-$nacido;
		
		$row_array['edad']=$edad;

		array_push($resultd,$row_array);
}
echo json_encode($resultd);
}
?>