<?php
if (isset($_GET['term'])){

header('Content-type: application/json');
include_once('bas/conn.php');
mysqli_set_charset($con,"utf8");

$sqlc="SELECT * FROM usuarios where apellidos like '%" . $_GET['term'] . "%' LIMIT 0 ,50";
$selectc=mysqli_query($con,$sqlc);

	/* Recuperar y almacenar en conjunto los resultados de la consulta.*/
$resultc = array();
	while ($row = mysqli_fetch_assoc($selectc)) {
		$row_array['value'] = $row['documento']." | ".$row['nombres']." ".$row['apellidos'];
		$row_array['idusuarios']=$row['idusuarios'];
		$row_array['documento']=$row['documento'];		
		$row_array['nombres']=$row['nombres'];
		$row_array['apellidos']=$row['apellidos'];		
		array_push($resultc,$row_array);
}
echo json_encode($resultc);
}
?>