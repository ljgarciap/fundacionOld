<?php
if (isset($_GET['term'])){

header('Content-type: application/json');
include_once('bas/conn.php');
mysqli_set_charset($con,"utf8");

$sqld="SELECT * FROM residentes where nombresr like '%" . $_GET['term'] . "%' or apellidosr like '%" . $_GET['term'] . "%' and estado='A' or estado='E' LIMIT 0 ,50";
$selectd=mysqli_query($con,$sqld);

	/* Recuperar y almacenar en conjunto los resultados de la consulta.*/
$resultd = array();
	while ($row = mysqli_fetch_assoc($selectd)) {
		$row_array['value'] = $row['nombresr']." ".$row['apellidosr'];
		$row_array['idresidentes']=$row['idresidentes'];
		$row_array['nombrer']=$row['nombresr']." ".$row['apellidosr'];
		array_push($resultd,$row_array);
}
echo json_encode($resultd);
}
?>