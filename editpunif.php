<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["sadmin"]==true){

include_once('bas/conn.php');

$iduniformes=$_REQUEST['iduniformes'];
$fechacobro=$_REQUEST['fechac'];
$valorcobro=$_REQUEST['valorc'];

mysqli_set_charset($con,"utf8");
$query="UPDATE uniformes SET fechacobro='$fechacobro',valorcobro='$valorcobro' where iduniformes='$iduniformes'";
$result=mysqli_query($con,$query);
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
header("Location:uniformes.php");

}
else {
header("Location:index.php");
}
?>