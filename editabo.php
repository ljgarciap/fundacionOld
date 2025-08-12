<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["sadmin"]==true){
	
$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
$apellidosess=$_SESSION["apellido"];	
	
header ("Expires: Fri, 14 Mar 1980 20:53:00 GMT"); //la pagina expira en fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache"); //PARANOIA, NO GUARDAR EN CACHE 

include_once('bas/conn.php');
include("menusadmin.html");

$fecha=$_REQUEST['fecha'];
$valor=$_REQUEST['valor'];
$comentario=$_REQUEST['obs'];
$idabonopensiones=$_REQUEST['idabonopensiones'];
$idcobrospension=$_REQUEST['idcobrospension'];
?>
<body>

<div class="container">
<div class="jumbotron">
<?php
mysqli_set_charset($con,"utf8");

$query2="update abonopensiones set fechaabono='$fecha',abono='$valor',
comentario='$comentario' where idabonopensiones='$idabonopensiones'";
$result2=mysqli_query($con,"$query2");

if($result2){
	echo "<br><br><br><br>";
	echo "<center><h1 style='color:white;'>";
	echo "Movimiento completo";
	echo "</center></h1>";
	echo "<br><br>";
	echo "<center><h1>";
	echo "<a href='labonospension.php?id=$idcobrospension'>Verificar saldo</a>";
	echo "<br><br>";
	echo "</h1></center>";
}
?>

</div>
</div>
</body>
</html>
<?php
include("footersadmin.html");
}
else {
header("Location:index.php");
}
?>