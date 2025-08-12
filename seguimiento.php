<!DOCTYPE html>
<html lang="es" class="no-js">

<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["psico"]==true){
	
$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];

include("menupsico.html");
include_once('bas/conn.php');
mysqli_set_charset($con,"utf8");

$hoy = date("y-m-d"); 
 
$nomfund=$_REQUEST['nomfund'];
$fechar=$_REQUEST['fechar'];
$horar=$_REQUEST['horar'];
$nombrer=$_REQUEST['nombrer'];
$compromiso=$_REQUEST['compromiso'];
$sesion=$_REQUEST['sesion'];
$tarea=$_REQUEST['tarea'];
$idresidentes=$_REQUEST['idresidentes'];

if($nomfund=="FUNDACIÓN JESÚS ES MI ROCA"){$nf="F";}
else if($nomfund=="CENTRO JOREC"){$nf="J";}

//se crea el residente con los datos y luego se crea el historial en este mismo archivo

mysqli_set_charset($con,"utf8");

$query="INSERT INTO terapiap(fecha,hora,evaluacion,trabajo,tarea,idresidentes) VALUES ('$fechar','$horar','$compromiso','$sesion','$tarea','$idresidentes')";
$result=mysqli_query($con,"$query");
	
$query1="SELECT idterapiap FROM terapiap ORDER by idterapiap desc LIMIT 1";
$result1=mysqli_query($con,"$query1");

while ($resultx = mysqli_fetch_array($result1)) {
$idterapiap=$resultx['idterapiap'];
}

if($nf=="F"){
	$url="impterapiap.php?idt=$idterapiap";
}
else if($nf=="J"){
	$url="impterapiapj.php?idt=$idterapiap";
}
?>

<body>

<div class="container">
<div class="jumbotron">

<br><br>
<center>
<h1><a href="<?php echo $url; ?>" target="blank">Imprimir terapia</a></h1>
<br>
<h1><a href="psicologo.php">Regresar a inicio</a></h1>
</center>

</div>
</div>

<?php	
include("footersadmin.html");
}
else {
header("Location:index.php");
}
?>
</body>
</html>