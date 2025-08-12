<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["sadmin"]==true){

include_once('bas/conn.php');

$idcobrospension=$_REQUEST['iduniformes'];
$diacobro=$_REQUEST['fechac'];
$valorcobro=$_REQUEST['valorc'];

mysqli_set_charset($con,"utf8");
$query="UPDATE cobrospension SET diacobro='$diacobro',valorcobro='$valorcobro' where idcobrospension='$idcobrospension'";
$result=mysqli_query($con,$query);
//echo "$query";
/*
$query1="UPDATE abonopensiones SET valorinicial='$valorcobro' where idcobrospension='$idcobrospension' and abono='0'";
$result1=mysqli_query($con,$query1);
*/
//echo "$query";
?>

<style>
.wrapper {
    text-align: center;
}
.btn{
	background-color:#941524;
	border-color:transparent;
	color:white;
	font-size:1.5em;
}
.btn:hover{
	background-color:#523a18;
	border-color:transparent;
	color:white;
}
</style>


<?php	
header("Location:pensiones.php");

}
else {
header("Location:index.php");
}
?>