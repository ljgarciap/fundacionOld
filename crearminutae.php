<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["minuta"]==true){
	
$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
$apellidosess=$_SESSION["apellido"];

include_once('bas/conn.php');
$fecha = date("y-m-d");
$hoy="20$fecha";
$docuX=$_REQUEST['docuX'];
$nomX=$_REQUEST['nomX'];
$apelX=$_REQUEST['apelX'];
$resX=$_REQUEST['resX'];
$idresX=$_REQUEST['idresX'];
$asunto=$_REQUEST['asunto'];

$nombreX="$nomX"." "."$apelX";
//se crea el residente con los datos y luego se crea el historial en este mismo archivo

mysqli_set_charset($con,"utf8");

$query="INSERT INTO minutas(fecha,visitante,cedula,asunto,idresidentes) 
VALUES ('$hoy','$nombreX','$docuX','$asunto','$idresX')";
$result=mysqli_query($con,"$query");
header("Location:minutae.php");

include("footersadmin.html");
}
else {
header("Location:index.php");
}
?>
</body>
</html>