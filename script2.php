<?php
include_once('bas/conn.php');
mysqli_set_charset($con,"utf8");

$query="select abono,idabonopensiones from abonopensiones join cobrospension on abonopensiones.idcobrospension=cobrospension.idcobrospension join residentes on cobrospension.idresidentes=residentes.idresidentes join historial on 
residentes.idresidentes=historial.idresidentes where residentes.estado='A';";

$result=mysqli_query($con,$query);

while ($resultx = mysqli_fetch_array($result)) {
$idabonopensiones=$resultx['idabonopensiones'];
$abono=$resultx['abono'];

if($abono>0){
$query1="UPDATE abonopensiones SET valorinicial='0' 
where idabonopensiones='$idabonopensiones'";
$result1=mysqli_query($con,$query1); 
//echo $query1;
//echo "<br>";
}	

}

?>