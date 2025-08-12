<?php
$fecha = date("y-m-d");
$hoy="20$fecha";

include_once('bas/conn.php');
mysqli_set_charset($con,"utf8");

$totalimporte=$_GET['totalimporte'];
$idfacturas=$_GET['idproyectos'];

$searchpago="select * from venta where idventa='$idfacturas'";
$resultpago = mysqli_query($con,"$searchpago");

if($resultpago){
	
while ($resultpag = mysqli_fetch_array($resultpago)) {
$idresidentes=$resultpag['idresidentes'];
}

$searchd="select * from detalleventa where idventa='$idfacturas'";
$resultd = mysqli_query($con,"$searchd");
while ($resultpagd = mysqli_fetch_array($resultd)) {
$idproductos=$resultpagd['idproductos'];
$valor=$resultpagd['valor'];
if($idproductos==62){
$sqlad="INSERT into tienda (fecha,valorentrada,valorsalida,idresidentes) values ('$hoy','$valor','0','6')";	
$resultsad = mysqli_query($con,$sqlad);	
	}
}

$sqla="INSERT into tienda (fecha,valorentrada,valorsalida,idresidentes) values ('$hoy','0','$totalimporte','$idresidentes')";	
$resultsa = mysqli_query($con,$sqla);

$sql="UPDATE venta SET valor='$totalimporte' where idventa='$idfacturas'";	
$result = mysqli_query($con,$sql);
$rs = mysqli_query($con,"SELECT @@identity AS id");
if ($row = mysqli_fetch_row($rs)) {
$idcl = trim($row[0]);
}

}else{
?>	
<p>Error en la base de datos.</p>
<?php	
}
header("Location:cerradoc.php?idfacturas=$idfacturas");
?>