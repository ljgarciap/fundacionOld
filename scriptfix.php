<?php
include_once('bas/conn.php');
mysqli_set_charset($con,"utf8");

$query="select residentes.idresidentes,fechaingreso, DAY(fechaingreso) as diacobro from residentes join historial on residentes.idresidentes=historial.idresidentes where residentes.estado='A';";

$result=mysqli_query($con,$query);

while ($resultx = mysqli_fetch_array($result)) {
$idresidentes=$resultx['idresidentes'];
$diacobro=$resultx['diacobro'];
$mes="03";

$queryr="select * from cobrospension where idresidentes='$idresidentes'";
$resultr=mysqli_query($con,$queryr);
while ($resultxr = mysqli_fetch_array($resultr)) {
$idco=$resultxr['idcobrospension'];
$valorcobro=$resultxr['valorcobro'];
}

$queryab="select * from abonopensiones where idcobrospension='$idco' and YEAR(fechaabono)='2019' and MONTH(fechaabono)='03' and valorinicial>'0'";
$resultab=mysqli_query($con,$queryab);
$row_cnt = mysqli_num_rows($resultab);

if ($row_cnt>0 or $diacobro>20) {echo "<br>";}
else{
$abpensiones="INSERT INTO abonopensiones(valorinicial,fechaabono,abono,idcobrospension) 
VALUES ('$valorcobro','2019-$mes-$diacobro','0','$idco')";
$resultabpens=mysqli_query($con,"$abpensiones");

    echo "$abpensiones";
	echo "<br>";
}

}

?>