<!DOCTYPE html>
<html lang="es" class="no-js">

<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["sadmin"]==true){
	
$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
$apellidosess=$_SESSION["apellido"];

$orientador="$nombresess"." "."$apellidosess";
	
include("menusadmin.html");
include_once('bas/conn.php');
$hoy = date("y-m-d");
$dia = "20$hoy"; 
$nombresr=$_REQUEST['nombresr'];
$apellidosr=$_REQUEST['apellidosr'];
$fechan=$_REQUEST['fechan'];
$seguro=$_REQUEST['seguro'];
$direccion=$_REQUEST['direccion'];
$ciudad=$_REQUEST['ciudad'];
$documentor=$_REQUEST['documentor'];
$expedicion=$_REQUEST['expedicion'];
$tipodocr=$_REQUEST['tipodocr'];
$telefonor=$_REQUEST['telefonor'];
$emailr=$_REQUEST['emailr'];
$universidad=$_REQUEST['universidad'];
$carrera=$_REQUEST['carrera'];
$semestre=$_REQUEST['semestre'];
$actor="$nombresr"." "."$apellidosr";

$pass=MD5($documentor);

//se crea el residente con los datos y luego se crea el historial en este mismo archivo

mysqli_set_charset($con,"utf8");

$query="INSERT INTO usuarios(documento,expedicion,nombres,apellidos,telefono,email,
autorizacion,idroles) VALUES('$documentor','$expedicion','$nombresr','$apellidosr','$telefonor','$emailr','N/A','7')";
//echo $query;
echo "<br>";
$result=mysqli_query($con,"$query");

$queryr="INSERT INTO actores(nombre,centro) VALUES ('$actor','Jesús es mi roca')";
//echo $queryr;
echo "<br>";
$resultr=mysqli_query($con,"$queryr");

$query2="SELECT idusuarios FROM usuarios ORDER by idusuarios DESC LIMIT 1";
$result1=mysqli_query($con,"$query2");

		while ($resultx = mysqli_fetch_array($result1)) {
		$idusuarios=$resultx['idusuarios'];

$query1="INSERT INTO practicantes(documentop,expedicionp,fechanacimiento,nombresp,apellidosp,telefono,email,estado,direccion,ciudad,tipodocumento,eps,universidad,carrera,semestre) VALUES ('$documentor','$expedicion','$fechan','$nombresr','$apellidosr','$telefonor','$emailr','A','$direccion','$ciudad','$tipodocr','$seguro','$universidad','$carrera','$semestre')";
//echo $query1;
echo "<br>";
$result3=mysqli_query($con,"$query1");

$query4="INSERT INTO validacion(password,idusuarios) VALUES ('$pass','$idusuarios')";	
//echo $query4;
$result4=mysqli_query($con,"$query4");
		}

$query6="SELECT idpracticantes FROM practicantes ORDER by idpracticantes DESC LIMIT 1";
$result6=mysqli_query($con,"$query6");

		while ($resultx6 = mysqli_fetch_array($result6)) {
		$idpracticantes=$resultx6['idpracticantes'];
		
$query5="INSERT INTO historialp(fechaingreso,idpracticantes) VALUES('$dia','$idpracticantes')";	
//echo $query5;
$result5=mysqli_query($con,"$query5");
}		
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

<body>

<div class="container">
<div class="jumbotron">
<CENTER><H1>PRACTICANTE CREADO</H1></CENTER>
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