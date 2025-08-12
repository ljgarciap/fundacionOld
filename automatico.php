<?php
include_once('bas/conn.php');

mysqli_set_charset($con,"utf8");
$query="select idcobrospension,diacobro,valorcobro from cobrospension";
$result=mysqli_query($con,"$query");

$hoy = date("y-m-d");
$dia=intval(date("d"));
$mes=intval(date("m"));

while ($resultx = mysqli_fetch_array($result)) {
$regdia=$resultx['diacobro'];
$idcobrospension=$resultx['idcobrospension'];	
$valorcobro=$resultx['valorcobro'];

if($regdia==$dia) {

$query1="select sum(valorinicial) as valor from abonopensiones where fechaabono='20$hoy' and idcobrospension='$idcobrospension'";
$result1=mysqli_query($con,"$query1");

while ($resultx1 = mysqli_fetch_array($result1)) {
$valor=$resultx1['valor'];	
if($valor>0) {
echo ".";
			}
else{
	
$verif="select estado from residentes join cobrospension on residentes.idresidentes=cobrospension.idresidentes 
where idcobrospension='$idcobrospension'";	
$resultv=mysqli_query($con,"$verif");
while ($resultxv = mysqli_fetch_array($resultv)) {
$est=$resultxv['estado'];

if($est=='A'||$est=='E'){	
$queryi="INSERT INTO abonopensiones(valorinicial,fechaabono,idcobrospension) 
VALUES ('$valorcobro','20$hoy','$idcobrospension')";
$resulti=mysqli_query($con,"$queryi");
echo ".";
}
else{echo ".";}
}

}			
		}
	}
}
header("Location:superadmin.php");  
?>