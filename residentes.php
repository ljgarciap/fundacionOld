<?php
if (isset($_GET['term'])){

header('Content-type: application/json');
include_once('bas/conn.php');
@mysql_query("set names 'utf8'");

$sqlc="select residentes.idresidentes as idr, residentes.tipodocumento as tipor, residentes.documentor as cedr, residentes.nombresr as nomr, residentes.apellidosr as apelr, residentes.estado as estr, residentes.eps as eps, residentes.nomfund as nomfund, asociacion.idasociacion as idas, asociacion.parentesco as parent, usuarios.nombres as nomu, usuarios.apellidos as apelu, usuarios.telefono as telefono, usuarios.email as email from residentes join asociacion on asociacion.idresidentes = residentes.idresidentes join usuarios on asociacion.idusuarios = usuarios.idusuarios order by nomr asc where cedr like '%" . $_GET['term'] . "%' LIMIT 0 ,50";

$selectc=mysqli_query($con,$sqlc);

	/* Recuperar y almacenar en conjunto los resultados de la consulta.*/
$resultc = array();
	while ($row = mysqli_fetch_assoc($selectc)) {
		$row_array['value'] = $row['cedr']." | ".$row['nomr']." | ".$row['apelr'];
		$row_array['tipor']=$row['tipor'];
		$row_array['cedr']=$row['cedr'];
		$row_array['nomr']=$row['nomr'];		
		$row_array['apelr']=$row['apelr'];
		$row_array['eps']=$row['eps'];
		$row_array['nomfund']=$row['nomfund'];
		$row_array['parent']=$row['parent'];
		$row_array['nomu']=$row['nomu'];
		$row_array['apelu']=$row['apelu'];
		$row_array['telefono']=$row['telefono'];		
		$row_array['email']=$row['email'];		
		array_push($resultc,$row_array);
}
echo json_encode($resultc);
}
?>