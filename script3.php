<?php
include_once('bas/conn.php');
mysqli_set_charset($con,"utf8");

$query="select residentes.idresidentes,fechaingreso, MONTH(fechaingreso) as mes, DAY(fechaingreso) as diacobro from residentes join historial on 
residentes.idresidentes=historial.idresidentes where residentes.estado='A';";

$result=mysqli_query($con,$query);

while ($resultx = mysqli_fetch_array($result)) {
$idresidentes=$resultx['idresidentes'];
$diacobro=$resultx['diacobro'];
$mes=$resultx['mes'];
$fechaingreso=$resultx['fechaingreso'];

$queryr="select * from cobrospension where idresidentes='$idresidentes'";
$resultr=mysqli_query($con,$queryr);
$row_cnt = mysqli_num_rows($resultr);

if ($row_cnt>0) {
    echo "el residente $idresidentes tiene $row_cnt coincidencias";
	echo "<br>";
}
else {
	
$pensiones="INSERT INTO cobrospension(diacobro,valorcobro,idresidentes) 
VALUES ('$diacobro','0','$idresidentes')";
$resultpens=mysqli_query($con,"$pensiones");

$rs = mysqli_query($con,"SELECT MAX(idcobrospension) AS id FROM cobrospension");
if ($row = mysqli_fetch_row($rs)) {
$id = trim($row[0]);
$idco=($id+1);
}

$abpensiones="INSERT INTO abonopensiones(valorinicial,fechaabono,abono,idcobrospension) 
VALUES ('0','2018-$mes-$diacobro','0','$idco')";
$resultabpens=mysqli_query($con,"$abpensiones");

    echo "$pensiones";
	echo "<br>";
    echo "$abpensiones";
	echo "<br>";
}

}

?>