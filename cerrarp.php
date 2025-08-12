<?php
session_start();
$fecha = date("y-m-d");
$hoy="20$fecha";

include_once('bas/conn.php');
mysqli_set_charset($con,"utf8");

$totalimportecl=$_GET['totalimportecl'];
$idpedidos=$_GET['idproyectos'];
$facturax=$_GET['factura'];

$sqlins="INSERT INTO pagos(fechaabono,valorpago,abono,obs,idpedidos) 
VALUES ('$hoy','$totalimportecl','0','$facturax','$idpedidos')";	
$result = mysqli_query($con,$sqlins);

//echo $sql2;
header("Location:cerradop.php?idpedidos=$idpedidos");
?>