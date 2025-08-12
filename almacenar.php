<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["sadmin"]==true){
	
$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
$apellidosess=$_SESSION["apellido"];

include_once('bas/conn.php');
$fecha=$_REQUEST['fechaf'];
$valor=$_REQUEST['valor'];
$idresidentes=$_REQUEST['idresidentes'];

//se crea el residente con los datos y luego se crea el historial en este mismo archivo

mysqli_set_charset($con,"utf8");

$query="INSERT INTO cobroalmuerzos(fechaventa,valorinicial,fechaabono,abono,saldo,
	observaciones,idresidentes) VALUES 
('$fecha','$valor','$fecha','0','$valor','Cobro Inicial','$idresidentes')";
$result=mysqli_query($con,"$query");

header("Location:almuerzos.php");

include("footersadmin.html");
}
else {
header("Location:index.php");
}
?>
</body>
</html>