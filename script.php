<?php
include_once('bas/conn.php');
mysqli_set_charset($con,"utf8");

$hoy = date("y-m-d"); 
$fecha="20$hoy";

$query="select nombresr,apellidosr,cobrospension.idcobrospension,diacobro,fechaingreso,fechaabono,
valorinicial, MONTH(fechaingreso) as mes from abonopensiones join cobrospension on abonopensiones.idcobrospension=cobrospension.idcobrospension join residentes 
on cobrospension.idresidentes=residentes.idresidentes join historial on 
residentes.idresidentes=historial.idresidentes where residentes.estado='A';";

$result=mysqli_query($con,$query);

while ($resultx = mysqli_fetch_array($result)) {
$nombresr=$resultx['nombresr'];
$apellidosr=$resultx['apellidosr'];
$idcobrospension=$resultx['idcobrospension'];
$diacobro=$resultx['diacobro'];
$fechaingreso=$resultx['fechaingreso'];
$fechaabono=$resultx['fechaabono'];
$valorinicial=$resultx['valorinicial'];
$mes=$resultx['mes'];
$fechacambio="2018-$mes-$diacobro";

if($fechaabono=="2018-01-01"){
$query1="UPDATE abonopensiones SET fechaabono='$fechacambio' 
where idcobrospension='$idcobrospension'";
$result1=mysqli_query($con,$query1); 
//echo $query1;
//echo "<br>";

$mesc=($mes+1);
for($i=$mesc; $i<=12; $i++){
	$fecha2="2018-$i-$diacobro";
	$query2="INSERT INTO abonopensiones(valorinicial,fechaabono,abono,idcobrospension) VALUES ('$valorinicial','$fecha2','0','$idcobrospension')";
$result2=mysqli_query($con,$query2); 
//echo $query2;
//echo "<br>";
}


}	


}

?>